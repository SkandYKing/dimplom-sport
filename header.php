<?php session_start();
if(isset($_GET['exit']))
{
    session_destroy();
    header('Location: http://localhost/inferno/index.php');
    exit;
}?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/style.css">
    <link rel="shortcut icon" href="img/logo2.png" type="image/png">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <title>Inferno</title>
    <script>
        jQuery(document).ready(function($){

        'use strict';
        var slider=function(e){
        const ClassName = {INDICATOR_ACTIVE: 'slider_indicator_active',ITEM: 'slider_item',ITEM_LEFT: 'slider_item_left',ITEM_RIGHT: 'slider_item_right',ITEM_PREV: 'slider_item_prev',ITEM_NEXT: 'slider_item_next',ITEM_ACTIVE: 'slider_item_active'}
        var d=!1,u=0,i={},v={},I={},f={selector:"",isCycling:!0,direction:"next",interval:5e3,pause:!0},r=function(s){var n;return v.forEach(function(e,t){e===s&&(n=t)}),n},l=function(e,t,s){var n,a,i=ClassName.ITEM_RIGHT,r=ClassName.ITEM_PREV,l=v[t],c=v[s],o=function(){l.classList.remove(ClassName.ITEM_ACTIVE),l.classList.remove(i),c.classList.remove(r),c.classList.remove(i),c.classList.add(ClassName.ITEM_ACTIVE),window.setTimeout(function(){f.isCycling&&(clearInterval(u),C()),d=!1,l.removeEventListener("transitionend",o)},700)};d||(d=!0,"next"===e&&(i=ClassName.ITEM_LEFT,r=ClassName.ITEM_NEXT),c.classList.add(r),n=t,a=s,I.length===v.length&&(I[n].classList.remove(ClassName.INDICATOR_ACTIVE),I[a].classList.add(ClassName.INDICATOR_ACTIVE)),window.setTimeout(function(){c.classList.add(i),l.classList.add(i),l.addEventListener("transitionend",o)},0))},a=function(e){var t=i.querySelector("."+ClassName.ITEM_ACTIVE),s=r(t),n=v.length-1,a=0===s?n:s-1;"next"===e&&(a=s==n?0:s+1),l(e,s,a)},C=function(){f.isCycling&&(u=window.setInterval(function(){a(f.direction)},f.interval))},t=function(e){var t=i.querySelector("."+ClassName.ITEM_ACTIVE),s=r(t),n=e.target.getAttribute("data-slide-to");if(e.target.hasAttribute("data-slide-to")||e.target.classList.contains("slider_control"))if(e.target.hasAttribute("data-slide-to")){if(s===n)return;l(s<n?"next":"prev",s,n)}else e.preventDefault(),a(e.target.classList.contains("slider_control_next")?"next":"prev")};for(var s in e)s in f&&(f[s]=e[s]);return i="string"==typeof f.selector?document.querySelector(f.selector):f.selector,v=i.querySelectorAll("."+ClassName.ITEM),I=i.querySelectorAll("[data-slide-to]"),C(),i.addEventListener("click",t),f.pause&&f.isCycling&&(i.addEventListener("mouseenter",function(e){clearInterval(u)}),i.addEventListener("mouseleave",function(e){clearInterval(u),C()})),{next:function(){a("next")},prev:function(){a("prev")},stop:function(){clearInterval(u)},cycle:function(){clearInterval(u),C()}}}({
        selector:".slider",
        isCycling:true,
        direction:"next",
        interval:2000,
        pause:false
        });

        });
    </script>
</head>
<body>
    <header class="header"><!--Шапка-->
            <div class="contener3">
                <div class="logo">
                    <a href="index.php"><img src="img/logo2.png"></a>
                </div>
                <menu class="menu">
                    <nav class="nav">
                        <li><a href="index.php">Главная</a></li>
                        <li><a href="about.php">О клубе</a></li>
                        <li><a href="shop.php">Магазин</a></li>
                        <li><a href="contact.php">Контакты</a></li>
                        <!--Авторизация / Регистрация-->
                        <div id="reg1">
                        <?php
                        //вывод если роль пользователь
                            if (($_SESSION['role'])=='Пользователь') {
                            echo '
                        <li><a class="a6" style="text-decoration: underline;" href="user-profile.php">Мой профиль</a></li>
                        ';
                            }
                            //вывод если роль тренер
                            if (($_SESSION['role'])=='Тренер') {
                            echo '
                        <li><a class="a6" style="text-decoration: underline;" href="profile-trener.php">Тренер</a></li>
                        ';
                            }
                            //вывод если роль администратор
                            if (($_SESSION['role'])=='Администратор') {
                            echo '
                        <li><a class="a6" style="text-decoration: underline;" href="admin-report.php">Управление</a></li>
                        ';
                            }
                            //если авторизован кнопка выйти
                            if (!empty($_SESSION['auth'])) {
                                echo '
                                <p class="a7">
                                Вы зашли как <b>'.$_SESSION['name'].'</b></p>
                                <a href="?exit" >Выйти</a>';
                                } else {
                                echo '<p class="a5">г. Казань, пр. Чернышевского, 17 </p> <br> <a class="a6" href="login.php" style="text-decoration: underline;">Личный кабинет</a> <p class="a7" href=""> +7 (854) 353-53-53</p>';
                                }
                        ?>
                        </div>
                        <div id="reg">
                        <?php
                            
                        ?>
                        </div>
                    </nav>
                </menu>
            </div>
    </header>