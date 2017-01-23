<a href="/">Главная страница</a>
<hr/>
<h1>Редактор статьи</h1>
<? if($error) :?>
	<b style="color: red;">Заполните все поля!</b>
<? endif ?>
<form method="post" action="Admin/Edit/?id=<?=$article['id_article']?>">
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