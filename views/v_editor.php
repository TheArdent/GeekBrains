<a href="index.php">Главная</a> |
<b>Консоль редактора</b>
<hr/>
<ul>
	<li>
		<b><a href="new.php">Новая статья</a></b>
	</li>
	<? foreach ($articles as $article): ?>
		<li>
			<a href="edit.php?id=<?=$article['id_article']?>">
				<?=$article['title']?>
			</a>
		</li>
	<? endforeach; ?>
</ul>
