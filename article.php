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
include('theme/article.php');