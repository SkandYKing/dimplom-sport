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
	//выбор таблицы звонки длиной 10
	$query = "SELECT * FROM Calls LIMIT 10";
    $result = mysqli_query($link, $query);
	//изменение статуса на завершен
	if (isset($_POST['stat'])) {
		$id = $_POST['id'];
		$query = "UPDATE Calls SET Status='Завершен' WHERE id=$id";
		mysqli_query($link, $query) or die(mysqli_error($link));
	}
	//удаление по id
	if (isset($_POST['del'])) {
		$id = $_POST['id'];
		$query = "DELETE FROM Calls WHERE id=$id";
		mysqli_query($link, $query) or die(mysqli_error($link));
	}
	?>
<?php if($_SESSION['role']!='Администратор') {header('Location: index.php');} ?><!--Проверка по ролям-->
<?php require_once('header.php'); ?><!--шапка-->
<?php require_once('header-admin.php'); ?><!--шапка админа-->

	<div class="cent" id="admin">
		<h1 class="zagl">Звонки</h1>
		
		<div class="row">
			<?php
			//вывод звонков из таблицы со статусом новый
			$result=mysqli_query($link, "SELECT * FROM Calls WHERE Status='Новый'") or die(mysqli_error($link));
				while($row = mysqli_fetch_array($result)){
				$id=$row['id'];
				$name=$row['name'];
				$phone=$row['phone'];
				$direction=$row['direction'];
				$status=$row['status'];

				echo "<div class='userindivid'>
				<div class='zayavka2'>
				<p> ФИО: $name</p>
				<p> Телефон: $phone</p>
				<p> Направление: $direction</p>
				<p> Статус: $status</p>
				<form method='POST'>
				<input style='display:none;' name='id' value='$id' required />
					<input class='button bt12' name='stat' type='submit' value='Изменить статус'>
					<input class='button bt12' name='del' type='submit' value='Удалить'>
				</form>
				</div></div><br>";
				}
			?>
		</div>
		<div class="row">
			<?php
			//вывод звонков из таблицы со статусом завершен
			$result=mysqli_query($link, "SELECT * FROM Calls WHERE Status='Завершен'") or die(mysqli_error($link));
				while($row = mysqli_fetch_array($result)){
				$id=$row['id'];
				$name=$row['name'];
				$phone=$row['phone'];
				$direction=$row['direction'];
				$status=$row['status'];

				echo "<div class='userindivid'>
				<div class='zayavka2'>
				<p> ФИО: $name</p>
				<p> Телефон: $phone</p>
				<p> Направление: $direction</p>
				<p> Статус: $status</p>
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