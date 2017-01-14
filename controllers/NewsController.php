<?php

class NewsController
{
	public function actionAll()
	{
		$New = News::Instance();
		$news = $New->All();
		$view = new View();
		$view->articles = $news;
		$view->title = 'Главная страница';
		$view->content = $view->render('News/index');
		$view->display();
	}

	public function actionOne()
	{
		$id = isset($_GET['id']) ? $_GET['id'] : die('failed id');
		$New = News::Instance();
		$news = $New->Get($id);
		$view = new View();
		$view->article = $news;
		$view->title = $news['title'];

		$view->content = $view->render('News/article');
		$view->display();
	}
}