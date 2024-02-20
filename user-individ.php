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
	//изменение статуса индивидуальных тренировок
	if (isset($_POST['workuser'])) {
		$id = $_POST['id'];
		$query = "UPDATE Userwork SET Status='Прочитано' WHERE id=$id";
		mysqli_query($link, $query) or die(mysqli_error($link));

	}
	?>
<?php if($_SESSION['role']!='Пользователь') {header('Location: index.php');} ?><!--Проверка по ролям-->
<?php require_once('header.php'); ?><!--шапка-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script><!--подключение js jquery-->
<script> //фильтр по статусам
    $(document).ready(function(){
        $('#all').click(function(){
            $(".Отправлен").css("display", "inline-block");
            $(".Прочитано").css("display", "inline-block");
        });
        $('#Отправлен').click(function(){
            $(".Отправлен").css("display", "inline-block");
            $(".Прочитано").css("display", "none");
        });
        $('#Прочитано').click(function(){
            $(".Отправлен").css("display", "none");
            $(".Прочитано").css("display", "inline-block");
        });
    });
</script>
<?php require_once('header-user.php'); ?><!--шапка пользователя-->
<div class="cent" id="admin">
	<div class="osntx4">
		<h1 class="zagl">Просмотр индивидуальных тренировок</h1>
		<div class="top-menu">
			<ul>
				<li id="all"><p>Все</p></li>
				<li id="Отправлен"><p>Новый</p></li>
                <li id="Прочитано"><p>Прочитано</p></li>
			</ul>
   	 	</div>
		<div class="row">
		<?php
		//вывод индивидуальных тренировок со статусом отправлен
			$user_email = $_SESSION['email'];
			$result=mysqli_query($link, "SELECT * FROM Userwork WHERE user_email='$user_email' AND Status='Отправлен'") or die(mysqli_error($link));
				while($row = mysqli_fetch_array($result)){
				$id=$row['id'];
				$trener_email=$row['trener_email'];
				$trener_name=$row['trener_name'];
				$status=$row['status'];
				$zagolovok=$row['zagolovok'];
				$text=$row['text'];


				echo "<div class='userindivid'>
				<div class='$status'>
				<p> Имя тренера: $trener_name</p>
				<p> Заголовок: $zagolovok</p>
				<p> Сообщение: $text</p>
				<p> Почта тренера: $trener_email</p>
				<p> Статус: Новый</p>
				<form method='POST'>
					<input style='display:none;' name='id' value='$id' required />
					<input class='button bt7' name='workuser' type='submit' value='Отметить как прочитано'>
				</form>	
				</div></div><br>";
				}
				//вывод индивидуальных тренировок со статусом прочитано
			$result=mysqli_query($link, "SELECT * FROM Userwork WHERE user_email='$user_email' AND Status='Прочитано'") or die(mysqli_error($link));
				while($row = mysqli_fetch_array($result)){
				$id=$row['id'];
				$trener_email=$row['trener_email'];
				$trener_name=$row['trener_name'];
				$status=$row['status'];
				$zagolovok=$row['zagolovok'];
				$text=$row['text'];


				echo "<div class='userindivid'>
				<div class='$status'>
				<p> Имя тренера: $trener_name</p>
				<p> Заголовок: $zagolovok</p>
				<p> Сообщение: $text</p>
				<p> Почта тренера: $trener_email</p>
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