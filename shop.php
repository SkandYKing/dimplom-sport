<?php require_once('header.php') ?><!--шапка-->
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
//добавление товара в корзину
if (isset($_POST['quantity'])) {
    $id = $_POST['id'];
    $quantity = $_POST['quantity'];
    $query = "INSERT INTO Orders (email, menu_id, quantity, status) VALUES('$email','$id','$quantity','Обработка')";
    mysqli_query($link, $query) or die(mysqli_error($link));
}

?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script><!--подключение js jquery-->
<script> //фильтр по категории товаров
    $(document).ready(function(){
        $('#all').click(function(){
            $(".Аксессуары").css("display", "inline-block");
            $(".Здоровье").css("display", "inline-block");
            $(".Инвентарь").css("display", "inline-block");
        });
        $('#Аксессуары').click(function(){
            $(".sport").css("display", "inline-block");
            $(".Здоровье").css("display", "none");
            $(".Инвентарь").css("display", "none");
        });
        $('#Здоровье').click(function(){
            $(".Аксессуары").css("display", "none");
            $(".Здоровье").css("display", "inline-block");
            $(".Инвентарь").css("display", "none");
        });
        $('#Инвентарь').click(function(){
            $(".Аксессуары").css("display", "none");
            $(".Здоровье").css("display", "none");
            $(".Инвентарь").css("display", "inline-block");
        });
    });
</script>
<div class="header3">
    <h2>Меню</h2>
</div>
<div class="cent2" id="backpackcatalog">
    <div class="top-menu">
        <ul>
            <li id="all"><p>Все</p></li>
            <li id="Аксессуары"><p>Спортивные аксессуары</p></li>
            <li id="Здоровье"><p>Здоровье</p></li>
            <li id="Инвентарь"><p>Спортивный инвентарь</p></li>
                        <?php //вывод кнопки корзина если авторизован
                if (($_SESSION['role'])=='Пользователь') {
                echo '
            <li><a class="bt18" href="user-order.php">Корзина</a></li>
            ';
                }
            ?>
        </ul>
    </div>

    <div class="row1">

       <?php
       //вывод товаров из таблицы меню
            $result=mysqli_query($link, "SELECT * FROM Menu") or die(mysqli_error($link));
                while($row = mysqli_fetch_array($result)){
                $name=$row['name'];
                $description=$row['description'];
                $category=$row['category'];
                $img=$row['img'];
                $price=$row['price'];
                $id=$row['id'];


                echo "
                <div class='$category' style='box-shadow: 0px 1px 15px 1px rgb(69 65 78 / 8%); margin: 20px; padding: 10px;'>
                    <div class='menuimg'>
                        <img style='width:200px;' src='$img'>
                    </div>
                <div class='desc'>
                    <h3>$name</h3>
                    <p>$description</p>
                    <p class='price'>$price руб.</p>";
                            if (($_SESSION['role'])=='Пользователь') {//если роль пользователь вывод выбора колличества товара и кнопки в корзину
                            echo "
                                <form class='newme' method='POST'>
                                    <span>Кол-во:</span><input class='bt20' type='number' max='20' min='1'  name='quantity' required />
                                    <input style='display:none;' name='id' value='$id' required />
                                    <input class='button bt19' name='stat' type='submit' value='В корзину'>
                                </form>";
                            }
                    echo "
                </div>
                </div>";
                }
            ?>

</div>
<?php require_once('footer.php') ?><!--Подвал-->