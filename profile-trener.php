<?php session_start();
if(isset($_GET['exit'])) //если выход
{
	session_destroy();
	header('Location: http://localhost/inferno/index.php'); //перенаправление в случае выхода
	exit;
}?>
<?
	$host = 'localhost'; //имя хоста, на локальном компьютере это localhost
	$user = 'root'; //имя пользователя, по умолчанию это root
	$password = ''; //пароль, по умолчанию пустой
	$db_name = 'inferno'; //имя базы данных

	$link = mysqli_connect($host, $user, $password, $db_name);

	mysqli_query($link, "SET NAMES 'utf8'");

	$email2 = $_SESSION['email'];
	//проверка правильности ввода данных и их записывание
	if (!empty($_POST['name']) and !empty($_POST['email']) and !empty($_POST['phone'])) {

		$email2 = $_SESSION['email'];

		$name = strip_tags($_POST['name']);
		$email = strip_tags($_POST['email']);
		$phone = strip_tags($_POST['phone']);

		$i=0;
		//проверка на правильность имени
		if(preg_match("/^[a-zA-Zа-яёА-ЯЁ\s\-]+$/u", $name)) {
			$i++;
		} else { $prover='<div class="valid">Некорректное ФИО</div>';}
		//проверка на правильность почты
		if(preg_match("/^(?:[a-z0-9]+(?:[-_.]?[a-z0-9]+)?@[a-z0-9_.-]+(?:\.?[a-z0-9]+)?\.[a-z]{2,5})$/i", $email)) {
			$i++;
		} else { $prover2='<div class="valid">Некорректная почта</div>';}


		if ($i==2) {
			//обновление данных пользователя
			$query2 = "UPDATE Users SET Name='$name', Email='$email', Phone='$phone' WHERE Email='$email2';";
			mysqli_query($link, $query2);

			$_SESSION['name'] = $name;
			$_SESSION['phone'] = $phone;
			$_SESSION['email'] = $email;

		}
	}
?>
<?php if($_SESSION['role']!='Тренер') {header('Location: index.php');} ?><!--Проверка по ролям-->
<?php require_once('header.php'); ?><!--шапка-->
<?php require_once('header-trener.php'); ?><!--шапка тренера-->
<div class="cent" id="admin">
	<div class="profile">
			<h1 class="zagl">Профиль</h1>
	
					<form class="form" method="POST"  autocomplete="on">
					<div class="grid-container10">
						<div class="item10">
							<div class="grid-container101">
								<div class="item101">
									<?php //проверка почты и вывод фотографии
									$email2 = $_SESSION['email'];
									$result=mysqli_query($link, "SELECT * FROM Users WHERE email='$email2'") or die(mysqli_error($link));
										while($row = mysqli_fetch_array($result)){
										$img=$row['img'];
										echo "<div class='divprofileimg'><img src='$img' class='profileimg'></div><br>";
										}
									?>
								</div>
								<div class="item101">
									<span class="item1011p">ФИО: <? echo $_SESSION['name']; ?></span><br><br>
									<span class="item1011p">E-mail: <? echo $_SESSION['email']; ?></span><br><br>
									<span class="item1011p">Телефон: <? echo $_SESSION['phone']; ?></span><br><br>
									<span class="item1011p">Специализация: <? echo $_SESSION['profile']; ?></span><br><br>
									<span class="item1011p">Стаж: <? echo $_SESSION['stage']; ?></span>
								</div>
							</div>
									<div class="trener-prof">
									<p>Изменить данные аккаунта</p>
									<input class="textbox input-or4" name="name" placeholder="ФИО" value='<? echo $_SESSION['name'];?>' required /> <? echo $prover;?><br>
									<input class="textbox input-or4 tel" name="phone" placeholder="Номер телефона" value='<? echo $_SESSION['phone'];?>' required /> <? echo $prover5;?><br>
									<input class="textbox input-or4" name="email" placeholder="E-mail" value='<? echo $_SESSION['email'];?>' required /> <? echo $prover2;?><br>
									<li><a href="user-password.php">Изменить пароль</a></li>
									<input class="button bt5" type="submit" value="Изменить"><br><br>
									<? //вывод сообщение об изменении
										if ($i==2) {
											echo '<p style="color:green; font-family: "Open Sans", sans-serif;"> Данные изменены</p>';
										}
									?>
									</div>
						</div>
						<div class="item10">
							<?php //статистика заказов и доход от них
								$trener_email = $_SESSION['email'];
								$row2 = mysqli_query($link,"SELECT * FROM Zapisi WHERE trener_email='$trener_email'");
								$dohod=0;
								$zakaz=0;		
								while($myrow2 = mysqli_fetch_array($row2)) {
									if ($myrow2['status'] == 'Завершен') {
										$dohod=$dohod+$myrow2['price'];
										$zakaz++;
									}
								}
							?>
							<table id="myTable" class="table_dark2">
							<tr class="header">
							<span class="text-muted"><th class='th1' width="300px;">Доход от завершенных тренировок</th></span>
							<span class="text-muted"><th class='th1' width="300px;">Завершенные заявки</th></span>
							</tr>
							<tr>
							<span class="text-muted fw-bold"><td class='td1'><? echo $dohod;?> Руб.</td></span>
							<div class="progress-card">
								<div class="d-flex justify-content-between mb-1">
									<span class="text-muted fw-bold"><td class='td1'><? echo $zakaz;?></td></span>
								</div>
							</div>
							</tr>
							</table>
						</div>
					</div>
					</form>
					</div>	</div>
	</div>
	<script> //маска для телефона
	      window.addEventListener("DOMContentLoaded", function() {
                [].forEach.call( document.querySelectorAll('.tel'), function(input) {
                var keyCode;
                function mask(event) {
                    event.keyCode && (keyCode = event.keyCode);
                    var pos = this.selectionStart;
                    if (pos < 3) event.preventDefault();
                    var matrix = "+7 (___) ___ ____",
                        i = 0,
                        def = matrix.replace(/\D/g, ""),
                        val = this.value.replace(/\D/g, ""),
                        new_value = matrix.replace(/[_\d]/g, function(a) {
                            return i < val.length ? val.charAt(i++) || def.charAt(i) : a
                        });
                    i = new_value.indexOf("_");
                    if (i != -1) {
                        i < 5 && (i = 3);
                        new_value = new_value.slice(0, i)
                    }
                    var reg = matrix.substr(0, this.value.length).replace(/_+/g,
                        function(a) {
                            return "\\d{1," + a.length + "}"
                        }).replace(/[+()]/g, "\\$&");
                    reg = new RegExp("^" + reg + "$");
                    if (!reg.test(this.value) || this.value.length < 5 || keyCode > 47 && keyCode < 58) this.value = new_value;
                    if (event.type == "blur" && this.value.length < 5)  this.value = ""
                }

                input.addEventListener("input", mask, false);
                input.addEventListener("focus", mask, false);
                input.addEventListener("blur", mask, false);
                input.addEventListener("keydown", mask, false)

              });

            });
                        </script>
<?php require_once('footer.php') ?><!--подвал-->
