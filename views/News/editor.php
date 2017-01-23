<a href="index.php">Главная страница</a>
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
