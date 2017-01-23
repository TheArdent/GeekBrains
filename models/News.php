<?php

/**
 * Created by PhpStorm.
 * User: theardent
 * Date: 28.12.16
 * Time: 5:49
 */
class News
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
		return $My_DB->Delete('articles','id_article = '.$id);
	}

	public function Add($title, $content, $id_user)
	{
		$My_DB = DB::GetInstance();
		return $My_DB->Insert('articles', [ 'title' => $title, 'content' => $content, 'id_user' => $id_user]);
	}

	public function Edit($id, $title, $content)
	{
		$My_DB = DB::GetInstance();
		return $My_DB->Update('articles',[ 'title' => $title, 'content' => $content],'id_article = '.$id);
	}

	public function All()
	{
		$My_DB = DB::GetInstance();
		return $My_DB->Select("SELECT * FROM articles ORDER BY id_article DESC");
	}
	public function Get($id)
	{
		$My_DB = DB::GetInstance();
		return $My_DB->Select("SELECT * FROM articles WHERE id_article = {$id}")[0];
	}
}