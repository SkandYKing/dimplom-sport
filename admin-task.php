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
<div class="cent" id="admin">
<div class="osntx1">
    <h1 class="zagl">Добавить карту</h1>
        <div class="item1222">
                <h1 class="zagl">Список задач</h1>
                <div class="col-md-6">
                            <div class="card card-tasks">
                                <div class="card-header ">
                                    <h4 class="card-title">Список задач</h4>
                                    <p class="card-category">Управление задачами по повышению эффективности</p>
                                </div>
                                <div class="card-body ">
                                    <div class="table-full-width">
                                        <table class="table">
                                            <thead>
                                            <tr>
                                                <th>
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input  select-all-checkbox" type="checkbox" data-select="checkbox" data-target=".task-select">
                                                            <span class="form-check-sign"></span>
                                                        </label>
                                                    </div>
                                                </th>
                                                <th>Задача</th>
                                                <th>Статус</th>
                                                <th>Время публикации</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            //вывод таблицы задачи
                                            $row2 = mysqli_query($link,"SELECT * FROM task ORDER BY id desc");

                                            while($myrow2 = mysqli_fetch_array($row2))
                                            {
                                                if($myrow2['status']=='Завершен') {
                                                    $d= "checked disabled";
                                                }
                                                else {
                                                    $d="";
                                                }
                                                echo "<tr>
                                                    <td>
                                                    <div class='form-check'>
                                                        <label class='form-check-label'>
                                                            <input class='form-check-input task-select'{$d} type='checkbox'>
                                                            <span class='form-check-sign'></span>
                                                        </label>
                                                    </div>
                                                </td>";

                                                echo "<td class='card-body2'>{$myrow2['task']}</td>";
                                                echo "<td class='card-body2'>{$myrow2['status']}</td>";
                                                echo "<td class='card-body2'>{$myrow2['ts']}</td>";
                                                echo "</tr>";
                                            }

                                            ?>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            <div class="div10">
                                <div class="card-footer ">
                                    <div class="stats rep">
                                        Задачи обновлены: <?php $query = mysqli_query($link, 'SELECT * FROM task ORDER BY id desc LIMIT 1');
                                        $data = mysqli_fetch_assoc($query);
                                        echo $data['ts'];?>
                                    </div>
                                    <?php if (isset($_SESSION['role']) && ($_SESSION['role']=='1') || ($_SESSION['role']=='4')){ ?>
                                    <?php }?>
                                </div>
                                      <div class="stats">
                                        <a href="admin-tasks2.php" class='button bt17'>Перейти к задачам</a><br><br>
                                    </div>
                            </div>
                            </div>
                        </div>
                    </div>
            </div></div>
<?php require_once('footer.php') ?><!--Подвал-->