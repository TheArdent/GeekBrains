<?php

class AdminController
{

	public static function actionAdd()
	{
		$error = False;
		$New = News::Instance();
		if (isset($_POST['title']) && isset($_POST['content'])) {
			$error = !$New->Add($_POST['title'], $_POST['content']);
			if (!$error) {
				header('Location: index.php?ctrl=Admin');
			}
		}
		$view = new View();
		$view->title = 'Добавление статьи';
		$view->error = $error;

		$view->content = $view->render('News/new');
		$view->display();
	}

	public static function actionEdit()
	{
		$error = False;
		$New = News::Instance();
		if (isset($_POST['delete_id']))
		{
			$error = !$New->Delete($_POST['delete_id']);
			if (!$error) {
				header('Location: index.php?ctrl=Admin');
			}
		}
		if (isset($_POST['title']) && isset($_POST['content'])) {
			$error = !$New->Edit($_GET['id'],$_POST['title'], $_POST['content']);
			if (!$error) {
				header('Location: index.php?ctrl=Admin');
			}
		}
		$view = new View();
		$view->title = 'Редактирование статьи статьи';
		$view->error = $error;
		$New = News::Instance();
		$view->article = $New->Get($_GET['id']);

		$view->content = $view->render('News/edit');
		$view->display();
	}

	public function actionAll()
	{
		$New = News::Instance();
		$news = $New->All();
		$view = new View();
		$view->articles = $news;
		$view->title = 'Главная страница редактора';

		$view->content = $view->render('News/editor');
		$view->display();
	}

	public function actionOne()
	{
		$id = isset($_GET['id']) ? $_GET['id'] : die('failed id');
		$news = News::getOne($id);

		$view = new View();
		$view->article = $news;
		$view->title = $view->article['title'];

		$view->content = $view->render('News/edit');
		$view->display();
	}
}