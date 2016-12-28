<?php

include_once __DIR__.'/../classes/DB.php';

/**
 * Created by PhpStorm.
 * User: theardent
 * Date: 28.12.16
 * Time: 5:49
 */
class News
{
	private $id;
	private $title;
	private $content;

	public function deleteArticle($id)
	{
		//TODO
	}

	public function addArticle($title, $content)
	{
		//TODO
	}

	public static function getAll()
	{
		$connect_str = DB_DRIVER . ':host='. DB_HOST . ';dbname=' . DB_NAME;
		$conn = new PDO($connect_str, DB_USER, DB_PASS);

		$result = $conn->query("SELECT * FROM articles ORDER BY id_article DESC");

		$errors = $conn->errorInfo();

		if ( $conn->errorCode() != 0000 )
			echo "SQL error :".$errors[2]."<br/>";

		$buff = [];
		while($row = $result->fetch())
		{
			$buff[] = $row;
		}

		return $buff;
	}
	public static function getOne($id)
	{
		$connect_str = DB_DRIVER . ':host='. DB_HOST . ';dbname=' . DB_NAME;
		$conn = new PDO($connect_str, DB_USER, DB_PASS);

		$result = $conn->query("SELECT * FROM articles WHERE id_article=$id");

		$errors = $conn->errorInfo();

		if ($conn->errorCode() != 0000)
			echo "SQL error :" . $errors[2] . "<br/>";

		while ($row = $result->fetch()) {
			return $row;
		}
		return False;
	}
}