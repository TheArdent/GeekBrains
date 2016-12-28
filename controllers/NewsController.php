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
		$view->content = $view->render('v_index');
		$view->display('v_main');

	}

	public function actionOne()
	{
		//TODO
		$id = isset($_GET['id']) ? $_GET['id'] : die('failed id');
		$news = News::getOne($id);

		$view = new View();
		$view->article = $news;
		$view->title = $view->article['title'];

		$view->content = $view->render('v_article');
		$view->display('v_main');
	}
}