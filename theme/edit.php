<?/*
Шаблон главной страницы
=======================
$title - заголовок
$content - содержание
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
<a href="index.php">Главная</a> |
<a href="editor.php">Консоль редактора</a>
<hr/>
<h1>Редактор статьи</h1>
<? if($error) :?>
    <b style="color: red;">Заполните все поля!</b>
<? endif ?>
<form method="post">
    Название:
    <br/>
    <input type="text" name="title" value="<?=$article['title']?>" />
    <br/>
    <br/>
    Содержание:
    <br/>
    <textarea name="content"><?=$article['content']?></textarea>
    <br/>
    <input type="submit" value="Изменить" />
    <button name="delete_id" value="<?=$article['id_article']?>">Удалить</button>
</form>


<hr/>
<small><a href="http://prog-school.ru">Школа Программирования</a> &copy;</small>
</body>
</html>
