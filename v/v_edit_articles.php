<?php foreach ($articles as $article) :?>
	<div class="articles_manage">
        <h3><?=$article['title']?></h3>
	    <a href="index.php?act=edit&id=<?=$article['id']?>">Редактировать</a>
	    <a href="index.php?act=delete&id=<?=$article['id']?>">Удалить</a>
    </div>
<?php endforeach; ?>

