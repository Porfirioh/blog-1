<!DOCTYPE html>
<html>
<head>
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="stylesheet" href="css/styles.css" type="text/css" media="screen"/>
    <title><?=$title?></title>
    <!-- Bootstrap core CSS -->
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">

    <!-- Custom styles for this template -->
    <link href="css/signin.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
    <div id="auth">
        <?php if ($logged_user == null): ?>
            <a href = "index.php?act=login&c=users&t=auth">Войти</a>
            <a href = "index.php?act=reg&c=users&t=reg">Регистрация</a>
        <?php else: ?>
            <span>Привет, <?=$logged_user?></span>
            <a href = "index.php?act=logout&c=users">Выйти</a>
        <?php endif; ?>
    </div>

    <div id="wrapper">

		<div id="header">
			<h1><?=$title?></h1>	
		</div>
        <div id="menu">
            <?php foreach ($menu  as $menu_item_title => $menu_link) :?>
                <div class="menu_item">
                    <a href="<?=$menu_link?>"><?=$menu_item_title?></a>
                </div>
            <?php endforeach; ?>
        </div>

        <?php if (count($blocks) > 0): ?>
            <div id="left_column">
                <?= $content ?>
            </div>
            <div id="right_column">
                <?php foreach ($blocks as $block_title => $block_content) : ?>
                    <div class="right_block">
                        <div class="right_block_header"><h4><?= $block_title ?>:</h4></div>
                        <div class="right_block_content">

                            <?php foreach ($block_content as $content) : ?>
                                <div class="block_item_content"><a href="<?=$content['link']?>"><?=$content['title']?></a></div>
                            <?php endforeach; ?>

                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div>
                <?= $content ?>
            </div>
        <?php endif; ?>


        <div id="footer">
        Blogs 2014
        </div>
	</div>	
</body>
</html>
