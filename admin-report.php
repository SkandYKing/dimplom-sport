<?php include 'db.php'; ?>
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
<script src="node_modules/chart.js/dist/Chart.bundle.min.js"></script><!--подключение js-->
<script src="script.js"></script><!--подключение js-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.bundle.min.js"></script><!--подключение js-->
<?php require_once('header-admin.php'); ?><!--шапка админа-->
<div class="cent" id="admin">
		<h1 class="zagl">Отчет</h1>
        <div class="grid-container12">
			<div class="item122">
                <div class="container1">
                <canvas id="myChart"></canvas>
                </div>
                <script> //вывод круговой диаграммы
                <?php
                //вывод данных из таблицы заказы
                $row2 = mysqli_query($link,"SELECT * FROM Orders2");
                $dohod=0;
                $ob=0;
                $zakaz2=0;
                $zakaz=0;
                //вывод где статус завершен и в пути,вывод цены
                while($myrow2 = mysqli_fetch_array($row2)) {
                    $zakaz2++;
                    if ($myrow2['status'] == 'Завершён') {
                        $dohod=$dohod+$myrow2['price'];
                        $ob=$ob+$myrow2['price'];
                        $zakaz++;
                    }
                    if ($myrow2['status'] == 'В пути') {
                        $ob=$ob+$myrow2['price'];
                        $zakaz++;
                    }
                }
                $proc=$dohod/($ob/100);
                $przk=$zakaz/($zakaz2/100);
                ?>
                <?php
                //вывод данных из тренировок
                $rowt2 = mysqli_query($link,"SELECT * FROM Zapisi");
                $dohodt=0;
                $obt=0;
                $zakazt2=0;
                $zakazt=0;
                //вывод где статус завершен и в пути,вывод цены
                while($myrowt2 = mysqli_fetch_array($rowt2)) {
                    $zakazt2++;
                    if ($myrowt2['status'] == 'Завершен') {
                        $dohodt=$dohodt+$myrowt2['price'];
                        $obt=$obt+$myrowt2['price'];
                        $zakazt++;
                    }
                    if ($myrowt2['status'] == 'В пути') {
                        $obt=$obt+$myrowt2['price'];
                        $zakazt++;
                    }
                }
                $proct=$dohodt/($obt/100);
                $przkt=$zakazt/($zakazt2/100);
                ?>
                <?php 
                //вывод данных из таблицы заказы
                $row2 = mysqli_query($link,"SELECT * FROM Orders2");
                $zatrat=0;
                //вывод ЗАТРАТЫ где статус завершен ,вывод цены
                while($myrow2 = mysqli_fetch_array($row2)) {
                    $zakaz++;
                    if ($myrow2['status'] == 'Завершён') {
                        $zatrat=($zatrat+$myrow2['price']/3);
                    }
                }
                ?>
                <?php 
                //вывод колличества карт пользователей и цена
                $row3 = mysqli_query($link,"SELECT * FROM Usercard");
                $card=0;
                while($myrow3 = mysqli_fetch_array($row3)) {
                    $zakaz++;
                    $card=($card+$myrow3['price']);
                }
                ?> //диаграмма круговая
                var ctx = document.getElementById('myChart').getContext('2d');
                var myChart = new Chart(ctx, {
                    type: 'doughnut',
                    data: {
                        labels: ['Доход от товаров <?php echo $dohod?>', 'Доход от тренировок <?php echo $dohodt?>', 'Доход от карт <?php echo $card?>', 'Затрат <? echo round($zatrat,0);?>'],
                        datasets: [{
                            data: [<?php echo $dohod?>, <?php echo $dohodt?>, <?php echo $card?>, <?php echo $zatrat?>],
                            backgroundColor: ['#e91e63', '#00e676','#1e88e5', '#ffd600'],
                            borderWidth: 0.5 ,
                            borderColor: '#ddd'
                        }]
                    },
                    options: {
                        title: {
                            display: true,
                            text: 'Доходы ',
                            position: 'top',
                            fontSize: 16,
                            fontColor: '#575962',
                            padding: 20
                        },
                        legend: {
                            display: true,
                            position: 'bottom',
                            labels: {
                                boxWidth: 20,
                                fontColor: '#575962',
                                padding: 15
                            }
                        },
                        tooltips: {
                            enabled: false
                        },
                        plugins: {
                            datalabels: {
                                color: '#575962',
                                textAlign: 'center',
                                font: {
                                    lineHeight: 1.6
                                },
                                formatter: function(value, ctx) {
                                    return ctx.chart.data.labels[ctx.dataIndex] + '\n' + value + '%';
                                }
                            }
                        }
                    }
                });</script>
                </div>


            <div class="item12">
                <div class="container3">
                    <canvas id="myChart2"></canvas>
                <script>
                        <?php 
                        //вывод колличества пользователей где роль пользователь
                        $row2 = mysqli_query($link,"SELECT * FROM Users WHERE Role='Пользователь'");
                        $pol=0;
                        while($myrow2 = mysqli_fetch_array($row2)) {
                            $pol++;
                        }
                        ?>
                        <?php 
                        //вывод приобритенных карт
                        $row3 = mysqli_query($link,"SELECT * FROM Usercard");
                        $zat=0;
                        while($myrow3 = mysqli_fetch_array($row3)) {
                            $zat++;
                        }
                        ?>
                        //вывод статистики по пользователям и приобритенным картам
                var ctx = document.getElementById('myChart2').getContext('2d');
                var myChart2 = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: ['Пользователи', 'Клубные карты'],
                        datasets: [{
                            label: 'Статистика пользователей и клубных карт',
                            data: [ <?php echo $pol?>, <?php echo  $zat ?>],
                            backgroundColor: [
                                'rgba(216, 27, 96, 0.6)',
                                'rgba(84, 110, 122, 0.6)'
                            ],
                            borderColor: [
                                'rgba(216, 27, 96, 1)',
                                'rgba(84, 110, 122, 1)'
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        legend: {
                            display: false
                        },
                        title: {
                            display: true,
                            text: 'Статистика пользователей и клубных карт',
                            position: 'top',
                            fontSize: 16,
                            padding: 20
                        },
                        scales: {
                            yAxes: [{
                                ticks: {
                                    min: 0
                                }
                            }]
                        }
                    }
                });
                </script>
                </div>

                <div class="container2">
                    <canvas id="myChart3"></canvas>
                <script>
                    <?php
                    //вывод из таблицы колличество заказов где статус заверщен и в пути
                        $row2 = mysqli_query($link,"SELECT * FROM Orders2");
                        $dohod=0;
                        $ob=0;
                        $zakaz2=0;
                        $zakaz=0;
                        while($myrow2 = mysqli_fetch_array($row2)) {
                            $zakaz2++;
                            if ($myrow2['status'] == 'Завершён') {
                                $dohod=$dohod+$myrow2['price'];
                                $ob=$ob+$myrow2['price'];
                                $zakaz++;
                            }
                            if ($myrow2['status'] == 'В пути') {
                                $ob=$ob+$myrow2['price'];
                                $zakaz++;
                            }
                        }
                        $proc=$dohod/($ob/100);
                        $przk=$zakaz/($zakaz2/100);
                        ?>
                <?php
                //вывод из таблицы колличество тренировок где статус завершен
                        $rowt2 = mysqli_query($link,"SELECT * FROM Zapisi");
                        $dohodt=0;
                        $obt=0;
                        $zakazt2=0;
                        $zakazt=0;
                        while($myrowt2 = mysqli_fetch_array($rowt2)) {
                            $zakazt2++;
                            if ($myrowt2['status'] == 'Завершен') {
                                $dohodt=$dohodt+$myrowt2['price'];
                                $obt=$obt+$myrowt2['price'];
                                $zakazt++;
                            }
                            if ($myrowt2['status'] == 'В пути') {
                                $obt=$obt+$myrowt2['price'];
                                $zakazt++;
                            }
                        }
                        $proct=$dohodt/($obt/100);
                        $przkt=$zakazt/($zakazt2/100);
                        ?>
                // диаграмма заказов и тренировок
                var ctx = document.getElementById('myChart3').getContext('2d');
                var myChart3 = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: ['Заказы', 'Тренировки'],
                        datasets: [{
                            label: 'Завершенные заказы и тренировки',
                            data: [<?php echo $zakaz?>, <?php echo $zakazt?>],
                            backgroundColor: [
                                'rgba(29, 233, 182, 0.6)',
                                'rgba(156, 39, 176, 0.6)'
                            ],
                            borderColor: [

                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        legend: {
                            display: false
                        },
                        title: {
                            display: true,
                            text: 'Завершенные заказы и тренировки',
                            position: 'top',
                            fontSize: 16,
                            padding: 20
                        },
                        scales: {
                            yAxes: [{
                                ticks: {
                                    min: 0
                                }
                            }]
                        }
                    }
                });
                </script>
            </div>
        </div>
        </div>
        <div class="grid-container12">
			<div class="item1222">
                <h1 class="zagl">Статистика посещений</h1>
                <div class="div11">
                    <p class="p3"><a class="button bt15" href="?interval=1">За сегодня</a></p><br>
                    <p class="p3"><a class="button bt15" href="?interval=7">За последнюю неделю</a></p>
                </div>
                <table border="1px solid black" id="myTable" class="table_dark3">

                <tr class="header" style="border: 1px solid #ff7350;;"> 
                <th class='th1'>Дата</td>
                <th class='th1'>Уникальных посетителей</td>
                <th class='th1'>Просмотров</td>
                </tr>
                    
                <?php
                // Если в массиве GET есть элемент interval (т.е. был клик по одной из ссылок выше)
                if ($_GET['interval'])
                {
                $interval = $_GET['interval'];
                // Если в качестве параметра передано не число
                if (!is_numeric ($interval))
                {
                    echo '<p><b>Недопустимый параметр!</b></p>';
                }
                // Указываем кодировку, в которой будет получена информация из базы
                @mysqli_query ($db, 'set character_set_results = "utf8"');
                // Получаем из базы данные, отсортировав их по дате в обратном порядке в количестве interval штук
                $res = mysqli_query($db, "SELECT * FROM `visits` ORDER BY `date` DESC LIMIT $interval");
                // Формируем вывод строк таблицы в цикле
                while ($row = mysqli_fetch_assoc($res))
                {
                    echo '<tr>
                        <td style="border: 1px solid #ff7350;;">' . $row['date'] . '</td>
                        <td style="border: 1px solid #ff7350;;">' . $row['hosts'] . '</td>
                        <td style="border: 1px solid #ff7350;;">' . $row['views'] . '</td>
                        </tr>';
                }
                }
                ?>
                </table>
            </div>
            
        </div>        
	</div>

<?php require_once('footer.php') ?>