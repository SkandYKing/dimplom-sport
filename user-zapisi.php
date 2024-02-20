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

	$user_email = $_SESSION['email'];
	$user_name = $_SESSION['name'];
	//запись на выбранную тренировку
	if (isset($_POST['zap'])) {
		$id = $_POST['id'];
		$user_id = $_SESSION['email'];
		$query = "UPDATE Zapisi SET user_email='$user_email' WHERE id='$id';";
		mysqli_query($link, $query) or die(mysqli_error($link));

		$query = "UPDATE Zapisi SET user_name='$user_name' WHERE id='$id';";
		mysqli_query($link, $query) or die(mysqli_error($link));

		$query = "UPDATE Zapisi SET Status='Занят' WHERE id=$id";
		mysqli_query($link, $query) or die(mysqli_error($link));


		$user_email = $_SESSION['email'];
		$user_name = $_SESSION['name'];
		//создание записей на индивидуальную тренировку
		$query2 = "INSERT INTO Userwork (zagolovok, text, status, trener_email, trener_name, user_email, user_name) VALUES('$zagolovok','$text','Новый','$trener_email','$trener_name','$user_email','$user_name');";
		mysqli_query($link, $query2);

	}

	?>
<?php if($_SESSION['role']!='Пользователь') {header('Location: index.php');} ?><!--Проверка по ролям-->
<?php require_once('header.php'); ?><!--шапка-->
<?php require_once('header-user.php'); ?><!--шапка пользователя-->
<div class="cent" id="admin">
		<h1 class="zagl">Выберите тренировку</h1>
		<div class="grid-container11">
			<?php
			//вывод записей на тренировку и кнопка записаться
			$result=mysqli_query($link, "SELECT * FROM Zapisi WHERE Status='Свободен'") or die(mysqli_error($link));
				while($row = mysqli_fetch_array($result)){
				$id=$row['id'];
				$name=$row['name'];
				$profile=$row['profile'];
				$phone=$row['phone'];
				$date=$row['date'];
				$status=$row['status'];
				$time=$row['time'];
				$time2=$row['time2'];
				$price=$row['price'];
				$img=$row['img'];
				$email=$row['email'];
				$user_id=$row['user_id'];


				echo "<div class='item11' style='box-shadow: 0px 1px 15px 1px rgb(69 65 78 / 20%); margin: 20px; padding: 10px;'>
				<div class='menuimg'><img src='$img' class='zapimg'></div>
				<p> Имя: $name</p>
				<p> Специализация: $profile</p>
				<p> Телефон: $phone</p>
				<p> Дата: $date</p>
				<p> Время: от $time до $time2</p>
				<p> Цена: $price</p>
				<form method='POST'>
					<input style='display:none;' name='id' value='$id' required />
					<input name='zap' class='button bt6' type='submit' value='Записаться'>
				</form>	
				</div>";
				}
			?>
		</div>


	<div id="clear"></div>
	</div>

<?php require_once('footer.php') ?><!--подвал-->