
<div id="article_edit">
    <form class=".form-group" action="index.php?act=edit&id=<?=$article_id?>" method="post"  enctype="multipart/form-data">
        <b>Название статьи:</b><br>
        <input class="form-control" type="text" size="100" name="title" value="<?=$article_title?>" required autofocus><br><br>
        <b>Текст статьи:</b><br>
        <textarea class="form-control" cols = "100" rows = "15" name="content" required><?=$article_content?></textarea><br>
        <button type="submit" class="btn btn-primary">Обновить</button>
    </form>
</div>