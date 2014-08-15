
<div class="article_block">
    <div class="article_header">
        <h3><?=$article['title']?></h3>
    </div>
    <div class="article_content">
        <p><?=$article['content']?></p>
    </div>
    <div class="article_footer">
    </div>
</div>

<?php if (count($comments) > 0): ?>
    <div id="comments_form">
        <h3>Текущие комментарии:</h3>
        <?php foreach ($comments as $comment): ?>
           <div><b><?=$comment['author']?>:</b></div>
           <div><?=$comment['content']?></div>
           <hr>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<div id="comment_form">
    <h3>Добавить комментарий</h3>
    <form class=".form-group" action="index.php" method="post"  enctype="multipart/form-data">
        <?php if ($logged_user == null): ?>
            <b>Автор:</b><br>
            <input class="form-control" type="text" size="50" name="author" value=""/><br><br>
        <?php else: ?>
            <input type="hidden" size="50" name="author" value="<?=$logged_user?>" required autofocus>
        <?php endif; ?>
        <b>Текст комментария:</b><br>
        <textarea class="form-control" cols = "100" rows = "10" name="content" required></textarea><br>
        <input type="hidden"  name="act" value="read"/>
        <input type="hidden"  name="id" value="<?=$article_id?>"/>
        <input type="hidden"  name="page" value="<?=$page?>"/>
        <button type="submit" class="btn btn-primary">Добавить</button>
    </form>
</div>



