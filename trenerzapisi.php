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

	$trener_email = $_SESSION['email'];
	$trener_name = $_SESSION['name'];
	//удаление заявки
	if (isset($_POST['del'])) {
		$id = $_POST['id'];
		$query = "DELETE FROM Zapisi WHERE id=$id";
		mysqli_query($link, $query) or die(mysqli_error($link));
	}
	//изменение статуса
	if (isset($_POST['stat2'])) {
		$id = $_POST['id'];
		$query = "UPDATE Zapisi SET Status='Завершен' WHERE id=$id";
		mysqli_query($link, $query) or die(mysqli_error($link));
	}
	//создание индивидуальной тренировки
	if (isset($_POST['individ'])) {
		$id = $_POST['id'];
		$trener_email = $_SESSION['email'];
		$trener_name = $_SESSION['name'];

		$query = "UPDATE Userwork SET trener_email='$trener_email',trener_name='$trener_name' ";
		mysqli_query($link, $query) or die(mysqli_error($link));

		echo '<meta http-equiv="refresh" content="1;URL=trenerindivid.php" />';
	}
	?>
<?php if($_SESSION['role']!='Тренер') {header('Location: index.php');} ?><!--Проверка по ролям-->
<?php require_once('header.php'); ?><!--шапка-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script><!--подключение js jquery-->
<script> //фильтр по статусам
    $(document).ready(function(){
        $('#all').click(function(){
            $(".Свободен").css("display", "inline-block");
            $(".Занят").css("display", "inline-block");
            $(".Завершен").css("display", "inline-block");
        });
        $('#Свободен').click(function(){
            $(".Свободен").css("display", "inline-block");
            $(".Занят").css("display", "none");
            $(".Завершен").css("display", "none");
        });
        $('#Занят').click(function(){
            $(".Свободен").css("display", "none");
            $(".Занят").css("display", "inline-block");
            $(".Завершен").css("display", "none");
        });
        $('#Завершен').click(function(){
            $(".Свободен").css("display", "none");
            $(".Занят").css("display", "none");
            $(".Завершен").css("display", "inline-block");
        });
    });
</script>
<?php require_once('header-trener.php'); ?><!--шапка тренера-->
<div class="cent" id="admin">
		<h1 class="zagl">Просмотр записей</h1>
		<div class="top-menu">
			<ul>
				<li id="all"><p>Все</p></li>
				<li id="Свободен"><p>Свободен</p></li>
                <li id="Занят"><p>Занят</p></li>
                <li id="Завершен"><p>Завершен</p></li>
			</ul>
   	 	</div>
		<div class="row">
			<?php
			//вывод заявок тренировок со статусом свободен и удаление
			$trener_email = $_SESSION['email'];
			$result=mysqli_query($link, "SELECT * FROM Zapisi WHERE trener_email='$trener_email' AND Status='Свободен'") or die(mysqli_error($link));
				while($row = mysqli_fetch_array($result)){
				$id=$row['id'];
				$name=$row['name'];
				$profile=$row['profile'];
				$phone=$row['phone'];
				$status=$row['status'];
				$time=$row['time'];
				$time2=$row['time2'];
				$price=$row['price'];
				$date=$row['date'];
				$img=$row['img'];
				$email=$row['email'];
				$user_email=$row['user_email'];
				$user_name=$row['user_name'];
				$category=$row['category'];		

				echo "<div class='userindivid'>
				<div class='$status'>
				<h3> Заявка №: $id</h3>
				<hr style='border: 1px solid #ff7350; margin-top: 5px; margin-bottom: 5px;'>
				<img src='$img' class='pmenuimg' style='width:150px'>
				<p> Имя: $name</p>
				<p> Специализация: $profile</p>
				<p> Телефон: $phone</p>
				<p> Статус: $status</p>
				<p> Дата: $date</p>
				<p> Время: от $time до $time2</p>
				<p> Почта: $trener_email</p>
				<p> Цена: $price</p>
				<form method='POST'>
					<input style='display:none;' name='id' value='$id' required />
					<input class='button bt7' name='del' type='submit' value='Удалить'>
				</form>	
				</div></div><br>";
				}
			?>
			<?php
			//вывод заявок со статусом занят и изменение статуса
			$trener_email = $_SESSION['email'];
			$result=mysqli_query($link, "SELECT * FROM Zapisi WHERE trener_email='$trener_email' AND Status='Занят'") or die(mysqli_error($link));
				while($row = mysqli_fetch_array($result)){
					$id=$row['id'];
					$name=$row['name'];
					$profile=$row['profile'];
					$phone=$row['phone'];
					$status=$row['status'];
					$time=$row['time'];
					$date=$row['date'];
					$price=$row['price'];
					$img=$row['img'];
					$email=$row['email'];
					$user_email=$row['user_email'];
					$user_name=$row['user_name'];
					$category=$row['category'];	
	
					echo "<div class='userindivid'>
					<div class='$status'>
					<div class='zayavka'>
					<h3> Заявка №: $id</h3>
					<hr style='border: 1px solid #ff7350; margin-top: 5px; margin-bottom: 5px;'>
					<img src='$img' class='pmenuimg' style='width:150px'>
					<p> Имя: $name</b></p>
					<p> Специализация: $profile</p>
					<p> Телефон: $phone</p>
					<p> Статус: $status</p>
					<p> Дата: $date</p>
					<p> Время: от $time до $time2</p>
					<p> Почта: $trener_email</p>
					<p> Цена: $price</p>
					<p> Почта клиента: $user_email</p>
					<p> Имя клиента: $user_name</p>
				<form method='POST'>
					<input style='display:none;' name='id' value='$id' required />
					<input class='button bt7' name='individ' type='submit' value='Назначить'>
					<input class='button bt7' name='stat2' type='submit' value='Изменить статус'>
					<input class='button bt7' name='del' type='submit' value='Удалить'>
				</form>	
				</div></div></div><br>";
				}
			?>
			<?php
			//вывод заявки тренировок со статусом завершен 
			$trener_email = $_SESSION['email'];
			$result=mysqli_query($link, "SELECT * FROM Zapisi WHERE trener_email='$trener_email' AND Status='Завершен'") or die(mysqli_error($link));
				while($row = mysqli_fetch_array($result)){
					$id=$row['id'];
					$name=$row['name'];
					$profile=$row['profile'];
					$phone=$row['phone'];
					$status=$row['status'];
					$time=$row['time'];
					$date=$row['date'];
					$price=$row['price'];
					$img=$row['img'];
					$email=$row['email'];
					$user_email=$row['user_email'];
					$user_name=$row['user_name'];
					$category=$row['category'];	
	
					echo "<div class='userindivid'>
					<div class='$status'>
					<div class='zayavka'>
					<h3> Заявка №: $id</h3>
					<hr style='border: 1px solid #ff7350; margin-top: 5px; margin-bottom: 5px;'>
					<img src='$img' class='pmenuimg' style='width:150px'>
					<p> Имя: $name</p>
					<p> Специализация: $profile</p>
					<p> Телефон: $phone</p>
					<p> Статус: $status</p>
					<p> Дата: $date</p>
					<p> Время: от $time до $time2</p>
					<p> Почта: $trener_email</p>
					<p> Цена: $price</p>
					<p> Почта клиента: $user_email</p>
					<p> Имя клиента: $user_name</p>
				<form method='POST'>
					<input style='display:none;' name='id' value='$id' required />
				</form>	
				</div></div></div><br>";
				}
			?>
		</div>


</div>
	</div>

<?php require_once('footer.php') ?><!--подвал-->