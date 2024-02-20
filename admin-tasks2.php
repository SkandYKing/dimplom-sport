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
<?php
//удаление 
if(isset($_GET['idd'])) {
    mysqli_query($link, (' DELETE FROM task WHERE id = "' . $_GET['idd'] . '" '));
    $msg2 = "<p class='text-success'>Задача удалена!</p>";
}
//завершение задачи
if(isset($_GET['idz'])) {
    mysqli_query($link, 'UPDATE task SET '
        . 'status="Завершен"'
        . 'WHERE `id`=' . $_GET['idz']);
    $msg2 = "<p class='text-success'>Задача завершена!</p>";
}
//добавление задачи
if(isset($_POST['dob'])){

        $reg=mysqli_query($link, 'INSERT INTO task(task) 
VALUES ("' . $_POST['task'] . '")');
//сообщение об обновление задачи
        $msg= "<p class='text-success'>Задача добавлена!</p>";
   }
?>
<?php if($_SESSION['role']!='Администратор') {header('Location: index.php');} ?><!--Проверка по ролям-->
<?php require_once('header.php'); ?><!--шапка-->
<?php require_once('header-admin.php'); ?><!--шапка админа-->
<div class="cent" id="admin">
            <div class="osntx2">
                        <h4 class="zagl">Управление задачами</h4>
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">Задачи компании</div>
                                <?php echo $msg2; ?>
                            </div>
                            <div class="card-body">
                                <div class="task2">
                                <table class="table table-head-bg-primary table-striped table-hover">
                                    <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Задача</th>
                                        <th scope="col">Дата/Время</th>
                                        <th scope="col">Статус</th>
                                        <th scope="col"></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    //вывод таблицы задачи
                                    $row2 = mysqli_query($link,"SELECT * FROM task ORDER BY id desc ");

                                    while($myrow2 = mysqli_fetch_array($row2))
                                    {
                                        echo "<tr>";
                                        echo "<td>{$myrow2['id']}</td>";
                                        echo "<td>{$myrow2['task']}</td>";
                                        echo "<td>{$myrow2['ts']} </td>";
                                        echo "<td>{$myrow2['status']}</td>";

                                            if ($myrow2['status'] == 'Ожидает' ){
                                                echo "<td><a class='button bt14'  href='admin-tasks2.php?idd={$myrow2['id']}'>Удалить</a>";
                                                echo "<a class='button bt14' href='admin-tasks2.php?idz={$myrow2['id']}'>Завершить</a></td>";

                                        } else {
                                            echo "<td>&nbsp;</td>";
                                        }
                                        echo "</tr>";
                                    }

                                    ?>

                                    </tbody>
                                </table>
                                </div>

                            </div>


                                    

                                <form method="post">
                                    <div class="card-header">
                                        <div class="card-title">Добавить задачу</div>
                                    <?php echo $msg; ?>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="task">Задача</label>
                                            <input type="text" class="form-control"  maxlength="200"  name="task" placeholder="Введите задачу" required>
                                        </div>
                                    </div>
                                    <div class="card-action">
                                        <button type="submit" name="dob" class="button bt14" >Добавить задачу</button></form>




                            </div>

                    </div>



                    </div> </div>   </div>

<?php include 'footer.php';?><!--Подвал-->