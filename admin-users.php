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
    //выбор пользователей кол.10
    $query = "SELECT * FROM Users LIMIT 10";
    $result = mysqli_query($link, $query);
    //ссылочное удаление пользователя
    if(isset($_GET['idd'])) {
        mysqli_query($link, (' DELETE FROM Users WHERE email = "' . $_GET['idd'] . '" '));
        $msg2 = "<p class='text-success'>Пользователь удален!</p>";
    }
	?>
<?php if($_SESSION['role']!='Администратор') {header('Location: index.php');} ?><!--Проверка по ролям-->
<?php require_once('header.php'); ?><!--шапка-->
<?php require_once('header-admin.php'); ?><!--шапка админа-->
	<div class="cent" id="admin">
  <div class="osntx1">
		<h1 class="zagl">Пользователи</h1>

		<div class="col-md-3">
                    <div class="row">
                        <div class="col-5">
                            <div class="input333">
                            <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Найти по имени" title="Type in a name"><!--поиск по имени-->
                            </div>
                            <table id="myTable" class="table_dark4">
                      <tr class="header">
                        <th class='th1'>Имя</th>
                        <th class='th1'>Email</th>
                        <th class='th1'>Телефон</th>
                        <th class='th1'>Роль</th>
                      </tr>
                      <?php
                      //выбор и вывод таблицы пользователи и их удаление
                      $result=mysqli_query($link, "SELECT * FROM Users") or die(mysqli_error($link));
                                while($row = mysqli_fetch_array($result)){
                                $table=$row['name'];
                                $table1=$row['email'];
                                $table3=$row['phone'];
                                $table4=$row['role'];
                        
                            echo "<tr>";
                                echo "<td class='td1'>" . $row[1] . "</td>";
                                echo "<td class='td1'>" . $row[4] . "</td>";
                                echo "<td class='td1'>" . $row[6] . "</td>";
                                echo "<td class='td1'>" . $row[8] . "</td>";
                                echo "<td><a class='button bt9' style='width: 124px;' ' href='admin-users.php?idd={$row['email']}'>Удалить</a></td>";
                                
                            echo "</tr>";
                        }
  ?>
</table>
<script> //поиск по имени
function myFunction() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }       
  }
}
</script>
                        </div>
                    </div>
                </div>
            </div>
        </div>
	<div id="clear"></div>
	</div>

<?php require_once('footer.php') ?><!--Подвал-->