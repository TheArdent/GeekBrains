<?php

class Article
{
	public $id;
	protected $title;
	protected $content;

	public $preview;

	function Article($id, $title, $content)
	{
		$this->id = $id;
		$this->title = $title;
		$this->content = $content;

		//обрезаем текст на 15 символов:
		$this->preview = substr($content, 0, 15);
		//убедимся что текст не заканчивается восклицательным знаком, запятой, точкой или тире:
		$this->preview = rtrim($this->preview, "!,.-");
		//находим последний пробел, устраняем его:
		$this->preview = substr($this->preview, 0, strrpos($this->preview, ' '));
	}
	
	//  Функция для вывода статьи
	function view()
	{
		echo "<h1>$this->title</h1><p>$this->content</p>";
	}
}

class NewsArticle extends Article
{
	protected $datetime;

	function NewsArticle($id, $title, $content)
	{
		parent::Article($id, $title, $content);
		$this->datetime = time();
	}
	
	//  Функция для вывода статьи
	function view()
	{
		echo "<h1>$this->title</h1><span style='color: red'>".
				strftime('%d.%m.%y', $this->datetime).
				" <b>Новость</b></span><p>$this->content</p>";
	}
}

class CrossArticle extends Article
{
	protected $source;
	
	function CrossArticle($id, $title, $content, $source)
	{
		parent::Article($id, $title, $content);
		$this->source = $source;
	}

	function view()
	{
		parent::view();
		echo '<small>'.$this->source.'</small>';
	}
}

class ArticleList
{
	protected $alist;
	
	function add(Article $article)
	{
		$this->alist[] = $article;
	}
	
	//  Вывод статей
	function view()
	{
		foreach($this->alist as $article)
		{
			$article->view();
			echo '<hr />';
		}
	}

	//Удаление статьи
	function delete($id)
	{
		for ($i = 0; $i < count($this->alist); $i++)
		{
			if ($this->alist[$i]->id == $id)
				unset($this->alist[$i]);
		}
	}
}
?>