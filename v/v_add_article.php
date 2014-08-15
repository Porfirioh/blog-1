
<div id="article_add">
    <form  class=".form-group" action="index.php?act=add" method="post"  enctype="multipart/form-data">
        <b>Название статьи:</b><br>
        <input class="form-control" type="text" size="50" name="title" required autofocus><br><br>
        <b>Текст статьи:</b><br>
        <textarea class="form-control" cols = "100" rows = "15" name="content" required></textarea><br>
        <button type="submit" class="btn btn-primary">Добавить</button>
    </form>
</div>