<a href="index.php">Главная</a> |
<b>Консоль редактора</b>
<hr/>
<ul>
	<li>
		<b><a href="index.php?ctrl=Admin&action=Add">Новая статья</a></b>
	</li>
	<? foreach ($articles as $article): ?>
		<li>
			<a href="index.php?ctrl=Admin&action=Edit&id=<?=$article['id_article']?>">
				<?=$article['title']?>
			</a>
		</li>
	<? endforeach; ?>
</ul>
