<?php

/**
 * Created by PhpStorm.
 * User: theardent
 * Date: 14.01.17
 * Time: 14:40
 */
class CommentsController
{
	public function actionAll()
	{
		$id = isset($_GET['id']) ? $_GET['id'] : die('failed id');
		$Comment = Comments::Instance();
		$Comments = $Comment->All($id);

		$view = new View();
		$view->Comments = $Comments;

		echo $view->render('Comments/index');
	}

	public function actionAdd()
	{
		$id = isset($_POST['id']) ? $_POST['id'] : die('failed id');
		$Comment = Comments::Instance();
		$Comments = $Comment->Add($id,$_POST['name'],$_POST['text']);
	}
}