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
		//добавление товара
		if (!empty($_POST['name']) and !empty($_POST['description']) and !empty($_POST['category']) and !empty($_POST['price'])) {

			$name = strip_tags($_POST['name']);
            $description = strip_tags($_POST['description']);
			$category = $_POST['category'];
			$price = strip_tags($_POST['price']);
			$i = 0;
			//проверка имени
			if (preg_match("/^[a-zA-Zа-яёА-ЯЁ0-9\s\-]+$/u", $name)) {
				$i++;
			} else { $prover='<div class="valid">Некорректное название</div>';}
			//проверка категории
			if ($category=="Выберите категорию") {
					$prover2='<div class="valid">Выберите категорию</div>';
				} else { $i++;}
				//добавление фото(проверка по формату и длине)
				$path = 'menuimg/';
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

			if ($i==4) {
				//добавление фото в папку
				$img = 'menuimg/'.$_FILES['picture']['name'];
				//записывание в бд
				$query2 = "INSERT INTO Menu (name,description,category,price,img) VALUES('$name','$description','$category','$price','$img');";
				mysqli_query($link, $query2);
			}
		}
	?>
<?php if($_SESSION['role']!='Администратор') {header('Location: index.php');} ?><!--Проверка по ролям-->
<?php require_once('header.php'); ?><!--шапка-->
<?php require_once('header-admin.php'); ?><!--шапка админа-->
<div class="cent" id="admin">
	<div class="osntx1">
        <h1 class="zagl">Добавить товар</h1>
		<div class="trener-prof">	
			<form class="form" method="POST" enctype="multipart/form-data" autocomplete="on">
					<input class="textbox input-or" name="name" placeholder="Название" value='<? echo $name;?>' required /> <? echo $prover;?><br>
					<input class="textarea input-or" name="description" placeholder="Описание" value='<? echo $description;?>' required /><br>
					<select class="select input-or" name="category"> 
						<option value="Выберите категорию">Выберите категорию</option>
						<option value='Аксессуары'>Спортивные аксессуары</option>
						<option value='Здоровье'>Здоровье</option>
						<option value='Инвентарь'>Спортивный инвентарь</option>
					</select> <? echo $prover2;?><br>
					<input class="textbox input-or" name="price" placeholder="Цена" value='<? echo $price;?>' required /> <br>
					<input class="file" name="picture" type="file" required /><? echo $prover3;?><br><br>
					<input class="button bt13" type="submit" value="Добавить"><br><br>
					<? //сообщение о добавлении 
						if ($i==4) {
							echo '<p style="color:green; font-family: "Open Sans", sans-serif;">Успешно добавлено</p>';
						}
					?>
			</form>
		</div>
	</div>
	</div>
<?php require_once('footer.php') ?><!--Подвал-->