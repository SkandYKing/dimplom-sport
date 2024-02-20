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
	//удаление индивид. тренировки
	if (isset($_POST['del'])) {
		$id = $_POST['id'];
		$query = "DELETE FROM Userwork WHERE id=$id";
		mysqli_query($link, $query) or die(mysqli_error($link));
	}

	//запись индивидуальной тренировки
	if (isset($_POST['work'])) {
		$id = $_POST['id'];
		$trener_email = $_SESSION['email'];
		$zagolovok = strip_tags($_POST['zagolovok']);
		$text = strip_tags($_POST['text']);
		//запись
		$query = "UPDATE Userwork SET Status='Отправлен', zagolovok='$zagolovok', text='$text' WHERE id=$id";
		mysqli_query($link, $query) or die(mysqli_error($link));

	}
	?>
<?php if($_SESSION['role']!='Тренер') {header('Location: index.php');} ?><!--Проверка по ролям-->
<?php require_once('header.php'); ?><!--шапка-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script><!--подключение js jquery-->
<script> //фильтр по статусам
    $(document).ready(function(){
        $('#all').click(function(){
            $(".Новый").css("display", "inline-block");
            $(".Отправлен").css("display", "inline-block");
            $(".Прочитано").css("display", "inline-block");
        });
        $('#Новый').click(function(){
            $(".Новый").css("display", "inline-block");
            $(".Отправлен").css("display", "none");
            $(".Прочитано").css("display", "none");
        });
        $('#Отправлен').click(function(){
            $(".Новый").css("display", "none");
            $(".Отправлен").css("display", "inline-block");
            $(".Прочитано").css("display", "none");
        });
        $('#Прочитано').click(function(){
            $(".Новый").css("display", "none");
            $(".Отправлен").css("display", "none");
            $(".Прочитано").css("display", "inline-block");
        });
    });
</script>
<?php require_once('header-trener.php'); ?><!--шапка тренера-->
<div class="cent" id="admin">
		<h1 class="zagl">Назначение индивидуальных тренировок</h1>
		<div class="top-menu">
			<ul>
				<li id="all"><p>Все</p></li>
				<li id="Новый"><p>Новый</p></li>
                <li id="Отправлен"><p>Отправлен</p></li>
                <li id="Прочитано"><p>Прочитано</p></li>
			</ul>
   	 	</div>
		<div class="row">
		<?php
		//вывод таблицы индивидуальных тренировок со статусом новый
			$trener_email = $_SESSION['email'];
			$result=mysqli_query($link, "SELECT * FROM Userwork WHERE trener_email='$trener_email' AND Status='Новый'") or die(mysqli_error($link));
				while($row = mysqli_fetch_array($result)){
				$id=$row['id'];
				$user_email=$row['user_email'];
				$user_name=$row['user_name'];
				$status=$row['status'];
				$zagolovok=$row['zagolovok'];
				$text=$row['text'];


				echo "<div class='userindivid'>
				<div class='$status'>
				<p> Имя клиента: <b>$user_name</b></p>
				<p> Почта клиента: <b>$user_email</b></p>
				<p> Заголовок: <b>$zagolovok</b></p>
				<p> Сообщение: <b>$text</b></p>
				<p> Статус: <b>$status</b></p>
				<form method='POST'>
					<input class='textbox input-or' name='zagolovok'  placeholder='Заголовок' /><br>
					<input class='textbox input-or' name='text'  placeholder='Текст'  /><br>
					<input style='display:none;' name='id' value='$id' required />
					<input class='button bt7' name='work' type='submit' value='Отправить'>
				</form>	
				</div></div><br>";
				}
				//вывод таблицы индивидуальных тренировок со статусом отправлен
			$result=mysqli_query($link, "SELECT * FROM Userwork WHERE trener_email='$trener_email' AND Status='Отправлен'") or die(mysqli_error($link));
				while($row = mysqli_fetch_array($result)){
				$id=$row['id'];
				$user_email=$row['user_email'];
				$user_name=$row['user_name'];
				$status=$row['status'];
				$zagolovok=$row['zagolovok'];
				$text=$row['text'];


				echo "<div class='userindivid'>
				<div class='$status'>
				<p> Имя клиента: <b>$user_name</b></p>
				<p> Почта клиента: <b>$user_email</b></p>
				<p> Заголовок: <b>$zagolovok</b></p>
				<p> Сообщение: <b>$text</b></p>
				<p> Статус: <b>$status</b></p>
				<form method='POST'>
					<input style='display:none;' name='id' value='$id' required />
				</form>	
				</div></div><br>";
				}	
				//вывод таблицы индивидуальных тренировок со статусом прочитано
			$result=mysqli_query($link, "SELECT * FROM Userwork WHERE trener_email='$trener_email' AND Status='Прочитано'") or die(mysqli_error($link));
				while($row = mysqli_fetch_array($result)){
				$id=$row['id'];
				$user_email=$row['user_email'];
				$user_name=$row['user_name'];
				$status=$row['status'];
				$zagolovok=$row['zagolovok'];
				$text=$row['text'];


				echo "<div class='userindivid'>
				<div class='$status'>
				<p> Имя клиента: <b>$user_name</b></p>
				<p> Почта клиента: <b>$user_email</b></p>
				<p> Заголовок: <b>$zagolovok</b></p>
				<p> Сообщение: <b>$text</b></p>
				<p> Статус: <b>$status</b></p>
				<form method='POST'>
					<input style='display:none;' name='id' value='$id' required />
				</form>	
				</div></div><br>";
				}	
			?>
		</div>


	<div id="clear"></div>
	</div>

<?php require_once('footer.php') ?><!--подвал-->