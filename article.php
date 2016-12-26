<h2>Просмотр статьи</h2>
<?php
include_once('startup.php');
include_once('model.php');

// Установка параметров, подключение к БД, запуск сессии.
startup();

// Извлечение стать.

$article = articles_get(isset($_GET['id'])? $_GET['id'] : False);

// Кодировка.
header('Content-type: text/html; charset=utf-8');

// Вывод в шаблон.

$title = $article['title'];

// Внутренний шаблон.
$content = view_include('view/v_article.php',array('title' => $title,'article' => $article));


// Внешний шаблон.

$page = view_include(
	'view/v_main.php',
	array('title' => $title, 'content' => $content)
);

// Вывод.
echo $page;
