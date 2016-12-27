<?php

class Article
{
	protected $id;
	protected $title;
	protected $content;

	protected $preview;

	public function Article($id, $title, $content)
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
	public function view()
	{
		echo "<h1>$this->title</h1><p>$this->content</p>";
	}

	public function get_id()
	{
		return $this->id;
	}

	public function get_preview()
	{
		return $this->preview;
	}
}

class NewsArticle extends Article
{
	protected $datetime;

	public function NewsArticle($id, $title, $content)
	{
		parent::Article($id, $title, $content);
		$this->datetime = time();
	}
	
	//  Функция для вывода статьи
	public function view()
	{
		echo "<h1>$this->title</h1><span style='color: red'>".
				strftime('%d.%m.%y', $this->datetime).
				" <b>Новость</b></span><p>$this->content</p>";
	}
}

class CrossArticle extends Article
{
	protected $source;

	public function CrossArticle($id, $title, $content, $source)
	{
		parent::Article($id, $title, $content);
		$this->source = $source;
	}

	public function view()
	{
		parent::view();
		echo '<small>'.$this->source.'</small>';
	}
}

class ArticleList
{
	protected $alist;

	public function add(Article $article)
	{
		$this->alist[] = $article;
	}
	
	//  Вывод статей
	public function view()
	{
		foreach($this->alist as $article)
		{
			$article->view();
			echo '<hr />';
		}
	}

	//Удаление статьи
	public function delete($id)
	{
		for ($i = 0; $i < count($this->alist); $i++)
		{
			if ($this->alist[$i]->get_id() == $id)
				unset($this->alist[$i]);
		}
	}
}

class FullArticle extends Article
{
	protected $img;

	public function FullArticle($id, $title, $content, $img)
	{
		parent::Article($id, $title, $content);
		$this->img = $img;
	}

	//  Функция для вывода статьи
	public function view()
	{
		parent::view();
		echo '<img src="'.$this->img.'" alt="Тут должно быть изображение">';
	}
}

class InverseArticleList extends ArticleList
{
	public function view()
	{
		foreach (array_reverse($this->alist) as $article)
		{
			$article->view();
			echo '<hr />';
		}
	}
}
