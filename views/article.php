<?php
error_reporting(0);

require "../db.php";
require_once("../models/functions.php");
$data = $_GET;
$article = articles_get($data['id']);
?>

<?php if(isset($_SESSION['logged_user']) ) : ?>
	<head>
	<title>PC-NEWS</title>
	<meta charset="utf-8">
	<link rel="shortcut icon" href="../img/logo.png" type="image/png">
	<link rel="stylesheet" type="text/css" href="../css/style.css">
	<link rel="stylesheet" type="text/css" href="../css/flex.css">
</head>
<body>
<header>
<div class="header_nav">
	<div class="logo">
		<span>PC</span><a href="../index.php"><img src="../img/logo.png"></a><span>NEWS</span>
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
	    <a href="../profile.php"><li><?php echo $_SESSION['logged_user']->login; ?></li></a>
		<a href="../logout.php"><li>ВИЙТИ</li></a>
		</ul>
	</div>
</header>
</div>
<section class="container">
    <div>
         <div class="article">
         	<h1><?=$article['title']?></h1>
         	<p><?=$article['content']?></p>
         	<em>Опубліковано: <?=$article['date']?></em>
         </div>
    </div>
</section>

<?php else : ?>

<head>
	<title>PC-NEWS</title>
	<meta charset="utf-8">
	<link rel="shortcut icon" href="../img/logo.png" type="image/png">
	<link rel="stylesheet" type="text/css" href="../css/style.css">
	<link rel="stylesheet" type="text/css" href="../css/flex.css">
</head>
<body>
<header>
<div class="header_nav">
	<div class="logo">
		<span>PC</span><a href="../index.php"><img src="../img/logo.png"></a><span>NEWS</span>
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
			<a href="../login.php"><li>ВХІД</li></a>
			<a href="../form.php"><li>РЕЄСТРАЦІЯ</li></a>
		</ul>
	</div>
</header>
</div>
<section class="container">
    <div>
         <div class="article">
         	<h1><?=$article['title']?></h1>
         	<em>Опубліковано: <?=$article['date']?></em>
         	<p><?=$article['content']?></p>
         </div>
    </div>
</section>

<?php endif; ?>
