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
	//выбор заказов макс. 10
	$query = "SELECT * FROM Orders2 LIMIT 10";
    $result = mysqli_query($link, $query);

	//удаление заказа с 2х таблиц
	if (isset($_POST['del'])) {
		$id = $_POST['id'];
		$email = $_POST['email'];
		$query = "DELETE FROM Orders2 WHERE id=$id";
		mysqli_query($link, $query) or die(mysqli_error($link));

		$query = "DELETE FROM Orders WHERE email='$email' AND Status='Новый'";
		mysqli_query($link, $query) or die(mysqli_error($link));
	}
	//изменение статуса на "в пути"
	if (isset($_POST['stat'])) {
		$id = $_POST['id'];
		$email = $_POST['email'];
		$query = "UPDATE Orders2 SET Status='В пути' WHERE id=$id";
		mysqli_query($link, $query) or die(mysqli_error($link));
		$query = "UPDATE Orders SET Status='В пути' WHERE email='$email' AND Status='Новый'";
		mysqli_query($link, $query) or die(mysqli_error($link));
	}

	//изменение статуса "завершен" 
	if (isset($_POST['stat3'])) {
		$id = $_POST['id'];
		$email = $_POST['email'];
		$query = "UPDATE Orders2 SET Status='Завершён' WHERE id=$id";
		mysqli_query($link, $query) or die(mysqli_error($link));
		$query = "UPDATE Orders SET Status='Завершён' WHERE email='$email' AND Status='В пути'";
		mysqli_query($link, $query) or die(mysqli_error($link));
	}
	?>
<?php if($_SESSION['role']!='Администратор') {header('Location: index.php');} ?><!--Проверка по ролям-->
<?php require_once('header.php'); ?><!--шапка-->
<?php require_once('header-admin.php'); ?><!--шапка админа-->
	<div class="cent" id="admin">
		<h1 class="zagl">Управление заказами</h1>

		<div class="row">
			<?php
			//вывод заказов со статус новый
			$result=mysqli_query($link, "SELECT * FROM Orders2 WHERE Status='Новый'") or die(mysqli_error($link));
				while($row = mysqli_fetch_array($result)){
				$id=$row['id'];
                $name =$row['name'];
                $phone=$row['phone'];
				$comment=$row['comment'];
				$price=$row['price'];
				$payment=$row['payment'];
				$city=$row['city'];
				$date=$row['date'];
				$street= $row['street'];
				$status =$row['status'];
                $time=$row['time'];
				$time2=$row['time2'];
                $email=$row['email'];

				echo "<div class='userindivid'>
				<div class='zayavka'>
				<h3>Заказ №$id</h3> <span class='time'>$time</span>
				<hr style='border: 1px solid #ff7350; margin-top: 5px; margin-bottom: 5px;'>
				<p>";
				//сверка таблиц на товары и их колличество 
				$result2=mysqli_query($link, "SELECT * FROM Orders WHERE email='$email'") or die(mysqli_error($link));
				while($row = mysqli_fetch_array($result2)){
					$menu_id=$row['menu_id'];
					$quantity=$row['quantity'];
					$result3=mysqli_query($link, "SELECT * FROM Menu WHERE id='$menu_id'") or die(mysqli_error($link));
					while($row = mysqli_fetch_array($result3)){
						$name2=$row['name'];
						echo "Товар: $name2 количество: $quantity ";
					}
				}

				echo "<p> ФИО: $name</p>
				<p> Город: $city</p>
				<p> Улица: $street</p>
				<p> Email: $email</p>
				<p> Телефон: $phone</p>
				<p> Дата доставки: $date</p>
				<p> Желаемое время доставки: $time2</p>
				<p> Оплата: $payment</p>
				<p> Комментарий: $comment</p>
				<p> Цена: $price руб.</p>
				<p> Статус: $status</p>

				<form method='POST'>
					<input style='display:none;' name='id' value='$id' required />
					<input style='display:none;' name='email' value='$email' required />
					<input class='button bt12' name='stat' type='submit' value='Изменить статус'>
					<input class='button bt12' name='del' type='submit' value='Удалить'>
				</form>

				</div></div><br>";
				}
			?>
		</div>



		<div class="row">
			<?php
			//вывод заказов со статусом в пути
			$result=mysqli_query($link, "SELECT * FROM Orders2 WHERE Status='В пути'") or die(mysqli_error($link));
				while($row = mysqli_fetch_array($result)){
				$id=$row['id'];
                $name =$row['name'];
                $phone=$row['phone'];
				$comment=$row['comment'];
				$price=$row['price'];
				$payment=$row['payment'];
				$city=$row['city'];
				$street= $row['street'];
				$status =$row['status'];
				$date=$row['date'];
                $time=$row['time'];
				$time2=$row['time2'];
                $email=$row['email'];

				echo "<div class='userindivid'>
				<div class='zayavka'>
				<h3>Заказ №$id</h3> <span class='time'>$time</span>
				<hr style='border: 1px solid #ff7350; margin-top: 5px; margin-bottom: 5px;'>
				<p>";
				//сверка таблиц на товары и их колличество
				$result2=mysqli_query($link, "SELECT * FROM Orders WHERE email='$email'") or die(mysqli_error($link));
				while($row = mysqli_fetch_array($result2)){
					$menu_id=$row['menu_id'];
					$quantity=$row['quantity'];
					$result3=mysqli_query($link, "SELECT * FROM Menu WHERE id='$menu_id'") or die(mysqli_error($link));
					while($row = mysqli_fetch_array($result3)){
						$name2=$row['name'];
						echo "Товар: $name2 количество: $quantity ";
					}
				}

				echo "<p> ФИО: $name</p>
				<p> Город: $city</p>
				<p> Улица: $street</p>
				<p> Email: $email</p>
				<p> Телефон: $phone</p>
				<p> Дата доставки: $date</p>
				<p> Желаемое время доставки: $time2</p>
				<p> Оплата: $payment</p>
				<p> Комментарий: $comment</p>
				<p> Цена: $price руб.</p>
				<p> Статус: $status</p>

				<form method='POST'>
					<input style='display:none;' name='id' value='$id' required />
					<input style='display:none;' name='email' value='$email' required />
					<input class='button bt12' name='stat3' type='submit' value='Изменить статус'>
				</form>
				</div></div><br>";
				}
			?>
		</div>

		<div class="row">
			<?php
			//вывод заказов со статусом в завершен
			$result=mysqli_query($link, "SELECT * FROM Orders2 WHERE Status='Завершён'") or die(mysqli_error($link));
				while($row = mysqli_fetch_array($result)){
				$id=$row['id'];
                $name =$row['name'];
                $phone=$row['phone'];
				$comment=$row['comment'];
				$price=$row['price'];
				$payment=$row['payment'];
				$city=$row['city'];
				$street= $row['street'];
				$date=$row['date'];
				$status =$row['status'];
                $time=$row['time'];
				$time2=$row['time2'];
                $email=$row['email'];

				echo "<div class='userindivid'>
				<div class='zayavka'>
				<h3>Заказ №$id</h3> <span class='time'>$time</span>
				<hr style='border: 1px solid #ff7350; margin-top: 5px; margin-bottom: 5px;'>
				<p>";
				//сверка таблиц на товары и их колличество
				$result2=mysqli_query($link, "SELECT * FROM Orders WHERE email='$email'") or die(mysqli_error($link));
				while($row = mysqli_fetch_array($result2)){
					$menu_id=$row['menu_id'];
					$quantity=$row['quantity'];
					$result3=mysqli_query($link, "SELECT * FROM Menu WHERE id='$menu_id'") or die(mysqli_error($link));
					while($row = mysqli_fetch_array($result3)){
						$name2=$row['name'];
						echo "Товар: $name2 количество: $quantity ";
					}
				}

				echo "<p> ФИО: $name</p>
				<p> Город: $city</p>
				<p> Улица: $street</p>
				<p> Email: $email</p>
				<p> Телефон: $phone</p>
				<p> Дата доставки: $date</p>
				<p> Желаемое время доставки: $time2</p>
				<p> Оплата: $payment</p>
				<p> Комментарий: $comment</p>
				<p> Цена: $price руб.</p>
				<p> Статус: $status</p>

				<form method='POST'>
					<input style='display:none;' name='id' value='$id' required />
					<input style='display:none;' name='email' value='$email' required />
				</form>
				</div></div><br>";
				}
			?>
		</div>


	<div id="clear"></div>
	</div>


<?php require_once('footer.php') ?><!--Подвал-->

	
