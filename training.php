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
	//проверка полей и запись в бд
		if (!empty($_POST['name']) and !empty($_POST['profile']) and !empty($_POST['stage']) and !empty($_POST['phone']) and !empty($_POST['time']) and !empty($_POST['time2']) and !empty($_POST['price'])) {

			$name = strip_tags($_POST['name']);
			$profile = $_POST['profile'];
			$stage = strip_tags($_POST['stage']);
			$date = strip_tags($_POST['date']);
			$phone = strip_tags($_POST['phone']);
			$time = strip_tags($_POST['time']);
			$time2 = strip_tags($_POST['time2']);
			$price = $_POST['price'];
			$i = 0;
			//проверка на имя
			if (preg_match("/^[a-zA-Zа-яёА-ЯЁ0-9\s\-]+$/u", $name)) {
				$i++;
			} else { $prover='<div class="valid">Некорректное имя</div>';}
			//проверка на специализцию
			if ($profile=="Выберите специализацию") {
					$prover2='<div class="valid">Выберите специализацию</div>';
				} else { $i++;}
				//выбор цены
				if ($price=="Выберите цену") {
					$prover4='<div class="valid">Выберите цену</div>';
				} else { $i++;}
				//проверка формата фото и длины
				$path = 'zapisiimg/';
				$types = array('image/gif', 'image/png', 'image/jpeg', 'image/jpg');
				$size = 2000000;

				if ($_SERVER['REQUEST_METHOD'] == 'POST')
				{
					if (!in_array($_FILES['picture']['type'], $types)) {
				  $prover3='<div class="valid">Запрещённый тип файла</div>'; } else { $i++;}

				  if ($_FILES['picture']['size'] > $size) {
				  $prover3='<div class="valid">Слишком большой размер файла</div>'; } else { $i++;}

					if (!@copy($_FILES['picture']['tmp_name'], $path . $_FILES['picture']['name']))
					echo 'Что-то пошло не так';
				}

			if ($i==5) {
				//добавление фото в папку
				$img = 'zapisiimg/'.$_FILES['picture']['name'];
				//запись данных в таблицу тренировки
				$query2 = "INSERT INTO Zapisi (name, profile, stage, phone, status, date, time, time2, price, img, trener_email, user_email, user_name) VALUES('$name','$profile','$stage','$phone','Свободен','$date','$time','$time2','$price','$img','$trener_email','$user_email','$user_name');";
				mysqli_query($link, $query2);
			}
		}
	?>
<?php if($_SESSION['role']!='Тренер') {header('Location: index.php');} ?><!--Проверка по ролям-->
<?php require_once('header.php'); ?><!--шапка-->
<?php require_once('header-trener.php'); ?><!--шапка тренера-->
<div class="cent" id="admin">
	<div class="osntx1">
        <h1 class="zagl">Cоздать заявку</h1>
		<div class="trener-prof">
		<form class="form" method="POST" enctype="multipart/form-data" autocomplete="on">
				<input class="textbox input-or" name="name" placeholder="Имя" value='<? echo $_SESSION['name'];?>'  required /> <? echo $prover;?><br>
				<input class="textbox input-or" name="profile" placeholder="Специализация" value='<? echo $_SESSION['profile'];?>' required /><br>
				<input class="textbox input-or" name="stage" placeholder="Стаж" value='<? echo $_SESSION['stage'];?>' required /><br>
				<input class="textbox input-or" name="phone" placeholder="Телефон" value='<? echo $_SESSION['phone'];?>' required /><br>
				<input type="date" class="textbox input-or" name="date"><br>
				<input class="textbox input-or" name="time"  placeholder="Время от" value='<? echo $time;?>' required /><br>
				<input class="textbox input-or" name="time2"  placeholder="Время до" value='<? echo $time2;?>' required /><br>

				<select class="select input-or" name="price"> 
					<option value="Выберите цену">Выберите цену</option>
					<option value='750'>750</option>
					<option value='850'>850</option>
					<option value='950'>950</option>
					<option value='1100'>1100</option>
					<option value='1300'>1300</option>
					<option value='1500'>1500</option>
				</select> <? echo $prover4;?><br>
				<input name="picture" type="file" required /><? echo $prover3;?><br>
				<input class="button bt5" style="width:25%;" type="submit" value="Добавить"><br>
				<? //вывод сообщения
					if ($i==5) {
						echo '<p style="color:green; font-family: "Open Sans", sans-serif;">Успешно добавлено</p>';
					}
				?>
		</form>
		</div>			</div>
	</div>

<?php require_once('footer.php') ?><!--подвал-->