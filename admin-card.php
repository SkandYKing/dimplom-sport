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

	//присвоение клубной карты пользователю
	if (!empty($_POST['user_email']) and !empty($_POST['category'])) {

		$user_email = strip_tags($_POST['user_email']);
		$category = strip_tags($_POST['category']);
		$price = strip_tags($_POST['price']);
		$name = strip_tags($_POST['name']);
		$i=0;
		//проверка на выбор пользователя
		if($user_email=="Выберите пользователя") {
			$prover='<div class="valid"> Выберите пользователя</div>';
		} else { $i++;}
		//проверка на выбор карты
		if($category=="Выберите карту") {
			$prover2='<div class="valid"> Выберите карту</div>';
		} else { $i++;}

		if ($i==2) {
		//записывание данных в бд
		$query = "INSERT INTO Usercard (user_email, category, time, price, name) VALUES('$user_email','$category',NOW(),'$price','$name');";
		mysqli_query($link, $query);
		//обновление колонки в таблице user 
		$query2 = "UPDATE Users SET Card='1' WHERE email='$user_email';";
		mysqli_query($link, $query2);
		}
	}

?>
<?php if($_SESSION['role']!='Администратор') {header('Location: index.php');} ?><!--Проверка по ролям-->
<?php require_once('header.php'); ?><!--шапка-->
<?php require_once('header-admin.php'); ?><!--шапка админа-->
<div class="cent" id="admin">
	<div class="osntx1">
	<h1 class="zagl">Добавить карту пользователю</h1>
	<div class="trener-prof" id="glav">
		<form class="form" method="POST"  autocomplete="on">

			<select class="select input-or" name="user_email">
					<option value="Выберите пользователя">Выберите пользователя</option>
					<?php
					//вывод пользователей где колонка карта = 0
					$result=mysqli_query($link, "SELECT * FROM Users WHERE Role='Пользователь' AND card='0'") or die(mysqli_error($link));
					  while($row = mysqli_fetch_array($result)){
						$user_email=$row['email'];
						$user_name=$row['name'];
						echo "<option value='$user_email'>$user_email</option>";
					  }
					?>
			</select><? echo $prover;?>
			<br>
			<select class="select input-or" name="name">
					<option value="Выберите карту">Выберите карту</option>
					<?php
					//вывод название карты
					$result=mysqli_query($link, "SELECT * FROM Card ") or die(mysqli_error($link));
					  while($row = mysqli_fetch_array($result)){
						$name=$row['name'];
						echo "<option value='$name'>$name</option>";
					  }
					?>
			</select><? echo $prover2;?><br>
			<select class="select input-or" name="category">
					<option value="Выберите категорию">Выберите категорию</option>
					<?php
					//вывод категории карты
					$result=mysqli_query($link, "SELECT * FROM Card ") or die(mysqli_error($link));
					  while($row = mysqli_fetch_array($result)){
						$category=$row['category'];
						$price=$row['price'];
						$name=$row['name'];
						echo "<option value='$category'>$category</option>";
					  }
					?>
			</select><? echo $prover2;?><br>

			<select class="select input-or" name="price">
					<option value="Выберите карту">Выберите карту</option>
					<?php
					//вывод цены карты
					$result=mysqli_query($link, "SELECT * FROM Card ") or die(mysqli_error($link));
					  while($row = mysqli_fetch_array($result)){
						$price=$row['price'];
						echo "<option value='$price'>$price</option>";
					  }
					?>
			</select>
			<br>
			<input class="button bt13" type="submit" value="Добавить"><br><br>
				<? //сообщение о добавлении
					if ($i==2) {
						echo '<p style="color:green; font-family: "Open Sans", sans-serif;">Успешно добавлено</p>';
					}
				?>
		</form>

	</div>
	</div>
</div>
<?php require_once('footer.php') ?><!--Подвал-->