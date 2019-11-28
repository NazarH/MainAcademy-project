<?php
  require "db.php";

  $data = $_POST;
  if (isset($data['do_login'])) {
  	$errors = array();
  	$user = R::findOne('users', 'login = ?', array($data['login']));
  	if ($user) {
  		if (password_verify($data['password'], $user->password)) {
  			$_SESSION['logged_user'] = $user;
  			echo '<script type="text/javascript">window.location = "index.php"</script>';
  		}else{
  			$errors[] = "Пароль не вірний";
  		}
  	}else{
  		$errors[] = "Логін не існує";
  	}

    if (!empty($errors)){
        echo '<div style="color: red; font-family: FreeMono, monospace; font-weight:bold; position: relative; left: 46.5%;">'
        .array_shift($errors).'</div><hr>';
	}
  }
?>

<head>
	<title>PC-NEWS</title>
	<meta charset="utf-8">
	<link rel="shortcut icon" href="img/logo.png" type="image/png">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="css/flex.css">
</head>
<body>

<header>
<div class="header_nav">
	<div class="logo">
		<span>PC</span><a href="index.php"><img src="img/logo.png"></a><span>NEWS</span>
	</div>
	<div class="nav">
		<ul>
			<a href=""><li>ФОРУМ</li></a>
			<a href=""><li>ЧАТ</li></a>
			<a href=""><li>ПРО САЙТ</li></a>
		</ul>
	</div>
	<div class="log_reg">
		<ul>
			<a href="login.php"><li>ВХІД</li></a>
			<a href="form.php"><li>РЕЄСТРАЦІЯ</li></a>
		</ul>
	</div>
</header>

<section class="login">
<form action="login.php" method="POST">
	    <span>
	    Введіть нікнейм
	    </span>
		<input type="text" name="login">
		
		<span>
		Введіть пароль
		</span>
		<input type="password" name="password">

        <div>
		<button type="submit" name="do_login">Увійти</button>
	    </div>
</form>
</section>
</div>