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
	//проверка полей
	if (!empty($_POST['name']) and !empty($_POST['email']) and !empty($_POST['password']) and !empty($_POST['password2'])) {

		$name = strip_tags($_POST['name']);
		$email = strip_tags($_POST['email']);
		$phone = strip_tags($_POST['phone']);
		$password = strip_tags($_POST['password']);
		$password2 = strip_tags($_POST['password2']);

		$i=0;
		//проверка на имя
		if(preg_match("/^[a-zA-Zа-яёА-ЯЁ\s\-]+$/u", $name)) {
			$i++;
		} else { $prover='<div class="valid">Некорректное ФИО</div>';}
		//проверка на почту
		if(preg_match("/^(?:[a-z0-9]+(?:[-_.]?[a-z0-9]+)?@[a-z0-9_.-]+(?:\.?[a-z0-9]+)?\.[a-z]{2,5})$/i", $email)) {
			$i++;
		} else { $prover2='<div class="valid">Некорректная почта</div>';}
		//проверка на номер телефона
		if(preg_match('/^((8|\+7)[\- ]?)?(\(?\d{3}\)?[\- ]?)?[\d\- ]{7,10}$/', $phone)) {
			$i++;
		} else { $prover5='<div class="valid">Некорректный номер телефона</div>';}
		//проверка на схожесть паролей и правильный ввод пароля
		if(preg_match("#^[a-zA-Z0-9]{6,14}$#", $password)) {
			$i++;
		} else { $prover3='<div class="valid">Пароль должен иметь длинну от 6 до 14 символов</div>';}
		if ($password==$password2) {
			$i++;
		} else { $prover4='<div class="valid">Пароли не совпадают</div>'; }
		//обращение к таблице пользователи и сверка по почте
		$user = mysqli_fetch_assoc(mysqli_query($link, "SELECT * FROM Users WHERE Email='$email'"));
		if (empty($user)) {
			$i++;
		} else { $prover='<div class="valid">E-mail уже используется</div>'; }
		//проверка фото по формату и размеру
		$path = 'userimg/';
		$types = array('image/gif', 'image/png', 'image/jpeg', 'image/jpg');
		$size = 2000000;

		if ($_SERVER['REQUEST_METHOD'] == 'POST')
		{
			if (!in_array($_FILES['picture']['type'], $types)) {
				$prover6='<div class="valid">Запрещённый тип файла</div>'; } else { $i++;}
			if ($_FILES['picture']['size'] > $size) {
				$prover6='<div class="valid">Слишком большой размер файла</div>'; } else { $i++;}
			if (!@copy($_FILES['picture']['tmp_name'], $path . $_FILES['picture']['name']))
				echo 'Что-то пошло не так';
		}
		if ($i==8) {
			//хеширование пароля
			$password = md5($password);
			//добавление фото в папку
			$img = 'userimg/'.$_FILES['picture']['name'];
			//записывание данных в таблицу пользователи
			$query2 = "INSERT INTO Users (name, profile, stage, email, password, phone, img, role, card) VALUES('$name','$profile','$stage','$email','$password','$phone','$img','Пользователь','0');";
			mysqli_query($link, $query2);
			$_SESSION['name'] = $name;
			$_SESSION['phone'] = $phone;
			$_SESSION['email'] = $email;
			$_SESSION['role'] = $role;

			echo '<meta http-equiv="refresh" content="1;URL=login.php" />';//перенаправление на страницу авторизации
		}
	}
?>
<?php require_once('header.php'); ?>
<div class="img3">
        <img src="img/r11.png" alt="">
		<div class="log_text1">
            <div class="log_text1233">
				<h2>Регистрация</h2><br>
				<form class="form" method="POST"  enctype="multipart/form-data" autocomplete="on">
					<input class="textbox input-or5" name="name" placeholder="ФИО" value='<? echo $name;?>' required /> <? echo $prover;?><br>
					<input class="textbox input-or5" name="email" placeholder="E-mail" value='<? echo $email;?>' required /> <? echo $prover2;?><br>
					<input class="textbox input-or5 tel" name="phone" placeholder="Номер телефона" value='<? echo $phone;?>' required /> <? echo $prover5;?><br>
					<input class="textbox input-or5" type="password" name="password" placeholder="Пароль" required /> <? echo $prover3;?><br>
					<input class="textbox input-or5" type="password" name="password2" placeholder="Повторите пароль" required /> <? echo $prover4;?><br>
					<input class="file" name="picture" type="file" required /><? echo $prover6;?><br><br>
					<input type="checkbox" class="checkbox" name="option" value="a2" required /><span>Согласие на обработку персональных данных</span><br><br>
						<button id="submit-at" class="form-at-btn2" value="Вход">Регистрация</button>
						<a class="a9" href="login.php">Авторизация</a>
						<? //вывод сообщения 
							if ($i==8) {
								echo '<p style="color:green; margin-top: 20px; margin-left: -5px; font-family: "Open Sans", sans-serif;"> Регистрация прошла успешно</p>';
							}
						?>
				</form>
			</div>
		</div>	
</div>
<script> //маска для номера телефона
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
<?php require_once('footer.php') ?><!--Подвал-->