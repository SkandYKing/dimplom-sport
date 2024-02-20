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

	?>
<?php if($_SESSION['role']!='Пользователь') {header('Location: index.php');} ?><!--Проверка по ролям-->
<?php require_once('header.php'); ?><!--шапка-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script><!--подключение js jquery-->
<script> //фильтр по статусам
    $(document).ready(function(){
        $('#all').click(function(){
            $(".Занят").css("display", "inline-block");
            $(".Завершен").css("display", "inline-block");
        });
        $('#Занят').click(function(){
            $(".Занят").css("display", "inline-block");
            $(".Завершен").css("display", "none");
        });
        $('#Завершен').click(function(){
            $(".Занят").css("display", "none");
            $(".Завершен").css("display", "inline-block");
        });
    });
</script>
<?php require_once('header-user.php'); ?><!--шапка пользователя-->
	<div class="cent" id="admin">
	<div class="osntx4">
		<h1 class="zagl">Мои записи</h1>
		<div class="top-menu">
			<ul>
				<li id="all"><p>Все</p></li>
				<li id="Занят"><p>Тренировка</p></li>
                <li id="Завершен"><p>Завершен</p></li>
			</ul>
   	 	</div>
		<div class="row">
			<?php
			//вывод записей пользователя на тренировку по сверке почты, где статус занят
			$user_email = $_SESSION['email'];
			$result=mysqli_query($link, "SELECT * FROM Zapisi WHERE user_email='$user_email' AND Status='Занят'") or die(mysqli_error($link));
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
				$user_id=$row['user_id'];


				echo "<div class='userindivid'>
				<div class='$status'>
				<h4>Заявка №$id</h4>
				<hr style='border: 1px solid #ff7350; margin-top: 5px; margin-bottom: 5px;'>
				<p> Имя: $name</p>
				<p> Специализация: $profile</p>
				<p> Телефон: $phone</p>
				<p> Дата: $date</p>
				<p> Время: от $time до $time2</p>
				<p> Цена: $price</p>
				<p> Статус: Тренировка</p>
				<form method='POST'>
					<input style='display:none;' name='id' value='$id' required />
				</form>	
				</div></div><br>";
				}
				//вывод записей пользователя на тренировку по сверке почты, где статус завершен
				$result=mysqli_query($link, "SELECT * FROM Zapisi WHERE user_email='$user_email' AND Status='Завершен'") or die(mysqli_error($link));
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
				$user_id=$row['user_id'];


				echo "<div class='userindivid'>
				<div class='$status'>
				<h4>Заявка №$id</h4>
				<hr style='border: 1px solid #ff7350; margin-top: 5px; margin-bottom: 5px;'>
				<p> Имя: $name</p>
				<p> Специализация: $profile</p>
				<p> Телефон: $phone</p>
				<p> Дата: $date</p>
				<p> Время: от $time до $time2</p>
				<p> Цена: $price</p>
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

<?php require_once('footer.php') ?><!--подвал-->