<?
	$host = 'localhost'; //имя хоста, на локальном компьютере это localhost
	$user = 'root'; //имя пользователя, по умолчанию это root
	$password = ''; //пароль, по умолчанию пустой
	$db_name = 'inferno'; //имя базы данных

	$link = mysqli_connect($host, $user, $password, $db_name);

	mysqli_query($link, "SET NAMES 'utf8'");
	//проверка правильности ввода 
	if (!empty($_POST['name']) and !empty($_POST['phone']) and !empty($_POST['direction'])) {

		$name = strip_tags($_POST['name']);
		$phone = strip_tags($_POST['phone']);
        $direction = $_POST['direction'];
		$i=0;
        //проверка на правильность имени
		if(preg_match("/^[a-zA-Zа-яёА-ЯЁ\s\-]+$/u", $name)) {
			$i++;
		} else { $prover='<div class="valid">Некорректное ФИО</div>';}
        //проверка на правильность телефона
		if(preg_match('/^((8|\+7)[\- ]?)?(\(?\d{3}\)?[\- ]?)?[\d\- ]{7,10}$/', $phone)) {
			$i++;
		} else { $prover2='<div class="valid">Некорректный номер телефона</div>';}
        //проверка был ли этот номер телефона
        $user = mysqli_fetch_assoc(mysqli_query($link, "SELECT * FROM Calls WHERE phone='$phone'"));
		if (empty($user)) {
			$i++;
		} else { $prover2='<div class="valid">Такой номер телефона уже был</div>'; }

		if ($i==3) {
            //запись в таблицу звонки
			$query2 = "INSERT INTO Calls (name, phone, direction, status) VALUES('$name','$phone','$direction','Новый');";
			mysqli_query($link, $query2);

		}
	}
?>
<?php require_once('header.php'); ?>
<?php include 'count.php';?>
<?php include 'show_stats.php';?>
            <div class="img3">
                <img src="img/bq4.png" alt="">
                <div class="header_text">
                    <div class="header_text123">
                        <div class="header_text1">
                            Спортивный центр
                        </div>
                        <div class="header_text2">
                        Оставьте заявку и получите лучшее ценовое предложение
                        </div>
                        <div class="header_bt">
                            <a href="#usl"><input style="cursor: pointer;" class="bt1" type="submit" value='Получить предложение'></a>
                        </div>
                    </div>
                </div>
            </div>
        <main class="main">
            <div class="main1">
                <div class="grid-container">
                    <div class="item">
                        <div class="item1">
                            <h2>ПРОСТРАНСТВО, СОЗДАННОЕ ДЛЯ ФИТНЕСА И ОТДЫХА</h2>
                            <p>Тренажерный зал, бассейн с аэромассажем и водопадом, сайкл, пилатес, функциональный тренинг и силовые программы, бокс, йога, танцы, детский клуб и компьютерная диагностика, SPA-зона с банным комплексом и массаж. Качество. Профессионализм. Индивидуальный подход.</p>
                            <br><p>Вы и ваши результаты важны для нас!</p>
                            <a href="#usl"><input style="cursor: pointer;" class="bt2" type='submit' value='Абонименты'></a>
                        </div>
                    </div>
                    <div class="item">
                        <div class="item_img">
                            <img src="img/about.jpg" alt="">
                        </div>   
                    </div>
                </div>
                <div class="grid-container2">
                    <div class="item2">
                        <div class="item1101">
                            <div class="item_img2">
                                <img src="img/item2.PNG">
                            </div>
                            <p class="p1">Удобное местоположение</p><br>
                            <p>Комплекс находится в середине города</p>
                        </div>
                    </div>
                    <div class="item2">
                        <div class="item22">
                            <div class="item_img2">
                                <img src="img/item4.PNG">
                            </div>
                            <p class="p1">Эффективная работа</p><br>
                            <p>Персональных тренеровки</p>
                        </div>
                    </div>
                    <div class="item2">
                        <div class="item33">
                            <div class="item_img2">
                                <img src="img/item1.PNG">
                            </div>
                            <p class="p1">Модернизированные технологии</p><br>
                            <p>Самые новые тренажерные средства</p>
                        </div>
                    </div>
                    <div class="item2">
                        <div class="item44">
                            <div class="item_img2">
                                <img src="img/item3.PNG">
                            </div>
                            <p class="p1">Удобная оплата</p><br>
                            <p>Оплата принимается картой, наличными и переводом</p>
                        </div>
                    </div>
                </div>
                <div class="gr9" id='usl'>
                    <h3>Услуги клуба</h3>
                    <div class="gr99">
                        <div class="gr9_img9">
                            <img src="img/4-min.png">
                        </div>
                    </div>
                    <div class="grid-container9">
                        <div class="item9">
                            <div class="item99">
                                <div class="item_img9">
                                    <img src="img/ss1.PNG">
                                </div>
                                <p class="p9">Бассейн</p><br>
                            </div>
                        </div>
                        <div class="item9">
                            <div class="item99">
                                <div class="item_img9">
                                    <img src="img/ss2.PNG">
                                </div>
                                <p class="p9">Тренажерный зал</p><br>
                            </div>
                        </div>
                        <div class="item9">
                            <div class="item99">
                                <div class="item_img9">
                                    <img src="img/ss3.PNG">
                                </div>
                                <p class="p9">Персональные тренировки</p><br>
                            </div>
                        </div>
                        <div class="item9">
                            <div class="item99">
                                <div class="item_img9">
                                    <img src="img/ss4.PNG">
                                </div>
                                <p class="p9">Групповые программы</p><br>
                            </div>
                        </div>
                        <div class="item9">
                            <div class="item99">
                                <div class="item_img9">
                                    <img src="img/ss5.PNG">
                                </div>
                                <p class="p9">Фитнес</p><br>
                            </div>
                        </div>
                        <div class="item9">
                            <div class="item99">
                                <div class="item_img9">
                                    <img src="img/ss6.PNG">
                                </div>
                                <p class="p9">Йога</p><br>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="main6">
                <form class="form" method="POST">
					<input class="textbox input-or" style="width:100%;" name="name" placeholder="Имя" > <? echo $prover;?><br>
                    <input class="textbox input-or tel" style="width:100%;" name="phone" placeholder="Номер телефона" > <? echo $prover2;?><br>
					<select class="select input-or" style="width:100%;" name="direction"> 
                                    <option value="Бассейн">Бассейн</option>
                                    <option value='Тренажерный зал'>Тренажерный зал</option>
                                    <option value='Персональные тренировки'>Персональные тренировки</option>
                                    <option value='Групповые программы '>Групповые программы</option>
                                    <option value='Фитнес'>Фитнес</option>
                                    <option value='Йога'>Йога</option>
                                </select><br>
					<button id="submit-at" style="width:100%;" class="form-at-btn2" value="Вход">Получить предложение</button>
						<?
							if ($i==3) {
                                echo '<p style="color:green; font-family: "Open Sans", sans-serif;">Сообщение отправлено</p>';
                            }
						?>
				</form>

                </div>
                <div class="format">
                    <div class="format1">
                        <div>
                            <h1>Клубные карты</h1>
                        </div>
                    </div>
                    <div class="main2">
                        <div class="grid-container3">
                            <?php
                            //вывод карт
                                $result=mysqli_query($link, "SELECT * FROM card") or die(mysqli_error($link));
                                    while($row = mysqli_fetch_array($result)){
                                    $name=$row['name'];
                                    $description=$row['description'];
                                    $price=$row['price'];
                                    $times=$row['times'];
                                    $img=$row['img'];


                                    echo "<div class='item3'>
                                    <div class='item_img3'><img src='$img'></div>
                                        <div class='text'>
                                            <h3>$name</h3>
                                            <p>$description</p>
                                            <p>$times</p>
                                            <h2 style='text-align:center;font-size:20px;'>$price руб.</h2>
                                        </div>
                                    </div>";
                                    }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="main8">
                    <div class="text">
                        <p class="p9">Приобретая карту, вы становитесь членом фитнес-клуба OrangeFitness с неограниченными привилегиями.</p><br>
                        <p class="p9">Для вас доступен весь спектр услуг клуба и насыщенная спортивная и светская жизнь. Эффективные тренировки, наш многолетний спортивный опыт и уверенная поддержка помогут вам достичь впечатляющих результатов.</p><br>
                        <p class="p9">Примите решение действовать — а мы предложим всё, что для этого необходимо!</p>
                        <div class="rub1">
                            <input style="cursor: pointer;" class="bt4" type='submit' value='Хочу стать членом клуба!'>
                        </div>
                    </div>
                </div>
                <div class="main3">      
                    <div class="h22">
                        <h2>Галерея клуба</h2>
                    </div>         
                    <div id="slider" class="slider">
                        <ol class="slider_indicators">
                        <li class="slider_indicator slider_indicator_active" data-slide-to="0"></li>
                        <li class="slider_indicator" data-slide-to="1"></li>
                        <li class="slider_indicator" data-slide-to="2"></li>
                        <li class="slider_indicator" data-slide-to="3"></li>
                        </ol>
                        <div class="slider_items">
                            <div class="slider_item slider_item_1 slider_item_active">
                                <img src="img/1.jpg" alt="slide1">
                            </div>
                            <div class="slider_item slider_item_2">
                                <img src="img/2.jpg" alt="slide2">
                            </div>
                            <div class="slider_item slider_item_3">
                                <img src="img/3.jpg" alt="slide3">
                            </div>
                            <div class="slider_item slider_item_4">
                                <img src="img/4.jpg" alt="slide4"></div>
                            </div>
                        <a class="slider_control slider_control_prev" href="#" role="button"></a>
                        <a class="slider_control slider_control_next" href="#" role="button"></a>
                    </div>
                </div> 
            </div>
        </main>
<?php require_once('footer.php'); ?>
<script> // маска для номера телефона
      window.addEventListener("DOMContentLoaded", function() {
                [].forEach.call( document.querySelectorAll('.tel'), function(input) {
                var keyCode;
                function mask(event) {
                    event.keyCode && (keyCode = event.keyCode);
                    var pos = this.selectionStart;
                    if (pos < 3) event.preventDefault();
                    var matrix = "+7 (___) ___ ____",
                        i = 0,
                        def = matrix.replace(/\D/g, ""),
                        val = this.value.replace(/\D/g, ""),
                        new_value = matrix.replace(/[_\d]/g, function(a) {
                            return i < val.length ? val.charAt(i++) || def.charAt(i) : a
                        });
                    i = new_value.indexOf("_");
                    if (i != -1) {
                        i < 5 && (i = 3);
                        new_value = new_value.slice(0, i)
                    }
                    var reg = matrix.substr(0, this.value.length).replace(/_+/g,
                        function(a) {
                            return "\\d{1," + a.length + "}"
                        }).replace(/[+()]/g, "\\$&");
                    reg = new RegExp("^" + reg + "$");
                    if (!reg.test(this.value) || this.value.length < 5 || keyCode > 47 && keyCode < 58) this.value = new_value;
                    if (event.type == "blur" && this.value.length < 5)  this.value = ""
                }

                input.addEventListener("input", mask, false);
                input.addEventListener("focus", mask, false);
                input.addEventListener("blur", mask, false);
                input.addEventListener("keydown", mask, false)

              });

            });
                        </script>