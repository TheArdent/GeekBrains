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

	public static function deleteArticle($id)
	{
		$connect_str = DB_DRIVER . ':host='. DB_HOST . ';dbname=' . DB_NAME;
		$conn = new PDO($connect_str, DB_USER, DB_PASS);

		$row = $conn->exec("DELETE FROM articles WHERE id_article=$id");

		$errors = $conn->errorInfo();

		if ( $conn->errorCode() != 0000 )
			echo "SQL error :".$errors[2]."<br/>";

		return !$row;
	}

	public static function addArticle($title, $content)
	{
		if (empty($title) or empty($content))
			return True;

		$connect_str = DB_DRIVER . ':host='. DB_HOST . ';dbname=' . DB_NAME;
		$conn = new PDO($connect_str, DB_USER, DB_PASS);

		$row = $conn->exec("INSERT INTO articles (title, content) VALUES ('$title','$content')");

		$errors = $conn->errorInfo();

		if ( $conn->errorCode() != 0000 )
			echo "SQL error :".$errors[2]."<br/>";

		return !$row;
	}

	public static function editArticle($id, $title, $content)
	{
		$connect_str = DB_DRIVER . ':host='. DB_HOST . ';dbname=' . DB_NAME;
		$conn = new PDO($connect_str, DB_USER, DB_PASS);

		$row = $conn->exec("UPDATE articles SET `title`='$title',`content`='$content' WHERE id_article=$id");

		$errors = $conn->errorInfo();

		if ($conn->errorCode() != 0000)
			echo "SQL error :" . $errors[2] . "<br/>";

		return !$row;
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