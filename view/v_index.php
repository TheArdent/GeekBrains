<b><?=$title?></b>
<a href="editor.php">Консоль редактора</a>
<hr/>
<ul>
	<? foreach ($articlesIntro as $article_intro): ?>
		<li>
			<a href="article.php?id=<?=$article_intro['id_article']?>">
				<?=$article_intro['title']?>
			</a>
			<?=$article_intro['content']?>
		</li>
	<? endforeach; ?>
</ul>
