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
	//выбор из таблицы тренировок кол. 10
	$query = "SELECT * FROM Zapisi LIMIT 10";
    $result = mysqli_query($link, $query);

	?>
<?php if($_SESSION['role']!='Администратор') {header('Location: index.php');} ?><!--Проверка по ролям-->
<?php require_once('header.php'); ?><!--шапка-->
<?php require_once('header-admin.php'); ?><!--шапка админа-->
<div class="cent" id="admin">
		<h1 class="zagl">Управление тренировками</h1>
		<div class="row">
			<?php
			//вывод заявок на тренировку где статус свободен
			$result=mysqli_query($link, "SELECT * FROM Zapisi WHERE Status='Свободен'") or die(mysqli_error($link));
				while($row = mysqli_fetch_array($result)){
				$id=$row['id'];
                $name =$row['name'];
                $profile=$row['profile'];
                $stage=$row['stage'];
                $phone=$row['phone'];
				$status =$row['status'];
				$time=$row['time'];
                $time2=$row['time2'];
				$price=$row['price'];
				$date=$row['date'];
				$trener_email= $row['trener_email'];
				$user_email =$row['user_email'];
                $user_name=$row['user_name'];

				echo "<div class='userindivid'>
				<div class='zayavka'>
				<h3>Номер тренировки: $id</h3>
				<hr style='border: 1px solid #ff7350; margin-top: 5px; margin-bottom: 5px;'>
				<p> Имя тренера: $name</p>
                <p> Email тренера: $trener_email</p>
				<p> Специализация: $profile</p>
				<p> Стаж: $stage</p>
				<p> Телефон: $phone</p>
				<p> Дата: $date</p>
				<p> Время от: $time до $time2</p>
				<p> Цена: $price</p>
				<p> Статус: $status</p>

				<form method='POST'>
					<input style='display:none;' name='id' value='$id' required />
				</form>
				</div></div><br>";
				}
			?>
		</div>
        <div class="row">
			<?php
			//вывод заявок на тренировку где статус новый
			$result=mysqli_query($link, "SELECT * FROM Zapisi WHERE Status='Новый'") or die(mysqli_error($link));
				while($row = mysqli_fetch_array($result)){
				$id=$row['id'];
                $name =$row['name'];
                $profile=$row['profile'];
                $stage=$row['stage'];
                $phone=$row['phone'];
				$status =$row['status'];
				$time=$row['time'];
                $time2=$row['time2'];
				$price=$row['price'];
				$date=$row['date'];
				$trener_email= $row['trener_email'];
				$user_email =$row['user_email'];
                $user_name=$row['user_name'];

				echo "<div class='userindivid'>
				<div class='zayavka'>
				<h3>Номер тренировки: $id</h3>
				<hr style='border: 1px solid #ff7350; margin-top: 5px; margin-bottom: 5px;'>
				<p> Имя тренера: $name</p>
                <p> Email тренера: $trener_email</p>
				<p> Специализация: $profile</p>
				<p> Стаж: $stage</p>
				<p> Телефон: $phone</p>
				<p> Дата: $date</p>
				<p> Время от: $time до $time2</p>
				<p> Цена: $price</p>
				<p> Имя пользователя: $user_name</p>
                <p> Email пользователя: $user_email</p>
				<p> Статус: $status</p>

				<form method='POST'>
					<input style='display:none;' name='id' value='$id' required />
				</form>

				</div></div><br>";
				}
			?>
		</div>
		<div class="row">
			<?php
			//вывод заявок на тренировку где статус завершен
			$result=mysqli_query($link, "SELECT * FROM Zapisi WHERE Status='Завершен'") or die(mysqli_error($link));
				while($row = mysqli_fetch_array($result)){
				$id=$row['id'];
                $name =$row['name'];
                $profile=$row['profile'];
                $stage=$row['stage'];
                $phone=$row['phone'];
				$status =$row['status'];
				$time=$row['time'];
                $time2=$row['time2'];
				$price=$row['price'];
				$date=$row['date'];
				$trener_email= $row['trener_email'];
				$user_email =$row['user_email'];
                $user_name=$row['user_name'];

				echo "<div class='userindivid'>
				<div class='zayavka'>
				<h3>Номер тренировки: $id</h3>
				<hr style='border: 1px solid #ff7350; margin-top: 5px; margin-bottom: 5px;'>
				<p> Имя тренера: $name</p>
                <p> Email тренера: $trener_email</p>
				<p> Специализация: $profile</p>
				<p> Стаж: $stage</p>
				<p> Телефон: $phone</p>
				<p> Дата: $date</p>
				<p> Время от: $time до $time2</p>
				<p> Цена: $price</p>
				<p> Имя пользователя: $user_name</p>
                <p> Email пользователя: $user_email</p>
				<p> Статус: $status</p>

				<form method='POST'>
					<input style='display:none;' name='id' value='$id' required />
				</form>
				</div></div><br>";
				}
			?>
		</div>


	</div>
	</div>
<?php require_once('footer.php') ?><!--Подвал-->

	
