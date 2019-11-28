<?php 
require "db.php";
require_once("models/functions.php");

global $link;
$link = mysqli_connect("localhost", "root", "", "pcnews");
$articles = articles_all();
?>

<?php if(isset($_SESSION['logged_user']) ) : ?>

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
<section class="news">   
<?php if ($articles == articles_all()) : ?>
<?php foreach ($articles as $a) : ?>
    <div class="news_section">
        <div>
     	<div class="articles">
     			<h1><a href="views/article.php?id=<?=$a['id'];?>"><?=$a['title']?></a></h1>
     		    <em>Опубліковано: <?=$a['date']?></em>
     		    <p><?=$a['content']?></p>
     	</div>
     	</div>
    </div>
    <div class="aside">
	    <button><a href="#">Редагувати</a></button>
	    <button><a href="#">Видалити</a></button>
	</div>
<?php endforeach; ?>
<?php endif; ?>
<footer>
<button><a href="addnews.php">Створити новину</a></button>
</footer>
</section>


<?php else : ?>

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
</div>
<section class="news">
    <div class="news_section" style="width: 100%;">
     <div>
           <?php if ($articles == articles_all()) : ?>
           	<?php foreach ($articles as $a) : ?>
     		<div class="articles">
     			<h1><a href="views/article.php?id=<?=$a['id'];?>"><?=$a['title']?></a></h1>
     		    <em>Опубліковано: <?=$a['date']?></em>
     		    <p><?=$a['content']?></p>
     		</div>
     	   <?php endforeach; ?>
     	   <?php endif; ?>
     </div>
    </div>
</section>

<?php endif; ?>




