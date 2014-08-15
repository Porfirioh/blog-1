<!DOCTYPE html>
<html>
<head>
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
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
<!--
    <div id="reg_form">
        <form action = "index.php" method = "post">
            <?if ($error_msg != '') echo "<div id=\"error_msg\">$error_msg</div>"?>
            <span>Ваше имя:</span>
            <input type = "text" name = "name">
            <span>Логин (email):</span>
            <input type = "text" name = "login">
            <span>Пароль:</span>
            <input type = "password" name = "password">
            <span>Повторите пароль:</span>
            <input type = "password" name = "repeated_password">
            <input class="auth_reg_button" type = "submit" value = "Зарегистрироваться">
            <a class="home_ref" href="index.php">На главную</a>
            <input type = "hidden" name = "act" value="reg">
            <input type = "hidden" name = "c" value="users">
            <input type = "hidden" name = "t" value="reg">
        </form>
    </div>
-->
    <div class="container">

        <form class="form-signin" role="form" action = "index.php" method = "post">
            <h2 class="form-signin-heading">Пожалуйста зарегистрируйтесь</h2>
            <?if ($error_msg != '') echo "<div id=\"error_msg\">$error_msg</div>"?>
            <input type="text" class="form-control" placeholder="Ваше имя" name="name" required autofocus>
            <input type="text" class="form-control" placeholder="Ваш логин(e-mail)" name="login" required>
            <input type="password" class="form-control no_bottom_margin" placeholder="Пароль" name = "password" required>
            <input type="password" class="form-control" placeholder="Повторите пароль" name = "repeated_password" required>
            <button class="btn btn-lg btn-primary btn-block" type="submit">Зарегистрироваться</button>
            <input type = "hidden" name = "act" value="reg">
            <input type = "hidden" name = "c" value="users">
            <input type = "hidden" name = "t" value="reg">
        </form>

    </div>
</body>
</html>
