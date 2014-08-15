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
    <div id="login_form">
        <form action = "index.php" method = "post">
            <?//if ($error_msg != '') echo "<div id=\"error_msg\">$error_msg</div>"?>
            <span>Логин:</span>
            <input type = "text" name = "login">
            <span>Пароль:</span>
            <input type = "password" name = "password">
            <input type = "checkbox" name = "remember"> Запомнить меня
            <br>
            <input class="auth_reg_button"  type = "submit" value = "Войти">
            <a class="home_ref" href="index.php">На главную</a>
            <input type = "hidden" name = "act" value="login">
            <input type = "hidden" name = "c" value="users">
            <input type = "hidden" name = "t" value="auth">
        </form>
    </div>
    -->

    <div class="container">

        <form class="form-signin" role="form" action = "index.php" method = "post">
            <h2 class="form-signin-heading">Пожалуйста авторизуйтесь</h2>
            <?if ($error_msg != '') echo "<div id=\"error_msg\">$error_msg</div>"?>
            <input type="text" class="form-control" placeholder="Email" name="login" required autofocus>
            <input type="password" class="form-control" placeholder="Пароль" name = "password" required>
            <div class="checkbox">
                <label>
                    <input type="checkbox" value="remember-me" name = "remember"> Запомнить меня
                </label>
                <!--<a class="home_ref" href="index.php">На главную</a>-->
            </div>
            <button class="btn btn-lg btn-primary btn-block" type="submit">Войти</button>
            <input type = "hidden" name = "act" value="login">
            <input type = "hidden" name = "c" value="users">
            <input type = "hidden" name = "t" value="auth">
        </form>

    </div>
</body>
</html>
