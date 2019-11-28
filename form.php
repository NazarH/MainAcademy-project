<?php 
require "db.php";

$data = $_POST;
if (isset($data['do_send'])) 
{
	$errors = array();

    if (trim($data['email']) == '') 
	{
		$errors[] = 'Введіть email';
	}

	if (trim($data['login']) == '') 
	{
		$errors[] = 'Введіть логін';
	}

	if ($data['password'] == '') 
	{
		$errors[] = 'Введіть пароль';
	}

	if ($data['password_2'] != $data['password']) 
	{
		$errors[] = 'Не вірний повторний пароль';
	}

	if (R::count('users', "login = ?", array($data['login'])) > 0  ) 
	{
		$errors[] = 'Логін зайнятий';
	}

	if (R::count('users', "email = ?", array($data['email'])) > 0  ) 
	{
		$errors[] = 'Email зайнятий';
	}

	if (empty($errors)){
		$user = R::dispense('users');
		$user->login = $data['login'];
		$user->email = $data['email'];
		$user->password = password_hash($data['password'], PASSWORD_DEFAULT);
		R::store($user);
		echo '<script type="text/javascript">window.location = "reg_success.php"</script>';
	}else{
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
<section class="form">
	<form action="form.php" method="POST">    
	    <span>
	    Введіть email
	    </span>
	    <input type="email" name="email">
	    
	    <span>
	    Введіть логін
	    </span>
		<input type="text" name="login">
		
		<span>
		Введіть пароль
		</span>
		<input type="password" name="password">
		
		<span>
		Повторіть пароль
		</span>
		<input type="password" name="password_2">

		<textarea disabled>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Similique maxime, sit assumenda voluptatum! Aperiam ipsum dicta minima, quas corporis fuga. Ducimus doloremque eveniet fugit aliquid! Quod tempora, dolorem inventore dicta voluptas possimus cumque eligendi ipsum facilis eaque atque ex, et quibusdam repudiandae deserunt, excepturi. Sunt eveniet qui voluptas dolore praesentium at eos, quibusdam suscipit cupiditate itaque molestias impedit veritatis. Officia, maiores, eius molestiae tenetur quam praesentium eligendi quia sapiente, expedita amet nisi, vero provident. Voluptates iure molestiae sequi illo sunt nobis culpa, et sit nam debitis pariatur voluptate distinctio quos voluptatem, accusamus error saepe a laborum ullam, alias. Nesciunt eos delectus, vero soluta nisi tempore. Repellat corporis impedit, libero iste distinctio, voluptatibus delectus reprehenderit quo eum quas assumenda voluptas harum cupiditate facilis possimus nemo fuga cum ab fugit eligendi perferendis! Iste ea reiciendis cum doloremque alias officiis excepturi voluptates molestiae, porro distinctio facilis possimus ratione, velit animi nulla aliquid, aut.</textarea>
        
        <div>
		<span>
		Я підтверджую, що згоден з умовами та правилами, вказаними в користувацькій угоді. 
		</span>
		</div>
		<div>
		<input type="checkbox" name="check">
		<button type="submit" name="do_send">Відправити</button>
        <button disabled="disabled">Відправити</button>	
        </div>
	</form>
</section>
</div>
