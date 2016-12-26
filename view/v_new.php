<a href="index.php">Главная</a> |
<a href="editor.php">Консоль редактора</a>
<hr/>
<h1>Новая статья</h1>
<? if($error) :?>
	<b style="color: red;">Заполните все поля!</b>
<? endif ?>
<form method="post">
	Название:
	<br/>
	<input type="text" name="title" />
	<br/>
	<br/>
	Содержание:
	<br/>
	<textarea name="content"></textarea>
	<br/>
	<input type="submit" value="Добавить" />
</form>
