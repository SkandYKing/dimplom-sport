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

	$phone = $_SESSION['phone'];
    $name2 = $_SESSION['name'];
	//добавдение отзыва
	if (!empty($_POST['name']) and !empty($_POST['phone'])) {

		$name = strip_tags($_POST['name']);
		$phone = strip_tags($_POST['phone']);
		$comment = strip_tags($_POST['comment']);

		$i=0;
		//проверка на правильность имени
		if(preg_match("/^[a-zA-Zа-яёА-ЯЁ\s\-]+$/u", $name)) {
			$i++;
		} else { $prover='<div class="valid">Некорректное имя</div>';}

		if ($i==1) {
			//записывание в бд
			$query = "INSERT INTO Reviews (name, phone, comment) VALUES('$name', '$phone','$comment');";
			mysqli_query($link, $query);
		}
	}

?>
<?php if($_SESSION['role']!='Пользователь') {header('Location: index.php');} ?><!--Проверка по ролям-->
<?php require_once('header.php'); ?><!--шапка-->
<?php require_once('header-user.php'); ?><!--шапка пользователя-->
	<div class="osntx">
	<h1 class="zagl" style="text-align: center; margin-top: 50px;">Оставить отзыв</h1>
		<form class="form-rev" method="POST">
			
			<input class="textbox input-or3" name="name" placeholder="ФИО" value='<? echo  $name2;?>' required /><br>
			<input class="textbox input-or3" name="phone" placeholder="Номер телефона" value='<? echo $phone;?>' required /><br>
			<textarea class="textarea input-or3" rows="10" maxlength="256" name="comment" placeholder="Комментарий" value='<? echo $comment;?>' required /></textarea><br>
			<input class="button bt11" type="submit" value="Отправить"><br><br>
				<? //вывод сообщения 
					if ($i==1) {
						echo '<p style="color:green; font-family: "Open Sans", sans-serif;">Отзыв отправлен</p>';
					}
				?>
		</form>

	<div id="clear"></div>
	</div>
	
<?php require_once('footer.php') ?><!--подвал-->