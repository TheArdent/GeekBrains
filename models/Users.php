<?php

/**
 * Created by PhpStorm.
 * User: theardent
 * Date: 19.01.17
 * Time: 17:14
 */
class Users
{
	private static $instance;	// экземпляр класса
	private $msql;				// драйвер БД
	private $sid;				// идентификатор текущей сессии
	private $uid;				// идентификатор текущего пользователя

	//
	// Получение экземпляра класса
	// результат	- экземпляр класса MSQL
	//
	public static function Instance()
	{
		if (self::$instance == null)
			self::$instance = new Users();

		return self::$instance;
	}

	//
	// Конструктор
	//
	public function __construct()
	{
		$this->msql = DB::GetInstance();
		$this->sid = null;
		$this->uid = null;
	}

	//
	// Очистка неиспользуемых сессий
	//
	public function ClearSessions()
	{
		$min = time() - 60 * 20;
		$t = "time_last < '%s'";
		$where = sprintf($t, $min);
		$this->msql->Delete('sessions', $where);
	}


	public function Register($login, $password)
	{
		$user = array( 'login' => $login,
		               'password' => md5($password),
		               'id_role' => 1 );

		$res = $this->msql->Insert('users',$user);
		return $res;
	}

	//
	// Авторизация
	// $login 		- логин
	// $password 	- пароль
	// $remember 	- нужно ли запомнить в куках
	// результат	- true или false
	//

	public function Login($login, $password, $remember)
	{
		// вытаскиваем пользователя из БД
		$user = $this->GetByLogin($login);

		if ($user == null)
			return false;

		$id_user = $user['id_user'];


		// проверяем пароль
		if ($user['password'] != md5($password))
			return false;

		// запоминаем имя и md5(пароль)

		if ($remember == 'true')
		{
			$expire = time() + 3600 * 24 * 100;
			setcookie('login', $login, $expire);
			setcookie('password', md5($password), $expire);
		}

		// открываем сессию и запоминаем SID
		$this->sid = $this->OpenSession($id_user);

		return true;
	}

	//
	// Выход
	//
	public function Logout()
	{
		session_start();
		setcookie('login', '', time() - 1);
		setcookie('password', '', time() - 1);
		unset($_COOKIE['login']);
		unset($_COOKIE['password']);
		unset($_SESSION['sid']);
		$this->sid = null;
		$this->uid = null;
	}


	// Получаем всех пользователей
	public function GetAllUser()
	{
		return $this->msql->Select('SELECT users.id_user,users.login,roles.name FROM users INNER JOIN roles WHERE users.id_role = roles.id_role');
	}

	// Изменить роль для конкретного пользователя
	public function SetRoleUser( $user_id, $role_name)
	{
		$role_id = $this->msql->Select("SELECT * FROM roles WHERE roles.name = '{$role_name}'")[0]['id_role'];
		$role = array('id_role' => $role_id);
		$result = $this->msql->Update('users', $role, 'id_user = '.$user_id);
		return $result;
	}

	//
	// Получение пользователя
	// $id_user		- если не указан, брать текущего
	// результат	- объект пользователя
	//
	public function Get($id_user = null)
	{
		// Если id_user не указан, берем его по текущей сессии.
		if ($id_user == null)
			$id_user = $this->GetUid();

		if ($id_user == null)
			return null;

		// А теперь просто возвращаем пользователя по id_user.
		$t = "SELECT * FROM users WHERE id_user = '%d'";
		$query = sprintf($t, $id_user);
		$result = $this->msql->Select($query);
		return $result[0];
	}

	//
	// Получает пользователя по логину
	//
	public function GetByLogin($login)
	{
		$t = "SELECT * FROM users WHERE login = '%s'";
		$query = sprintf($t, $login);
		$result = $this->msql->Select($query);
		if (!$result)
			return false;
		return $result[0];
	}

	//
	// Проверка наличия привилегии
	// $priv 		- имя привилегии
	// $id_user		- если не указан, значит, для текущего
	// результат	- true или false
	//
	public function Can($priv, $id_user = null)
	{
		if ($id_user == null)
			$id_user = $this->GetUid();

		if ($id_user == null)
			return false;

		$t = "SELECT count(*) as cnt FROM privs2roles
			  LEFT JOIN users u ON u.id_role = privs2roles.id_roles
			  LEFT JOIN privs p ON p.id_priv = privs2roles.id_priv 
			  WHERE u.id_user = '%d' AND p.name = '%s'";

		$query  = sprintf($t, $id_user, $priv);
		$result = $this->msql->Select($query);

		return ($result[0]['cnt'] > 0);
	}

	//
	// Проверка активности пользователя
	// $id_user		- идентификатор
	// результат	- true если online
	//
	public function IsOnline($id_user)
	{
		$onlinetimer = time() - 20*60;
		$result = $this->msql->Select("SELECT * FROM sessions where id_user = {$id_user} and time_last > {$onlinetimer}");
		if ($result)
			return true;
		else
			return false;
	}

	//
	// Получение id текущего пользователя
	// результат	- UID
	//
	public function GetUid()
	{
		// Проверка кеша.
		if ($this->uid != null)
			return $this->uid;

		// Берем по текущей сессии.
		$sid = $this->GetSid();

		if ($sid == null)
			return null;

		$t = "SELECT id_user FROM sessions WHERE sid = '%s'";
		$query = sprintf($t, $sid);
		$result = $this->msql->Select($query);


		// Если сессию не нашли - значит пользователь не авторизован.
		if (count($result) == 0)
			return null;

		// Если нашли - запоминм ее.
		$this->uid = $result[0]['id_user'];
		return $this->uid;
	}

	//
	// Функция возвращает идентификатор текущей сессии
	// результат	- SID
	//
	private function GetSid()
	{
		// Проверка кеша.
		if ($this->sid != null)
			return $this->sid;

		// Ищем SID в сессии.
		$sid = @$_SESSION['sid'];

		// Если нашли, попробуем обновить time_last в базе.
		// Заодно и проверим, есть ли сессия там.
		if ($sid != null)
		{
			$session = array();
			$session['time_last'] = time();
			$t = "sid = '%s'";
			$where = sprintf($t, $sid);
			$affected_rows = $this->msql->Update('sessions', $session, $where);

			if ($affected_rows == 0)
			{
				$t = "SELECT count(*) FROM sessions WHERE sid = '%s'";
				$query = sprintf($t, $sid);
				$result = $this->msql->Select($query);

				if ($result[0]['count(*)'] == 0)
					$sid = null;
			}
		}

		// Нет сессии? Ищем логин и md5(пароль) в куках.
		// Т.е. пробуем переподключиться.
		if ($sid == null && isset($_COOKIE['login']))
		{
			$user = $this->GetByLogin($_COOKIE['login']);

			if ($user != null && $user['password'] == $_COOKIE['password'])
				$sid = $this->OpenSession($user['id_user']);
		}

		// Запоминаем в кеш.
		if ($sid != null)
			$this->sid = $sid;

		// Возвращаем, наконец, SID.
		return $sid;
	}

	//
	// Открытие новой сессии
	// результат	- SID
	//

	private function OpenSession($id_user)
	{
		// генерируем SID
		$sid = $this->GenerateStr(10);

		// вставляем SID в БД
		$now = time();
		$session = array();
		$session['id_user'] = $id_user;
		$session['sid'] = $sid;
		$session['time_start'] = $now;
		$session['time_last'] = $now;
		$this->msql->Insert('sessions', $session);

		// регистрируем сессию в PHP сессии
		$_SESSION['sid'] = $sid;

		// возвращаем SID
		return $sid;
	}

	//
	// Генерация случайной последовательности
	// $length 		- ее длина
	// результат	- случайная строка
	//
	private function GenerateStr($length = 10)
	{
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
	}
}