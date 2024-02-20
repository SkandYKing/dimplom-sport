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
	//проверка правильности ввода данных
	if (!empty($_POST['email']) and !empty($_POST['password'])) {

		$email = strip_tags($_POST['email']);
		$password = strip_tags(md5($_POST['password']));

		$query = "SELECT * FROM Users WHERE Email='$email'";
		$result = mysqli_query($link, $query);
		$user = mysqli_fetch_assoc($result);
		//проверка правильности ввода данных
		if (!empty($user)) {
			//выбрать из таблицы пользователей где пароль и почта равна 
			$result = mysqli_query($link, "SELECT * FROM Users WHERE Password='$password' and Email='$email'");
			$user = mysqli_fetch_assoc($result);
			if (!empty($user)) {
				session_start();
				//сравнение пароля
				$result = mysqli_query($link, "SELECT * FROM Users WHERE Password='$password'");
				$res = mysqli_fetch_assoc($result);
				$role = $res['role'];
				$name = $res['name'];
				$stage = $res['stage'];
				$profile = $res['profile'];
				$phone = $res['phone'];
				

				$_SESSION['auth'] = true;
				$_SESSION['name'] = $name;
				$_SESSION['profile'] = $profile;
				$_SESSION['stage'] = $stage;
				$_SESSION['phone'] = $phone;
				$_SESSION['email'] = $email;
				$_SESSION['role'] = $role;
				switch ($role) { //перенаправление по ролям
				case 'Администратор' :
				echo '<meta http-equiv="refresh" content="1;URL=index.php" />';
				break;
				case 'Пользователь' :
				echo '<meta http-equiv="refresh" content="1;URL=index.php" />';
				break;
				case 'Тренер' :
				echo '<meta http-equiv="refresh" content="1;URL=index.php" />';
				break;

				}

			} else { //вывод ошибки из-за неправильных данных пароля
				$prover2='<div class="valid">Неверный пароль</div>';
			}
		} else { //вывод ошибки из-за неправильных данных почты
			$prover='<div class="valid">Неверный E-mail</div>';
		}
	}
?>

<?php require_once('header.php'); ?><!--шапка-->
	<div class="img3">
        <img src="img/r11.png" alt="">
		<div class="log_text">
            <div class="log_text123">
				<h2>Добро пожаловать</h2>
				<p>в личный кабинет Inferno!</p>
			<form class="form-at2" method="POST"  autocomplete="on">
					<div class="validate-input-at2" data-validate="Обязательное поле">
						<input class="input-at2" name="email" placeholder="E-mail" value='<? echo $email;?>' required /><? echo $prover;?>
						<span class="focus-input-at2"></span>
					</div>
					<div class="validate-input-at2" data-validate="Обязательное поле">
						<input class="input-at2" type="password" name="password" placeholder="Пароль" required /><? echo $prover2;?>
					<span class="focus-input-at2"></span>
					</div>
					<button id="submit-at" class="form-at-btn2" value="Вход">Вход</button>
			</form>
			<p>Нет аккаунта?</p>
			<a href="register.php">Регистрация</a>
			</div>
		</div>
	</div>
<?php require_once('footer.php') ?><!--Подвал-->