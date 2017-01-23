<a href="/">Главная страница</a>
<hr/>
<ul>
	<li>
		<b><a href="Admin/Add">Новая статья</a></b>
	</li>
	<? foreach ($articles as $article): ?>
		<li>
			<a href="Admin/Edit/?id=<?=$article['id_article']?>">
				<?=$article['title']?>
			</a>
		</li>
	<? endforeach; ?>
</ul>
