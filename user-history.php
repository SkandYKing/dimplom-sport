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

$email = $_SESSION['email'];
//удаление нового заказа
if (isset($_GET['del'])) {
			 $del = $_GET['del'];
			 $query = "DELETE FROM Orders2 WHERE id=$del";
			 mysqli_query($link, $query) or die(mysqli_error($link));

			 $query2 = "DELETE FROM Orders WHERE email='$email' AND Status='Новый'";
			 mysqli_query($link, $query2) or die(mysqli_error($link));
}

?>
<?php if($_SESSION['role']!='Пользователь') {header('Location: index.php');} ?><!--Проверка по ролям-->
<?php require_once('header.php'); ?><!--шапка-->
<?php require_once('header-user.php'); ?><!--шапка пользователя-->
<div class="cent" id="admin">
<div class="osntx4">
	<h1 class="zagl">Мои покупки</h1>
		<div class="row">
			<?php
			//вывод заказов со статусом новый ,(удаление)
			$email = $_SESSION['email'];
			$result=mysqli_query($link, "SELECT * FROM Orders2 WHERE Status='Новый' AND email='$email'") or die(mysqli_error($link));
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


				echo "<div class='$status'>
				<div class='userindivid'>
				<div class='zayavka'>
				<h3>Заказ №$id</h3> <span class='time'>$time</span>
				<hr style='border: 1px solid #ff7350; margin-top: 5px; margin-bottom: 5px;'>
				<p>";
				//вывод колличества и название товара
				$result2=mysqli_query($link, "SELECT * FROM Orders WHERE email='$email'") or die(mysqli_error($link));
				while($row = mysqli_fetch_array($result2)){
					$menu_id=$row['menu_id'];
					$quantity=$row['quantity'];
					$result3=mysqli_query($link, "SELECT * FROM Menu WHERE id='$menu_id'") or die(mysqli_error($link));
					while($row = mysqli_fetch_array($result3)){
						$name2=$row['name'];
						echo "Товар: $name2 количество: $quantity";
					}
				}

				echo "
				<p> Город: $city, улица: $street</p>
				<p> Телефон: $phone</p>
				<p> Дата доставки: $date</p>
				<p> Желаемое время доставки: $time2</p>
				<p> Оплата: $payment</p>
				<p> Комментарий: $comment</p>
				<p> Цена: $price руб.</p>
				<p> Статус: $status</p>
				<a class='bt10' href='?del=$id'>Удалить</a>   
				</div></div></div><br>";
				}
			?>
		</div>



		<div class="row">
			<?php
			//вывод заказа со статусом в пути 
			$email = $_SESSION['email'];
			$result=mysqli_query($link, "SELECT * FROM Orders2 WHERE Status='В пути' AND email='$email'") or die(mysqli_error($link));
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

				echo "<div class='$status'>
				<div class='userindivid'>
				<div class='zayavka'>
				<h3>Заказ №$id</h3> <span class='time'>$time</span>
				<hr style='border: 1px solid #ff7350; margin-top: 5px; margin-bottom: 5px;'>
				<p>";
				//вывод колличества и название товара
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

				echo "
				<p> Город: $city, улица: $street</p>
				<p> Телефон: $phone</p>
				<p> Дата доставки: $date</p>
				<p> Желаемое время доставки: $time2</p>
				<p> Оплата: $payment</p>
				<p> Комментарий: $comment</p>
				<p> Цена: $price руб.</p>
				<p> Статус: $status</p>
				</div></div></div><br>";
				}
			?>
		</div>

		<div class="row">
			<?php
			//вывод заказа со статусом в пути 
			$email = $_SESSION['email'];
			$result=mysqli_query($link, "SELECT * FROM Orders2 WHERE Status='Завершён' AND email='$email'") or die(mysqli_error($link));
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

				echo "<div class='$status'>
				<div class='userindivid'>
				<div class='zayavka'>
				<h3>Заказ №$id</h3> <span class='time'>$time</span>
				<hr style='border: 1px solid #ff7350; margin-top: 5px; margin-bottom: 5px;'>
				<p>";
				//вывод колличества и название товара
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

				echo "
				<p> Город: $city, улица: $street</p>
				<p> Телефон: $phone</p>
				<p> Дата доставки: $date</p>
				<p> Желаемое время доставки: $time2</p>
				<p> Оплата: $payment</p>
				<p> Комментарий: $comment</p>
				<p> Цена: $price руб.</p>
				<p> Статус: $status</p>
				</div></div></div><br>";
				}
			?>
		</div>


</div>
	</div>

<?php require_once('footer.php') ?><!--подвал-->