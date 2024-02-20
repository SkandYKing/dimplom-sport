<?php if($_SESSION['role']!='Пользователь') {header('Location: index.php');} ?><!--проверка по ролям-->
<div class="hamburger-menu">
        <label class="menu__btn" for="menu__toggle">
        <span></span>
        </label>
        <ul class="menu__box">
        <li><a class="menu__item" href="user-profile.php">Мой профиль</a></li>
        <li><a class="menu__item" href="user-zapisi.php">Записаться на тренировку</a></li>
        <li><a class="menu__item" href="user-zapisiprosmotr.php">Просмотреть записи</a></li>
        <li><a class="menu__item" href="user-individ.php">Индивидуальные сообщения</a></li>
        <li><a class="menu__item" href="user-order.php">Сделать заказ</a></li>
        <li><a class="menu__item" href="user-history.php">Покупки</a></li>
        <li><a class="menu__item" href="user-reviews.php">Оставить отзыв</a></li>
        </ul>
     </div>