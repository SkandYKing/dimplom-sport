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
//выбор заказов в колличества 10 штук
	$query = "SELECT * FROM Orders2 LIMIT 10";
$result = mysqli_query($link, $query);
	?>
	<?php
// выборка из таблицы «output»
    $query5 = mysqli_query($link, "SELECT * FROM Orders2");
// создание ассоциативного массива
    $myrow = mysqli_fetch_array($query5);
// подключение библиотеки «PHPExcel»
    require_once 'PHPExcel/Classes/PHPExcel.php';
// создание нового файла
    $phpexcel = new PHPExcel();
// установка индекса активного листа
    $page = $phpexcel->setActiveSheetIndex(0);
// объединение ячеек для заголовка таблицы
    $page->mergeCells('A1:K1');
// создание шапки таблицы
    $page->setCellValue("A2", "Id");
    $page->setCellValue("B2", "Имя");
    $page->setCellValue("C2", "Email");
    $page->setCellValue("D2", "Телефон");
    $page->setCellValue("E2", "Комментарий");
    $page->setCellValue("F2", "Цена");
    $page->setCellValue("G2", "Оплата");
    $page->setCellValue("H2", "Город");
    $page->setCellValue("I2", "Улица");
    $page->setCellValue("J2", "Статус");
    $page->setCellValue("K2", "Время желаемой доставки");
// запись инкремента, который необходим, для вычисления номера ячейки
    $s = 2;
// создание ассоциативного массива
    while ($row5 = mysqli_fetch_array($query5)) {
        $fio = "{$row5['id']}";
        $s++;
        $page->setCellValue("A$s", $fio);
        $page->setCellValue("B$s", $row5['name']);
        $page->setCellValue("C$s", $row5['email']);
        $page->setCellValue("D$s", $row5['phone']);
        $page->setCellValue("E$s", $row5['comment']);
        $page->setCellValue("F$s", $row5['price']);
        $page->setCellValue("G$s", $row5['payment']);
        $page->setCellValue("H$s", $row5['city']);
        $page->setCellValue("I$s", $row5['street']);
        $page->setCellValue("J$s", $row5['status']);
        $page->setCellValue("K$s", $row5['time2']);
    }
// расположение текста по центру
    $page->getStyle("A1:K$s")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
// автоматическое назначение ширины столбца
    $page->getColumnDimension('A')->setAutoSize(true);
    $page->getColumnDimension('B')->setAutoSize(true);
    $page->getColumnDimension('C')->setAutoSize(true);
    $page->getColumnDimension('D')->setAutoSize(true);
    $page->getColumnDimension('E')->setAutoSize(true);
    $page->getColumnDimension('F')->setAutoSize(true);
    $page->getColumnDimension('G')->setAutoSize(true);
    $page->getColumnDimension('H')->setAutoSize(true);
    $page->getColumnDimension('I')->setAutoSize(true);
    $page->getColumnDimension('J')->setAutoSize(true);
    $page->getColumnDimension('K')->setAutoSize(true);
// назначение заголовку таблицы жирного начертания
    $page->getStyle("A1:K2")->getFont()->setBold(true);
// установка границ таблицы
    $border = array(
        'borders' => array(
            'allborders' => array(
// стиль границ
                'style' => PHPExcel_Style_Border::BORDER_THIN,
// цвет границ
                'color' => array('rgb' => '000000')
            )
        )
    );
// применение стилей
    $page->getStyle("A2:K$s")->applyFromArray($border);
// установка заголовка таблицы
    $page->setCellValue("A1", 'Заказы');
// заливка таблицы
    $page->getStyle("A1:K$s")->getFill()->setFillType(
        PHPExcel_Style_Fill::FILL_SOLID);
// установка цвета заливки
    $page->getStyle("A1:K$s")->getFill()->getStartColor()->setRGB('EEEEEE');
    $objWriter = PHPExcel_IOFactory::createWriter($phpexcel, 'Excel2007');
// сохранение истории расчетов в папке history
    $objWriter->save("excel/orders.xlsx");
// всплывающее сообщение о сохранении файла


?>
<?php if($_SESSION['role']!='Администратор') {header('Location: index.php');} ?><!--Проверка по ролям-->
<?php require_once('header.php'); ?><!--шапка-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script><!--подключение ajax-->
<?php require_once('header-admin.php'); ?><!--шапка админа-->
<div class="cent" id="admin">
  <div class="osntx1">
		<h1 class="zagl">Поиск заказов</h1>
		<div class="input333">
		<input type="date" style="padding: 7px;" id="myInput1" onkeyup="dateFunction()" placeholder="Search for dates.." title="Type in a name"><!--поиск по дате-->
		<input type="text" id="myInput" onkeyup="myFunction()" placeholder="Найти по статусу" title="Type in a name"><!--поиск по статусу-->

            <a class='button bt14' href='admin-search.php?ide=1'>Экспорт в Excel</a>
		</div>
		<table id="myTable" class="table_dark">
  <tr class="header">
    <th class='th1'>Номер заказа</th>
	<th class='th1'>Имя</th>
	<th class='th1'>Email</th>
	<th class='th1'>Телефон</th>
	<th class='th1'>Комментарий</th>
	<th class='th1'>Цена</th>
	<th class='th1'>Оплата</th>
  <th class='th1'>Город</th>
  <th class='th1'>Улица</th>
  <th class='th1'>Статус</th>
  <th class='th1'>Дата</th>
  <th class='th1'>Дата заказа</th>
  <th class='th1'>Во сколько</th>
  </tr>
  <?php
  //вывод в табличной форме таблицу заказы
	while ($row = mysqli_fetch_array($result)) {
		echo "<tr>";
			echo "<td class='td1'>" . $row[0] . "</td>";
			echo "<td class='td1'>" . $row[1] . "</td>";
			echo "<td class='td1'>" . $row[2] . "</td>";
			echo "<td class='td1'>" . $row[3] . "</td>";
			echo "<td class='td1'>" . $row[4] . "</td>";
			echo "<td class='td1'>" . $row[5] . "</td>";
			echo "<td class='td1'>" . $row[6] . "</td>";
      echo "<td class='td1'>" . $row[7] . "</td>";
      echo "<td class='td1'>" . $row[8] . "</td>";
      echo "<td class='td1'>" . $row[9] . "</td>";
      echo "<td class='td1'>" . $row[10] . "</td>";
      echo "<td class='td1'>" . $row[11] . "</td>";
      echo "<td class='td1'>" . $row[12] . "</td>";
		echo "</tr>";
    
	}
  ?>
</table>
</div></div>
<script> //поиск по статусу
function myFunction() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[9];
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
//поиск по дате
function dateFunction() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInput1");
  console.log(input);
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[11];
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

<?php require_once('footer.php') ?><!--Подвал-->
	
