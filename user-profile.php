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
	//изменение данных аккаунта
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
<?php if($_SESSION['role']!='Пользователь') {header('Location: index.php');} ?><!--Проверка по ролям-->
<?php require_once('header.php'); ?><!--шапка-->
<?php require_once('header-user.php'); ?><!--шапка пользователя-->
<div class="cent" id="admin">
	<div class="profile">
			<h1 class="zagl">Профиль</h1>
			<form class="form" method="POST"  autocomplete="on">
				<div class="grid-container10">

					<div class="item10">
						<div class="grid-container101">
							<div class="item101">
								<?php
								//проверка на почту и вывод фото пользователя
								$email2 = $_SESSION['email'];
								$result=mysqli_query($link, "SELECT * FROM Users WHERE email='$email2'") or die(mysqli_error($link));
									while($row = mysqli_fetch_array($result)){
									$img=$row['img'];
									echo "<div class='divprofileimg'><img src='$img' class='profileimg'></div><br>";
									}
								?>	
							</div>
							<div class="item101">
								<h3 class="item101p">Данные аккаунта</h3>
								<span class="item101p">Имя: <? echo $_SESSION['name']; ?></span><br><br>
								<span class="item101p">E-mail: <? echo $_SESSION['email']; ?></span><br><br>
								<span class="item101p">Телефон: <? echo $_SESSION['phone']; ?></span>
							</div>
						</div>
							<p>Изменить данные аккаунта</p>
							<input class="textbox input-or1" name="name" placeholder="ФИО" value='<? echo $_SESSION['name'];?>' required /> <? echo $prover;?><br>
							<input class="textbox input-or1 tel" name="phone" placeholder="Номер телефона" value='<? echo $_SESSION['phone'];?>' required /> <? echo $prover5;?><br>
							<input class="textbox input-or1" name="email" placeholder="E-mail" value='<? echo $_SESSION['email'];?>' required /> <? echo $prover2;?><br>
							<li><a href="user-password.php">Изменить пароль</a></li>
							<input class="button bt5" type="submit" value="Изменить"><br><br>
							<? //вывод сообщения
								if ($i==2) {
									echo '<p style="color:green; font-family: "Open Sans", sans-serif;"> Данные изменены</p>';
								}
							?>
						</div>
					<div class="item10">
						<div class="profdat">
						<h3>Клубная карта:</h3>
						<?php
						//обращение к таблице карты пользователей и сверка по почте и вывод карты пользователя
						$email2 = $_SESSION['email'];
						$result=mysqli_query($link, "SELECT * FROM Usercard WHERE user_email='$email2'") or die(mysqli_error($link));
						while($row = mysqli_fetch_array($result)){
							$category=$row['category'];
							$name=$row['name'];
							$time=$row['time'];
							echo "<div><span>Название: $name</span></div><br>";
							echo "<div><span>Категория: $category</span></div><br>";
							echo "<div><span>Приобретение: $time</span></div><br>";
						}
						?>
						<p>После 30 дней обратитесь в центр, чтобы возобновить карту</p>
						</div>
						<div class="calc">
							<BODY BGCOLOR="#FFFFFF">
								<h3>Калькулятор каллорий</h3>
								<SCRIPT LANGUAGE="JavaScript">
								var myWeight;
								var myDistance;
								function HowMany(form)
								{
								var difference;
								difference = (myDistance * myWeight) * 1;
								form.Fdiff.value = difference;
								if (difference < 100) {
								form.comment.value="Тебе нужно лучше работать!";
								}
								if (difference >  101 && difference < 200) {
								form.comment.value="Хорошая пробежка, но ты можешь лучше.";
								}
								if (difference >  201 && difference < 300) {
								form.comment.value="Очень хорошо! В следующий раз давай больше.";
								}
								if (difference >  301 && difference < 500) {
								form.comment.value="Отлично!Ты настоящий бегун, продолжай в том же духе!";
								}
								if (difference >  501 && difference < 700) {
								form.comment.value="Ты как настоящий чемпион!";
								}
								if (difference > 701) {
								form.comment.value="Ты герой!";  
								}
								}
								function SetMyWeight(weight)
								{
								myWeight = weight.value;
								}
								function SetmyDistance(dis)
								{
								myDistance = dis.value;
								}
								function ClearForm(form){
								form.myWeight.value = "";
								form.myDistance.value = "";
								form.Fdiff.value = "";
								form.comment.value = "";
								}
								</SCRIPT>
								<BODY>
								<FORM class="form-calc" METHOD="POST">
								<TABLE border=3>
								<TR>
								<TR>
								<TD><div align=center>Вес</div></TD>
								<TD><div align=center>Километры</div></TD>
								<TD><div align=center>Сожженные калории</div></TD>
								<TD><INPUT TYPE=BUTTON ONCLICK="HowMany(this.form)" VALUE="Рассчитать"></TD>
								</TR>
								<tr>
								<TD><div align=center><INPUT TYPE=text  NAME=myWeight SIZE="4"ONCHANGE="SetMyWeight(this)"></div></TD>
								<TD><div align=center><INPUT TYPE=text  NAME=myDistance SIZE="4"ONCHANGE="SetmyDistance(this)"></div></TD>
								<TD><div align=center><INPUT TYPE=text NAME="Fdiff" VALUE="" SIZE="6"></div></TD>
								<TD><div align=center><INPUT TYPE=BUTTON VALUE="   Сброс   " onClick="ClearForm(this.form)"></div></tr>
								</table>
								<table border=3>
								<tr>
								<TD><DIV ALIGN=CENTER>Коментарий</DIV></TD>
								<TD><INPUT TYPE=text NAME="comment" size="37"></td>
								</TR>
								</TABLE>
								</FORM>
						</div>	  
					</div>
				</div>
			</form>
			
	</div>
	</div>
	<script> //маска номера телефона
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
