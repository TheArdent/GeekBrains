<?phpinclude_once('startup.php');include_once('model.php');// Установка параметров, подключение к БД, запуск сессии.startup();// Обработка отправки формы.if (!empty($_POST)){	if (isset($_POST['delete_id']))	{		articles_delete(intval($_POST['delete_id']));		header('Location: editor.php');		die();	}    if (articles_edit($_GET['id'],$_POST['title'], $_POST['content']))    {        header('Location: editor.php');        die();    }    else $error = true;}else{    $article = articles_get($_GET['id']);    $error = false;}// Кодировка.header('Content-type: text/html; charset=utf-8');// Вывод в шаблон.$title = "Редактирование статьи";// Внутренний шаблон.$content = view_include('view/v_edit.php',array('title' => $title,'article' => $article, 'error' => $error));// Внешний шаблон.$page = view_include(	'view/v_main.php',	array('title' => $title, 'content' => $content));// Вывод.echo $page;