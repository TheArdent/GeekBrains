<?php

/**
 * Created by PhpStorm.
 * User: theardent
 * Date: 19.01.17
 * Time: 17:55
 */
class UserController
{
	public function actionindex()
	{
		$User = new Users();
		$view = new View();
		if (!$User->Get()){
			$view->content = $view->render('User/login');
		}
		else {
			$view->login = $User->Get()['login'];
			if ($User->Can('EDIT_USER_ROLES')){
				$view->admin = true;
			}
			$view->content = $view->render('User/index');
		}
		echo $view->content;
	}

	public function actionlogin()
	{
		$error = false;
		$User = new Users;
		if ($_POST['login'] == null){
			$error = 'Введите имя пользователя!';
		}
		if ( !$error && $_POST['password'] == null){
			$error = 'Введите пароль!';
		}
		if (!$error && !$User->Login($_POST['login'],$_POST['password'],$_POST['remember'])){
			$error = 'Неверное имя пользователя или пароль!';
		}
		if ($error){
			$view = new View();
			$view->error = $error;
			$view->content = $view->render('User/login');
			echo $view->content;
		} else {
			$this->actionindex();
		}
	}

	public function actionregister()
	{
		$NewUser = new Users;

		$error = false;

		if ($_POST['login'] == null){
			$error = 'Введите имя пользователя!';
		}
		if ( !$error && $_POST['password'] == null){
			$error = 'Введите пароль!';
		}
		if (!$error && !$NewUser->Register('admin','admin')){
			$error = 'Пользователь с данным именем пользователя уже существует!';
		}
		if ($error){
			$view = new View();
			$view->error = $error;
			$view->content = $view->render('User/login');
			echo $view->content;
		}
		else {
			$this->actionindex();
		}
	}

	public function actionlogout()
	{
		$User = new Users;
		$User->Logout();
		$view = new View();
		$view->content = $view->render('User/login');
		echo $view->content;
	}
}