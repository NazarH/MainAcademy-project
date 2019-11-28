<?php 
require "db.php";
?>

<!--                     Персональний кабінет                    -->

<?php 
error_reporting(0);

global $link;
$link = mysqli_connect("localhost", "root", "", "pcnews");
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

global $data;
$data = $_POST;
$hash = $_SESSION['logged_user']->password;
$id   = $_SESSION['logged_user']->id;

if (isset($data['edit'])){
$errors = array();
    if ($data['new_email'] == $_SESSION['logged_user']->email) 
    {
    	$errors[] = 'Поточний email';
    }
    if (!(password_verify($data['cur_password'], $hash))) 
    {
    	$errors[] = 'Не вірний поточний пароль';
    }

    if (!($data['new_password'] == ''))
    {
    	$data['new_password'] = password_hash($data['new_password'], PASSWORD_DEFAULT);
    }
    
    if (empty($errors)) 
    {
    	$sql = NULL;
    	$sql2 = NULL;
        if ($data['new_email'] == ''){}
        else
        {
        $_SESSION['logged_user']->email = $data['new_email'];
        $sql = "UPDATE users 
                SET email='$data[new_email]' 
                WHERE id='$id'";	
        }
        if ($data['new_password'] == ''){}
        else{
        $_SESSION['logged_user']->password = $data['new_password'];
        $sql2 = "UPDATE users 
                 SET password='$data[new_password]' 
                 WHERE id='$id'";
        }
        
        if(mysqli_query($link, $sql)){
             echo '<div style="color: green; font-family: FreeMono, monospace; font-weight:bold;; position: relative; left: 45%; margin:auto;">Інформацію оновлено</div><hr>';
        } else {}

        if(mysqli_query($link, $sql2)){
             echo '<div style="color: green; font-family: FreeMono, monospace; font-weight:bold;; position: relative; left: 45%; margin:auto;">Інформацію оновлено</div><hr>';
        } else {}

    }else{
        echo '<div style="color: red; font-family: FreeMono, monospace; font-weight:bold; position: relative; left: 45%;">'
                .array_shift($errors).'</div><hr>';
          }
    }       
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
	    <a href=""><li><?php echo $_SESSION['logged_user']->login; ?></li></a>
		<a href="logout.php"><li>ВИЙТИ</li></a>
		</ul>
	</div>
</header>
</div>
<section class="profile">
	<form action="profile.php" method="POST">
	    <table>
	    	<tr>
	    		<td>Ваш логін:</td>
	    		<td><?php  
	    		          $s_login = 'Admin';
	    		          if($_SESSION['logged_user']->login == $s_login){
                               echo "<p style='color: red;'>".$_SESSION['logged_user']->login."</p>";
	    		       	  }else{
                               echo $_SESSION['logged_user']->login;
	    		       	  }?>
	    		       	  	
	    		</td>
	    	</tr>
	    	<tr>
	    		<td>Ваш email:</td>
	    		<td><?php echo $_SESSION['logged_user']->email; ?></td>
	    	</tr>
	    	<tr>
	    		<td>Змінити email:</td>
	    		<td><input type="email" name="new_email"></td>
	    	</tr>
	    	<tr>
	    	    <td>Змінити пароль:</td>
	    		<td><input type="password" name="new_password"></td>
	    	</tr>
	    	<tr>
	    		<td>Поточний пароль:</td>
	    		<td><input type="password" name="cur_password"></td>
	    	</tr>
	    </table>	    
		<button type="submit" name="edit">Змінити</button>
	</form>

<!--                     Адм. панель                    -->

<?php  
$adm_login = 'Admin';
if ($_SESSION['logged_user']->login == $adm_login) : ?>
<div class="adm_panel">
<table class="table_users" bordercolor='black' border='2'>
<tr><th style="border: 2px solid black;">ID</th><th>Логін</th></tr>

<?php 

$query = mysqli_query($link, 'SELECT * FROM `users`');
if (mysqli_num_rows($query)) {
	while ($row = mysqli_fetch_assoc($query)) {
		echo "<tr><td style='text-align: center; border: 2px solid black;'>".$row['id']."</td><td style='text-align: center; border: 2px solid black;'>".$row['login']."</td></tr>";
	}
}
?>
</table>	

<!--                     Видалення юзера                    -->

<?php 
if(isset($data['delete'])){
	mysqli_query($link,'DELETE FROM `users` WHERE `users`.`id`='.$data['id']);
	echo '<script type="text/javascript">window.location = "profile.php"</script>';
}
?>
<form action="profile.php" method="POST" class="delete">
<input type="text" placeholder="ID" name="id">
<button type="submit" name="delete">Видалити</button>
</form>
</div>

<?php else : ?>
<?php endif ?>

</section>
<?php endif; ?>