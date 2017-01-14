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

	public function Add($title, $content)
	{
		$My_DB = DB::GetInstance();
		return $My_DB->Insert('articles', [ 'title' => $title, 'content' => $content]);
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