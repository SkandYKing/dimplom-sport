<?php session_start();

  $host = 'localhost'; //имя хоста, на локальном компьютере это localhost
  $user = 'root'; //имя пользователя, по умолчанию это root
  $password = ''; //пароль, по умолчанию пустой
  $db_name = 'inferno'; //имя базы данных

  $link = mysqli_connect($host, $user, $password, $db_name);

  mysqli_query($link, "SET NAMES 'utf8'");
?>
<?php  
//export.php

require_once('PHPExcel2/Classes/PHPExcel.php');
// Подключаем класс для вывода данных в формате excel

mysqli_query($link, "SET NAMES utf8");

$query5 = mysqli_query($link, "SELECT * FROM Orders2 where Status= 'Завершён'" );
// создание ассоциативного массива
    $myrow = mysqli_fetch_array($query5);
// подключение библиотеки «PHPExcel»
    require_once('PHPExcel2/Classes/PHPExcel.php');
    require_once('PHPExcel2/Classes/PHPExcel/Writer/Excel5.php');
$phpexcel = new PHPExcel();
// установка индекса активного листа
    $page = $phpexcel->setActiveSheetIndex(0);
// создание шапки таблицы
    $page->setCellValue("A1", "Имя");
    $page->setCellValue("B1", "Дата заказа");
    $page->setCellValue("C1", "Цена");
    $page->setCellValue("D1", "Всего заработано");
    $page->setCellValue("E1", "=SUM(C:C)");
// запись инкремента, который необходим, для вычисления номера ячейки
    $s = 1;
    $result= mysqli_query($link, "SELECT * FROM `Orders2` where Status= 'Завершён' AND `time` <= '$data2' and `time` >= '$data1'") or die(mysqli_error($link));
    $row = mysqli_num_rows($result);
    $output = '';
    $data1 = $_POST['data3'];
    $data2 = $_POST['data4'];
    while ($row = mysqli_fetch_array($query5)) {
      $s++;
      $page->setCellValue("A$s", $row['name']);
      $page->setCellValue("B$s", $row['time']);
      $page->setCellValue("C$s", $row['price']);
  }
// расположение текста по центру
  $page->getStyle("A1:E$s")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
// автоматическое назначение ширины столбца
  $page->getColumnDimension('A')->setAutoSize(true);
  $page->getColumnDimension('B')->setAutoSize(true);
  $page->getColumnDimension('C')->setAutoSize(true);
  $page->getColumnDimension('D')->setAutoSize(true);
  $page->getColumnDimension('E')->setAutoSize(true);
// назначение заголовку таблицы жирного начертания
  $page->getStyle("A1:E2")->getFont()->setBold(true);
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
  $page->getStyle("A1:K$s")->applyFromArray($border);
// установка заголовка таблицы
// заливка таблицы
  $page->getStyle("A1:K$s")->getFill()->setFillType(
      PHPExcel_Style_Fill::FILL_SOLID);
// установка цвета заливки
  $page->getStyle("A1:K$s")->getFill()->getStartColor()->setRGB('EEEEEE');
  $objWriter = PHPExcel_IOFactory::createWriter($phpexcel, 'Excel2007');
// сохранение истории расчетов в папке history
  $objWriter->save("excel/orders2.xlsx");
// всплывающее сообщение о сохранении файла
echo '<meta http-equiv="refresh" content="1;URL=admin-completed.php" />';
?>