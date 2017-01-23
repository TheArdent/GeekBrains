<b><?=$title?></b>
<hr/>
<ul>
	<? foreach ($articles as $article_intro): ?>
		<li>
			<a href="index.php?action=one&ctrl=News&id=<?=$article_intro['id_article']?>">
				<?=$article_intro['title']?>
			</a>
			<?=$article_intro['content']?>
		</li>
	<? endforeach; ?>
</ul>
