<?php

class NewsController
{
	public function actionAll()
	{
		$news = News::getAll();
		$view = new View();
		$view->articles = $news;
		$view->title = 'Главная страница';
		$view->content = $view->render('News/index');
		$view->display();
	}

	public function actionOne()
	{
		$id = isset($_GET['id']) ? $_GET['id'] : die('failed id');
		$news = News::getOne($id);

		$view = new View();
		$view->article = $news;
		$view->title = $view->article['title'];

		$view->content = $view->render('News/article');
		$view->display();
	}
}