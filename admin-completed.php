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
?>
<?php if($_SESSION['role']!='Администратор') {header('Location: index.php');} ?><!--Проверка по ролям-->
<?php require_once('header.php'); ?><!--шапка-->
<?php require_once('header-admin.php'); ?><!--шапка админа-->
<div class="cent3" id="admin">
        <h1 class="zagl">Завершенные заказы</h1>
        <? //вывод завершенных заказов
        $result = mysqli_query($link, "SELECT * FROM `Orders2` WHERE Status= 'Завершён'") or die(mysqli_error($link));
        $row = mysqli_num_rows($result);
        if (mysqli_num_rows($result) > 0){ //сортировака по дата от и до
        echo '
        <form class="excel1"  method="post">
                От:<input style="padding: 4px;" type="date" id="myInput1" name="data1" value="';  echo $_REQUEST['data1']; echo'" id="sub">
                До:<input style="padding: 4px;" type="date" id="myInput1" name="data2" value="';  echo $_REQUEST['data2']; echo'" id="sub">
                <input type="submit"  class="button bt12" name="ggo" value="Показать" id="sub"><br><br>
                </form>
                '; //вывод в табличной форме
                if (isset($_POST['all'])){ echo '
        <table  id="myTable" class="table_dark">
                <tr class="th">
                
                <th >ФИО покупателя</th>
                <th >Дата заказа</th>
                <th >Сумма заказа</th>
                
                </tr>';

      foreach ($result as $row) {
      $ress=$row['time2']; //заработано
      $price=$row['price']; //сумма
      $full_name_worker = $row['name']; //фио
      $date=$row['time']; //дата


        echo "
                        <tr>
                        <form action='kvart.php' method='post' >
                        <td><input class='krutou' type='text' readonly value='$full_name_worker' name='full_name_worker'></td>
                        <td><input class='krutou' type='text' readonly value='$date' name='date'></td>
                         <td><input type='text' readonly value='$price' class='krutou' name='price'></td>
                        </form>
                        
                        </tr>
                        ";
      }
      echo '</table>';}
      	 if (isset($_POST['data1'])) { $data1 = $_POST['data1'];} //запись первой даты

    if (isset($_POST['data2'])) { $data2 = $_POST['data2'];} //запись второй даты

                $result= mysqli_query($link, "SELECT * FROM `Orders2` where  `time` >= '$data1' AND `time` <= '$data2' and Status= 'Завершён'") or die(mysqli_error($link));
                $row = mysqli_num_rows($result); //вывод отсортированных заказов
                if (isset($_POST['ggo'])){ echo '
                <form method="post" action="admin-excel2.php">
                        <input type="submit" class="button bt15" value="Скачать в excel" id="sub">
                        <input type="date" style="display:none;" value="';  echo $_REQUEST['data1']; echo'" name="data3" id="sub" required>
                        <input type="date" style="display:none;" value="';  echo $_REQUEST['data2']; echo'" name="data4" id="sub" required></form>
                        <table  id="myTable" class="table_dark">
                <tr class="th">
                
                <th >ФИО покупателя</th>
                <th >Дата заказа</th>
                <th >Сумма заказа</th>
                
                </tr>';

      foreach ($result as $row) {
      $ress=$row['time2']; //заработано
      $price=$row['price']; //сумма
      $full_name_worker = $row['name']; //фио
      $date=$row['time']; //дата


        echo "
                        <tr>
                        <form action='kvart.php' method='post' >
                        <td><input class='krutou' type='text' readonly value='$full_name_worker' name='full_name_worker'></td>
                        <td><input class='krutou' type='text' readonly value='$date' name='date'></td>
                         <td><input type='text' readonly value='$price' class='krutou' name='price'></td>

                        </form>
                        
                        </tr>
                        ";
      }
      echo '</table>';}
  }
  else {echo "<h1 style='text-align:center;margin:15px;'>Нет cовершенных сделок</h1>";} //ошибка если нет заказов в этом диапазоне
        ?>

</div>
</div></div></div>
<?php require_once('footer.php'); ?><!--Подвал-->