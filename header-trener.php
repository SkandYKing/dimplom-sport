<?php if($_SESSION['role']!='Тренер') {header('Location: index.php');} ?><!--проверка по ролям-->
<div class="hamburger-menu">
        <label class="menu__btn" for="menu__toggle">
        <span></span>
        </label>
        <ul class="menu__box">
        <li><a class="menu__item" href="profile-trener.php">Мой профиль</a></li>
        <li><a class="menu__item" href="training.php">Создать заявку</a></li>
        <li><a class="menu__item" href="trenerzapisi.php">Просмотр записей</a></li>
        <li><a class="menu__item" href="trenerindivid.php">Индивидуальные тренеровки</a></li>
        </ul>
     </div>