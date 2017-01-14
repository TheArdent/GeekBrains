<?php

/**
 * Created by PhpStorm.
 * User: theardent
 * Date: 14.01.17
 * Time: 14:24
 */
class Comments
{
	private static $instance;

	public static function Instance()
	{
		if (self::$instance == null)
			self::$instance = new self();
		return self::$instance;
	}

	private function __construct(){	}

	public function Delete($id)
	{
		$My_DB = DB::GetInstance();
		return $My_DB->Delete('comments','id_comment = '.$id);
	}

	public function Add( $id_article, $author_name, $text)
	{
		$My_DB = DB::GetInstance();
		return $My_DB->Insert('comments', [ 'id_article' => $id_article, 'author_name' => $author_name, 'text' => $text, 'date' => time()]);
	}

	public function Edit( $id_comment, $id_article, $author_name, $text)
	{
		$My_DB = DB::GetInstance();
		return $My_DB->Update('comments',[ 'id_article' => $id_article, 'author_name' => $author_name, 'text' => $text], 'id_comment = '.$id_comment);
	}

	public function All( $id_article)
	{
		$My_DB = DB::GetInstance();
		return $My_DB->Select("SELECT * FROM `comments` WHERE `id_article` = ". $id_article ." ORDER BY `date` DESC");
	}
}