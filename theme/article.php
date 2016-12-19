<?/*
Шаблон просмотра страницы
=======================
$article - статья

статья:
id_article - идентификатор
title - заголвок
content - текст
*/?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
	<title>PHP. Уровень 2</title>
	<meta content="text/html; charset=utf-8" http-equiv="content-type">
	<link rel="stylesheet" type="text/css" media="screen" href="theme/style.css" />
</head>
<body>
<h1>PHP. Уровень 2</h1>
<br/>
<b>Статья №<?=$article['id_article']?></b>
<a href="index.php">На главную</a>
<a href="editor.php">Консоль редактора</a>
<hr/>
	<h3><?=$article['title']?></h3>
	<p><?=$article['content']?></p>
<hr/>
<small><a href="http://prog-school.ru">Школа Программирования</a> &copy;</small>
</body>
</html>
