<?php 
require "db.php";
?>

<?php 
$s_login = 'Admin';
if($_SESSION['logged_user']->login == $s_login) : ?>
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
	    <a href="profile.php"><li><?php echo $_SESSION['logged_user']->login; ?></li></a>
		<a href="logout.php"><li>ВИЙТИ</li></a>
		</ul>
	</div>
</header>
</div>
<section class="addnews"> 
	<form action="addnews.php" method="POST">
	    
	    <span>Заголовок</span>
		<input type="text" name="title">
		
		<span>Дата</span>
		<input type="date" name="date">

        <span style="position: relative; margin-bottom: -13px;">Вміст</span>
		<textarea name="content"></textarea>
		<button type="submit" name="send">Опублікувати</button>
	</form>
</section>

<?php endif; ?>