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
//удаление товара из корзины
if (isset($_GET['del'])) {
			 $del = $_GET['del'];
			 $query = "DELETE FROM Orders WHERE id=$del";
			 mysqli_query($link, $query) or die(mysqli_error($link));
}
		

$email = $_SESSION['email'];
$phone = $_SESSION['phone'];
$name2 = $_SESSION['name'];

?>
<?php if($_SESSION['role']!='Пользователь') {header('Location: index.php');} ?><!--Проверка по ролям-->
<?php require_once('header.php'); ?><!--шапка-->
<?php require_once('header-user.php'); ?><!--шапка пользователя-->
	<div class="cent" id="glav1">
	<div class="osntx5">
	<h1 class="zagl">Сделать заказ</h1>

		<div class="userorder">
			<div class="grid-container13">
			<div class="item133">
					<h3>Заказ:</h3>
					<?php
					//вывод корзины
					$email = $_SESSION['email'];
					$prov=0;
					$sum2=0;
					$result=mysqli_query($link, "SELECT * FROM Orders WHERE email='$email' AND status='Обработка'") or die(mysqli_error($link));
						while($row = mysqli_fetch_array($result)){
						$menu_id=$row['menu_id'];
						$quantity=$row['quantity'];
						$num2=$row['id'];
						$prov++;
						//колличество товара
					$result2=mysqli_query($link, "SELECT * FROM Menu WHERE id='$menu_id'") or die(mysqli_error($link));
						while($row = mysqli_fetch_array($result2)){
						$name=$row['name'];
						$description=$row['description'];
						$category=$row['category'];
						$img=$row['img'];
						$price=$row['price'];
						$id=$row['id'];
						//сумма товаров	
						$sum2=$sum2+($quantity*$price);

						echo "<div class='$category' style='box-shadow: 0px 1px 15px 1px rgb(69 65 78 / 8%);  padding: 10px; width:300px;'>
						<div class='divzapimg'><img src='$img' class='zapimg' ></div>
						<h4>$name</h4>
							<span>Кол-во: $quantity</span>
							<p class='price'>Цена:$sum2 руб.</p>
							<a class='del1' href='?del=$num2'>Удалить</a>
						</div>";
						}
					}
					?>
				</div>
				<div class="item13">
					<?$result=mysqli_query($link, "SELECT * FROM Orders WHERE email='$email' AND status='Обработка'") or die(mysqli_error($link));
						while($row = mysqli_fetch_array($result)){
						$menu_id=$row['menu_id'];
						$quantity=$row['quantity'];
						$num2=$row['id'];
						$prov++;}
					if($prov>0){ ?>
					<div class="ord2">
						<form class="form" method="POST" autocomplete="on">
								<p class=''>Выберите город:</p>
								<select class="select input-or2" name="city" placeholder="город">
									<option value="Альметьевск">Альметьевск</option>
									<option value="Казань">Казань</option>
									<option value="Набережные-Челны">Набережные-Челны</option>
									<option value="Нижнекамск">Нижнекамск</option>
								</select><br>
								<input class="textbox input-or2" name="street" placeholder="Улица" value='<? echo $street;?>' required /> <br>
								<input class="textbox input-or2" name="name" placeholder="ФИО" value='<? echo  $name2;?>' required /><? echo $prover;?><br>
								<input class="textbox input-or2" name="email" placeholder="Email" value='<? echo $email;?>' required /><? echo $prover2;?><br>
								<input class="textbox input-or2" name="phone" placeholder="Номер телефона" value='<? echo $phone;?>' required /> <? echo $prover3;?><br>
								<p class=''>Дата доставки:</p>
								<input type="date" class="textbox input-or2" name="date"><br>
								<p class=''>Желаемое время доставки:</p>
								<input class="textbox input-or2" type="time" name="time2" min="09:00" max="21:00" placeholder="Время" required /><br>
								<textarea class="textarea input-or2" rows="10" maxlength="256" name="comment" placeholder="Комментарий" value='<? echo $comment;?>' required /></textarea><br>
								<p class=''>Оплата:</p>
								<select class="select input-or2" name="payment">
									<option value="Наличными">Наличными</option>
									<option value="Перевод СПБ">Перевод СПБ</option>
								</select><br><br>
								<input class="button bt8"  type="submit" value="Заказать"><br><br>
						</form>
							<?
							}
							//запись в таблицу заказов
							if (!empty($_POST['street']) and !empty($_POST['phone'])) {

							$name = strip_tags($_POST['name']);    
							$street = strip_tags($_POST['street']);
							$phone = strip_tags($_POST['phone']);
							$date = strip_tags($_POST['date']);
							$comment = strip_tags($_POST['comment']);
							$city = strip_tags($_POST['city']);
							$payment = strip_tags($_POST['payment']);
							$time2 = strip_tags($_POST['time2']);

							$query2 = "INSERT INTO Orders2 (name,email,phone,comment,price,payment,city,street,status,date,time,time2) VALUES('$name','$email','$phone','$comment','$sum2','$payment','$city','$street','Новый','$date',NOW(),'$time2');";
							mysqli_query($link, $query2);
							$query2 = "UPDATE Orders SET Status='Новый' WHERE email='$email';";
							mysqli_query($link, $query2);
							echo '<meta http-equiv="refresh" content="1;URL=user-history.php" />';
							}
						?>
					</div>
				</div>
				
			</div>
		</div>	
	</div>
	</div>
<?php require_once('footer.php') ?><!--подвал-->