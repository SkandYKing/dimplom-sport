<?php session_start();
if(isset($_GET['exit'])) //если выход
{
	session_destroy();
	header('Location: http://localhost/inferno/index.php'); //перенаправление в случае выхода
	exit;
}?>
<?
	$host = 'localhost'; //имя хоста, на локальном компьютере это localhost
	$user = 'root'; //имя пользователя, по умолчанию это root
	$password = ''; //пароль, по умолчанию пустой
	$db_name = 'inferno'; //имя базы данных

	$link = mysqli_connect($host, $user, $password, $db_name);

	mysqli_query($link, "SET NAMES 'utf8'");

	$email2 = $_SESSION['email'];
	//изменение пароля
	if (!empty($_POST['password']) and !empty($_POST['password2'])) {

		$email2 = $_SESSION['email'];

		$password = strip_tags($_POST['password']);
		$password2 = strip_tags($_POST['password2']);

		$i=0;
		//проверка на правильность ввода пароля и совпадение
		if(preg_match("#^[a-zA-Z0-9]{6,14}$#", $password)) {
			$i++;
		} else { $prover6='<div class="valid">Некорректный пароль от 6 до 14 символов</div>';}
		if ($password==$password2) {
			$i++;
		} else { $prover4='<div class="valid">Пароли не совпадают</div>'; }

		if ($i==2) {
			//хеширование пароля
			$password = md5($password);
			//обновалние пароля данного пользователя
			$query2 = "UPDATE Users SET Password='$password' WHERE Email='$email2';";
			mysqli_query($link, $query2);

		}
	}
?>
<?php if($_SESSION['role']!='Пользователь') {header('Location: index.php');} ?><!--Проверка по ролям-->
<?php require_once('header.php'); ?><!--шапка-->
<?php require_once('header-user.php'); ?><!--шапка пользователя-->
<div class="cent" id="admin">
	<div class="osntx1">
		<h1 class="zagl">Изменение пароля</h1>

		<form class="form" method="POST"  autocomplete="on">
			<br>
				<input class="textbox input-or" name="password" placeholder="Новый пароль" value='<? echo $_SESSION['password'];?>' required /> <? echo $prover6;?><br>
				<input class="textbox input-or" name="password2" placeholder="Повторите новый пароль" value='<? echo $_SESSION['password2'];?>' required /> <? echo $prover4;?><br>
				<li><a href="profile.php">Профиль</a></li>
				<input class="button bt5"  type="submit" value="Изменить"><br><br>
				<? //вывод сообщения
					if ($i==2) {
						echo '<p style="color:green; font-family: "Open Sans", sans-serif;"> Данные изменены</p>';
					}
				?>
		</form>
	</div>
	</div>
<?php require_once('footer.php') ?><!--подвал-->
