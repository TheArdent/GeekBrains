<?php

class NewsController
{
	public function actionAll()
	{
		//TODO
		$news = News::getAll();
		$view = new View();
		$view->articles = $news;
		$view->title = 'Главная страница';

		$view->display('v_index');

	}

	public function actionOne()
	{
		//TODO
		$id = isset($_GET['id']) ? $_GET['id'] : die('failed id');
		$news = News::getOne($id);

		$view = new View();
		$view->article = $news;
		$view->title = $view->article['title'];

		$view->display('v_article');
	}
}