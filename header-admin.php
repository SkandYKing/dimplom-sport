<?php if($_SESSION['role']!='Администратор') {header('Location: index.php');} ?><!--проверка по ролям-->
<div class="hamburger-menu">
        <label class="menu__btn" for="menu__toggle">
        <span></span>
        </label>
        <ul class="menu__box">
        <li><a class="menu__item" href="admin-report.php">Отчет</a></li>
        <li><a class="menu__item" href="admin-adduser.php">Добавить пользователя</a></li>
        <li><a class="menu__item" href="admin-users.php">Пользователи</a></li>
        <li><a class="menu__item" href="admin-calls.php">Звонки</a></li>
        <li><a class="menu__item" href="admin-treners.php">Тренировки</a></li>
        <li><a class="menu__item" href="admin-trenersearch.php">Поиск тренировок</a></li>
        <li><a class="menu__item" href="admin-management.php">Заказы</a></li>
        <li><a class="menu__item" href="admin-search.php">Поиск заказов</a></li>
        <li><a class="menu__item" href="admin-completed.php">Завершенные заказы</a></li>
        <li><a class="menu__item" href="admin-addmenu.php">Добавить товар</a></li>
        <li><a class="menu__item" href="admin-card.php">Клубные карты</a></li>
        <li><a class="menu__item" href="admin-addclubcard.php">Добавить карту</a></li>
        <li><a class="menu__item" href="admin-reviews.php">Отзывы</a></li>
        <li><a class="menu__item" href="admin-task.php">Список задач</a></li>
        </ul>
     </div>