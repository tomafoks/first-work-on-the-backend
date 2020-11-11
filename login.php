<?php
require_once "./php/class.login.user.php";
$title = "Авторизация";
$loginUser = new LoginUser();

$output = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	if (!isset($_SESSION['randStr'])) {
		$output = "включите отображение картинок!";
	} else {
		if ($_SESSION['randStr'] == strtolower($_POST['noise'])) {
			$output = 'yes';
			$title = $loginUser->getUserName($_POST['email'], $_POST['pw']);
		} else
			$output = 'no';
	}
}
?>

<!DOCTYPE HTML>
<html>

<head>
	<title>Авторизация</title>
	<meta charset="utf-8">
</head>

<body>
	<h1><?= $title ?></h1>
	<h2><?= $output ?></h2>
	<img src="/php/noise-picture.php" alt="CAPTCHA">
	<form action="<?= $_SERVER['REQUEST_URI'] ?>" method="post">
		<div>
			<label for="txtUser">E-mail</label>
			<input id="txtUser" type="text" name="email" />
		</div>
		<div>
			<label for="txtString">Пароль</label>
			<input id="txtString" type="password" name="pw" />
		</div>
		<div>
			<label for="txtString">Символы с картинки</label>
			</br>
			<input id="txtString" type="text" name="noise" />
		</div>
		<div>
			<button type="submit">Войти</button>
		</div>
	</form>
	</br>
	<a href="index.php"><button>На главную</button></a>
</body>

</html>