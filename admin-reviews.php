<?php session_start();
if(isset($_GET['exit'])) //если выход
{
	session_destroy();
	header('Location: http://localhost/inferno/index.php'); //перенаправление в случае выхода
	exit;
}

	$host = 'localhost'; //имя хоста, на локальном компьютере это localhost
	$user = 'root'; //имя пользователя, по умолчанию это root
	$password = ''; //пароль, по умолчанию пустой
	$db_name = 'inferno'; //имя базы данных

	$link = mysqli_connect($host, $user, $password, $db_name);

	mysqli_query($link, "SET NAMES 'utf8'");
	//удалить отзыв
	if (isset($_POST['del'])) {
		$id = $_POST['id'];
		$query = "DELETE FROM Reviews WHERE id=$id";
		mysqli_query($link, $query) or die(mysqli_error($link));
	}

?>
<?php if($_SESSION['role']!='Администратор') {header('Location: index.php');} ?><!--Проверка по ролям-->
<?php require_once('header.php'); ?><!--шапка-->
<?php require_once('header-admin.php'); ?><!--шапка админа-->
	<div class="cent" id="glav">
	<h1 class="zagl">Отзывы</h1>
		<div class="row">
			<?php
			//вывод отзывов и возможность удаления
			$result=mysqli_query($link, "SELECT * FROM Reviews") or die(mysqli_error($link));
				while($row = mysqli_fetch_array($result)){
				$id=$row['id'];
				$name=$row['name'];
				$phone=$row['phone'];
				$comment=$row['comment'];

				echo "<div class='userindivid'>
				<div class='zayavka2'>
				<p> ФИО: <b>$name</b></p>
				<p> Телефон: <b>$phone</b></p>
				<p> Комментарий: <b>$comment</b></p>
				<form method='POST'>
				<input style='display:none;' name='id' value='$id' required />
					<input class='button bt12' name='del' type='submit' value='Удалить'>
				</form>
				</div></div><br>";
				}
			?>
		</div>

	<div id="clear"></div>
	</div>
	
<?php require_once('footer.php') ?><!--Подвал-->