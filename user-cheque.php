<?php  
session_start();
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
$host = 'localhost'; //имя хоста, на локальном компьютере это localhost
$user = 'root'; //имя пользователя, по умолчанию это root
$password = ''; //пароль, по умолчанию пустой
$dbName = 'inferno';//имя базы данных
$link = mysqli_connect($host,$user,$password,$dbName);
mysqli_query($link,"SET NAMES 'utf 8'");
$email = $_SESSION['email'];
//вывод заказа если статус завершен
$query1 = "SELECT * FROM Orders2 WHERE Status='Завершён' AND email='$email'";
$result1 = mysqli_query($link, $query1);
while ($row = mysqli_fetch_array($result1)) {
    $id=$row['id'];
    $street=$row['street'];
    $phone=$row['phone'];
    $comment=$row['comment'];
    $status=$row['status'];
    $time=$row['time'];
    $price=$row['price'];
    $city=$row['city'];
    $name=$row['name'];
    $payment=$row['payment'];
    $time2=$row['time2'];
};
//проверка номера товара по айди 
$result2=mysqli_query($link, "SELECT * FROM Orders WHERE Status='Завершён' AND email='$email'") or die(mysqli_error($link));
                while($row = mysqli_fetch_array($result2)){
                    $menu_id=$row['menu_id'];
                    $quantity=$row['quantity'];
                    $result3=mysqli_query($link, "SELECT * FROM Menu WHERE id='$menu_id'") or die(mysqli_error($link));
                    while($row = mysqli_fetch_array($result3)){
                        $name2=$row['name'];
                    }
                }
?>
<?php if($_SESSION['role']!='Пользователь') {header('Location: index.php');} ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="shortcut icon" href="img/logo4.png" type="image/png">
    <title>Распечатка чека</title>
</head>
<body class="block-check-par">
    <div class="block-check">
        <h1>Номер заказа <?php echo  $id ?></h1>
        <p>~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~</p>
        <h2>ИП САМЧЕВ А.Д.</h2>
        <p>УНП 1377474358746</p>
        <p>РГН 5137746147435</p>
        <p>Дата заказа: <?php echo  $time ?> </p>
        <p>Желаемое время: <?php echo  $time2 ?></p>
        <p>Номер телефона: <?php echo  $phone ?></p>
        <p>Email: <?php echo  $email ?></p>
        <p>ФИО: <?php echo  $name ?></p>
        <p>Город: <?php echo  $city?></p>
        <p>Адресс: <?php echo  $street ?></p>
        <p>Оплата: <?php echo  $payment ?></p>
        <p>Заказ: <?php echo  $name2 ?>  <?php echo  $quantity ?>шт.</p>
        <p>~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~</p>
        <h3>ИТОГОВАЯ ЦЕНА: <?php echo  $price .' ' .'Рублей' ?></h3>
        <p>~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~</p>
        <p>СПАСИБО!</p>
    </div>
    <span>Подсказка: ctrl + p</span>
</body>
</html>
