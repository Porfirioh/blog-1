<?php foreach ($articles as $article) :?>
    <div class="article_block">
        <div class="article_header">
	        <h3><?=$article['title']?></h3>
            Автор: <?=$article['login']?>
        </div>
        <div class="article_content">
	        <p><?=$article['content']?></p>
        </div>
        <div class="article_footer">
	        <a href="index.php?act=read&id=<?=$article['id']?>&page=<?=$page?>">Читать статью</a>
        </div>
    </div>
<?php endforeach; ?>
<div id="page_navigator">
	Страницы:
	<?php
	for ($i = 1; $i <= $pages ; $i++){
		echo "<a href=\"index.php?page=$i\">$i</a>";
	}
	?>
</div>
