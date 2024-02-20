-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Июн 15 2022 г., 02:30
-- Версия сервера: 10.3.22-MariaDB
-- Версия PHP: 7.3.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `inferno`
--

-- --------------------------------------------------------

--
-- Структура таблицы `calls`
--

CREATE TABLE `calls` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `direction` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `calls`
--

INSERT INTO `calls` (`id`, `name`, `phone`, `direction`, `status`) VALUES
(16, 'Дима', '+7 (905) 366 5789', 'Йога', 'Завершен'),
(17, 'Алексей', '+7 (987) 678 1212', 'Фитнес', 'Завершен'),
(18, 'Ильдар', '+7 (905) 155 4333', 'Тренажерный зал', 'Новый'),
(19, 'Эдик', '+7 (905) 990 8890', 'Персональные тренировки', 'Новый'),
(20, 'Артем', '+7 (905) 311 1545', 'Групповые программы ', 'Завершен'),
(21, 'Рустам', '+7 (905) 906 6656', 'Фитнес', 'Новый'),
(22, 'Тимур', '+7 (900) 234 5597', 'Йога', 'Новый'),
(23, 'Булат', '+7 (900) 454 2665', 'Персональные тренировки', 'Новый'),
(24, 'Владимир', '+7 (904) 522 2345', 'Бассейн', 'Новый'),
(25, 'Лиза', '+7 (901) 433 3444', 'Фитнес', 'Завершен');

-- --------------------------------------------------------

--
-- Структура таблицы `card`
--

CREATE TABLE `card` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int(11) NOT NULL,
  `times` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `img` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `card`
--

INSERT INTO `card` (`id`, `name`, `description`, `category`, `price`, `times`, `img`) VALUES
(1, 'БЕЗЛИМИТ', 'посещение клуба без ограничений  шкаф на время тренировок', 'Vip', 1400, '30 дней', 'cardimg/card-vip.png'),
(2, 'ДНЕВНАЯ', 'до 17:00  шкаф на время тренировок', 'Day', 650, '30 дней', 'cardimg/card-day.png'),
(3, 'ВЕЧЕРНЯЯ', 'после 17:00  шкаф на время тренировок', 'Night', 950, '30 дней', 'cardimg/card-night.png');

-- --------------------------------------------------------

--
-- Структура таблицы `ips`
--

CREATE TABLE `ips` (
  `ip_id` int(12) NOT NULL,
  `ip_address` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `ips`
--

INSERT INTO `ips` (`ip_id`, `ip_address`) VALUES
(136, '127.0.0.1');

-- --------------------------------------------------------

--
-- Структура таблицы `menu`
--

CREATE TABLE `menu` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int(255) NOT NULL,
  `img` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `menu`
--

INSERT INTO `menu` (`id`, `name`, `description`, `category`, `price`, `img`) VALUES
(2, 'ЛЕНТОЧНЫЙ АМОРТИЗАТОР', 'DITTMANN RUBBERBAND/MINIBAND XL', 'Инвентарь', 530, 'menuimg/222.jpg'),
(3, 'КАПСУЛЫ OMEGA 3', 'PLATINUM FISH OIL 90 CAPS', 'Здоровье', 1100, 'menuimg/111.jpg'),
(6, 'Витамины', 'SKIN, HAIR & NAILS BEAUTY 90 CAPS', 'Здоровье', 1100, 'menuimg/112.jpg'),
(7, 'ТЕРМОМЕТР', 'OMRON ECO TEMP BASIC', 'Здоровье', 1258, 'menuimg/113.jpg'),
(8, 'НАГРУДНЫЙ РЕМЕШОК', 'MYZONE ДЛЯ ДАТЧИКА MZ-3', 'Аксессуары', 3100, 'menuimg/114.jpg'),
(9, 'ПОРТАТИВНЫЙ ЕМS-МАССАЖЕР', 'ЕМS-МАССАЖЕР ДЛЯ НОГ', 'Аксессуары', 11000, 'menuimg/115.jpg'),
(10, 'ДАТЧИК C НАГРУДНЫМ РЕМЕШКОМ', 'MYZONE MZ-3 C НАГРУДНЫМ РЕМЕШКОМ', 'Аксессуары', 15500, 'menuimg/116.jpg'),
(11, 'ПЕРКУССИОННЫЙ МАССАЖЕР ДЛЯ ТЕЛА YAMAGUCHI', 'ПЕРКУССИОННЫЙ МАССАЖЕР ДЛЯ ТЕЛА YAMAGUCHI', 'Аксессуары', 24500, 'menuimg/117.jpg'),
(12, 'ЛЕНТОЧНЫЙ АМОРТИЗАТОР', 'DITTMANN RUBBERBAND/MINIBAND XL BLUEX-HEAVY ЭКСТРА СИЛЬН СОПР.', 'Инвентарь', 580, 'menuimg/118.jpg'),
(13, 'ЛЕНТОЧНЫЙ АМОРТИЗАТОР', 'DITTMANN RUBBERBAND/MINIBAND XL GREEN MEDIUM СРЕДНЕЕ СОПР.', 'Инвентарь', 630, 'menuimg/119.jpg'),
(14, 'АМОРТИЗАТОР ТРУБЧАТЫЙ', 'DITTMANN BODY-TUBE, XT-VLNL (СОПРОТИВЛЕНИЕ - МИНИМАЛЬНОЕ,ЦВЕТ - ЖЕЛТЫЙ)', 'Инвентарь', 2180, 'menuimg/120.jpg'),
(15, 'АМОРТИЗАТОР ТРУБЧАТЫЙ', 'DITTMANN BODY-TUBE, XT-MNL(СОПРОТИВЛЕНИЕ - СРЕДНЕЕ, ЦВЕТ -КРАСНЫЙ)', 'Инвентарь', 2070, 'menuimg/121.jpg'),
(16, 'ЗАМКИ ПРУЖИННЫЕ', 'FOREMAN С-1 (ДЛЯ BODY PUMP)', 'Инвентарь', 2700, 'menuimg/122.jpg'),
(17, 'КАПСУЛЫ OMEGA 3', 'PLATINUM FISH OIL 90 CAPS', 'Здоровье', 1100, 'menuimg/111.jpg'),
(18, 'Витамины', 'SKIN, HAIR & NAILS BEAUTY 90 CAPS', 'Здоровье', 1100, 'menuimg/112.jpg'),
(19, 'ТЕРМОМЕТР', 'OMRON ECO TEMP BASIC', 'Здоровье', 1258, 'menuimg/113.jpg'),
(20, 'НАГРУДНЫЙ РЕМЕШОК', 'MYZONE ДЛЯ ДАТЧИКА MZ-3', 'Аксессуары', 3100, 'menuimg/114.jpg'),
(21, 'ПОРТАТИВНЫЙ ЕМS-МАССАЖЕР', 'ЕМS-МАССАЖЕР ДЛЯ НОГ', 'Аксессуары', 11000, 'menuimg/115.jpg'),
(22, 'ДАТЧИК C НАГРУДНЫМ РЕМЕШКОМ', 'MYZONE MZ-3 C НАГРУДНЫМ РЕМЕШКОМ', 'Аксессуары', 15500, 'menuimg/116.jpg');

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `menu_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` int(255) NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `orders`
--

INSERT INTO `orders` (`id`, `email`, `menu_id`, `quantity`, `status`) VALUES
(11, 'rustam@mail.ru', '9', 1, 'В пути'),
(20, 'dima@mail.ru', '8', 1, 'Завершён'),
(21, 'edik@mail.ru', '3', 2, 'Завершён'),
(26, 'artem@mail.ru', '2', 1, 'Новый');

-- --------------------------------------------------------

--
-- Структура таблицы `orders2`
--

CREATE TABLE `orders2` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `comment` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `street` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `time` datetime NOT NULL,
  `time2` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `orders2`
--

INSERT INTO `orders2` (`id`, `name`, `email`, `phone`, `comment`, `price`, `payment`, `city`, `street`, `status`, `date`, `time`, `time2`) VALUES
(6, 'artem', 'artem@mail.ru', '+7 (905) 321 5465', 'Позвонить перед доставкой за пол часа', '3300', 'Наличными', 'Альметьевск', 'Зарипова 5', 'Завершён', '2022-06-16', '2022-05-13 00:32:44', '10:37:00'),
(7, 'artem', 'artem@mail.ru', '+7 (905) 321 5465', 'Позвонить перед доставкой за пол часа', '1060', 'Наличными', 'Альметьевск', 'Шевченко 65', 'Завершён', '2022-06-16', '2022-05-13 01:13:00', '12:17:00'),
(8, 'artem', 'artem@mail.ru', '+7 (905) 321 5465', 'Позвонить перед доставкой за пол часа', '530', 'Наличными', 'Альметьевск', 'Зарипова 5', 'Завершён', '2022-06-16', '2022-05-13 02:38:49', '12:42:00'),
(9, 'artem', 'artem@mail.ru', '+7 (905) 321 5465', 'Позвонить перед доставкой за пол часаПозвонить перед доставкой за пол час', '3300', 'Наличными', 'Альметьевск', 'Зарипова 5', 'Завершён', '2022-06-16', '2022-05-13 00:32:44', '10:37:00'),
(22, 'Рустам', 'rustam@mail.ru', '+7 (905) 334 4433', 'Позвонить перед доставкой за пол часа', '15500', 'Перевод СПБ', 'Альметьевск', 'Ленина 165', 'Завершён', '2022-06-16', '2022-06-13 03:17:54', '10:30:00'),
(23, 'Рустам', 'rustam@mail.ru', '+7 (905) 334 4433', 'Позвонить заранее', '49000', 'Перевод СПБ', 'Альметьевск', 'Ленина 165', 'В пути', '2022-06-16', '2022-06-13 03:22:58', '12:30:00'),
(25, 'Дмитрий', 'dima@mail.ru', '+7 (905) 366 5789', 'В ожидании', '3100', 'Перевод СПБ', 'Альметьевск', 'Заслонова 8', 'Завершён', '2022-06-16', '2022-06-13 03:25:03', '20:00:00'),
(26, 'Эдик', 'edik@mail.ru', '+7 (987) 333 2323', 'Жду', '2200', 'Перевод СПБ', 'Альметьевск', 'Бигаш 123', 'Завершён', '2022-06-16', '2022-06-13 03:27:28', '18:30:00'),
(29, 'Артем', 'artem@mail.ru', '+7 (987) 545 3255', '123', '530', 'Перевод СПБ', 'Альметьевск', 'Ленина 165', 'Новый', '2022-06-16', '2022-06-15 01:57:44', '15:00:00'),
(30, 'Тимур', 'timur@mail.ru', '+7 (905) 366 5780', 'Ожидаю!', '1100', 'Наличными', 'Альметьевск', 'Ленина 165', 'Завершён', '2022-06-16', '2022-06-15 02:04:21', '11:15:00');

-- --------------------------------------------------------

--
-- Структура таблицы `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `comment` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `reviews`
--

INSERT INTO `reviews` (`id`, `name`, `phone`, `comment`) VALUES
(9, 'Рустам', '+7 (905) 334 4433', 'Доставку бы побыстрее'),
(10, 'Артем', '+7 (905) 321 5465', 'Хорошая была тренировка'),
(11, 'Булат', '+7 (987) 345 6545', 'Все было отлично'),
(12, 'Тимур', '+7 (905) 366 5789', 'Рекомендую!'),
(13, 'Алексей', '+7 (905) 456 3434', 'Товар супер!'),
(14, 'Эдик', '+7 (987) 333 2323', 'Тренировка прошла на ура!'),
(15, 'Дмитрий', '+7 (905) 366 5789', 'Класс!');

-- --------------------------------------------------------

--
-- Структура таблицы `task`
--

CREATE TABLE `task` (
  `id` int(11) NOT NULL,
  `task` varchar(200) DEFAULT NULL,
  `status` varchar(45) DEFAULT 'Ожидает',
  `ts` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `task`
--

INSERT INTO `task` (`id`, `task`, `status`, `ts`) VALUES
(1, 'Добавить новые товары в меню', 'Завершен', '2021-04-20 07:57:04'),
(2, 'Увеличить количество заказов', 'Завершен', '2021-04-20 07:57:04'),
(9, 'Пригласить новых тренеров', 'Ожидает', '2022-05-13 20:39:29');

-- --------------------------------------------------------

--
-- Структура таблицы `usercard`
--

CREATE TABLE `usercard` (
  `id` int(11) NOT NULL,
  `user_email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `time` date NOT NULL,
  `price` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `usercard`
--

INSERT INTO `usercard` (`id`, `user_email`, `category`, `time`, `price`, `name`) VALUES
(43, 'artem@mail.ru', 'Vip', '2022-05-19', '1400', 'БЕЗЛИМИТ'),
(45, 'rustam@mail.ru', 'Vip', '2022-05-19', '1400', 'БЕЗЛИМИТ'),
(46, 'alex@mail.ru', 'Day', '2022-06-13', '650', 'ДНЕВНАЯ'),
(49, 'timur@mail.ru', 'Day', '2022-06-13', '650', 'ДНЕВНАЯ');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `profile` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stage` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `img` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `card` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `profile`, `stage`, `email`, `password`, `phone`, `img`, `role`, `card`) VALUES
(5, 'Администратор', 'Администратор', '', 'admin@mail.ru', '0192023a7bbd73250516f069df18b500', '+7 (905) 321 1234', 'userimg/team12.jpg', 'Администратор', 1),
(6, 'Артем', 'Пользователь', '', 'artem@mail.ru', 'f623a9523035f87b62f41deac9f264fd', '+7 (987) 545 3255', 'userimg/Mb70TrJYOGiQMYUu1DYN7xtbuwXLbidW-amv6c-TzfpFTiVE5BCTwEy2b34Xp0XBCaUUd5ibkXYkZV8BIIm9rO7l.jpg', 'Пользователь', 1),
(7, 'Владимир', 'Плаванье', '6 лет', 'trener@mail.ru', '6a2834952fa66880a50d8f2fe64f028d', '+7 (987) 545 3255', 'userimg/team11.jpg', 'Тренер', 1),
(23, 'Булат', 'Пользователь', '', 'bulat@mail.ru', '6b6fff8167e95092952678663ce85e62', '+7 (987) 345 6545', 'userimg/3sVmSx28HtvGBrwKfHQxAHDHKeAsXoh3CuLvS9YsT8ml8DoN37CBJMrj7-4u8X6VYWuyw5sU.jpg', 'Пользователь', 0),
(24, 'Эдик', 'Пользователь', '', 'edik@mail.ru', '234bb891fc6dcb8db48b3435ca26713b', '+7 (987) 333 2323', 'userimg/aBrY9TT1BG-Lqq6ZIgF4IvCjkw8chnlGT9cLrNxrdraTG4NKc1hD9ExsCwjcKVuqR1N-0XcT.jpg', 'Пользователь', 1),
(25, 'Алексей', 'Пользователь', '', 'alex@mail.ru', 'b75bd008d5fecb1f50cf026532e8ae67', '+7 (905) 456 3434', 'userimg/utsUsyOa5GQtdZuK7TRlZQH5ZcNbiT_FXmjDwk9i26PafC3duOJ0hqemHmqGUnYBlhmyr4w3PTfz9XwKmd0o5mbM.jpg', 'Пользователь', 1),
(26, 'Рустам', 'Пользователь', '', 'rustam@mail.ru', '5db9ea32ba514ca8f047bbf5b0c4d307', '+7 (905) 334 4433', 'userimg/OejAJOFXc-ju_7o7Y03mqHEVZnlsLeQVTlPL6rvQ1FPnfy6yHI2MYg73exh5T3Q2t3KRXadU.jpg', 'Пользователь', 1),
(27, 'Тимур', 'Пользователь', '', 'timur@mail.ru', '57996860cd15e65b2017c30e6661f5dc', '+7 (905) 366 5780', 'userimg/mnsaRqADYN854BU0DAneQOkRUe2KwZHF9z3hNr6vK2vXmNATWnkc5M-NMNiLrm34Fj3MMIqOcoTGiWER3BWS6CS5.jpg', 'Пользователь', 1),
(28, 'Дмитрий', 'Пользователь', '', 'dima@mail.ru', '70c9dc2d09299d9d21583266acc7681c', '+7 (905) 366 5789', 'userimg/6wuIcdnbDY96aD5KBoum2dh_KCMFeML630yJrFJykOyH1qTMchIWqZ5JLSupaw6eLR_renUTrBvqoR9j_3bcjfvV.jpg', 'Пользователь', 0),
(29, 'Ильдар', 'Йога', '3 года', 'ildar@mail.ru', 'ccc211074ebfd1386e0abc512330c461', '+7 (905) 678 4545', 'userimg/team1.jpg', 'Тренер', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `userwork`
--

CREATE TABLE `userwork` (
  `id` int(11) NOT NULL,
  `zagolovok` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `text` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `trener_email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `trener_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `userwork`
--

INSERT INTO `userwork` (`id`, `zagolovok`, `text`, `status`, `trener_email`, `trener_name`, `user_email`, `user_name`) VALUES
(26, 'Задание на дом', 'Задержка дыхания 10 раз промежуток 30 сек', 'Отправлен', 'trener@mail.ru', 'Владимир', 'artem@mail.ru', 'Артем'),
(27, 'Задание на дом', 'Задержка дыхания 10 раз промежуток 45 сек', 'Прочитано', 'trener@mail.ru', 'Владимир', 'artem@mail.ru', 'Артем'),
(32, 'Задание на дом', 'Задержка дыхания 10 раз промежуток 30 сек', 'Прочитано', 'trener@mail.ru', 'Владимир', 'rustam@mail.ru', 'Рустам'),
(33, 'Задание на дом', 'Задержка дыхания 10 раз промежуток 45 сек', 'Прочитано', 'trener@mail.ru', 'Владимир', 'rustam@mail.ru', 'Рустам'),
(35, 'Задание на дом', 'Поднимание ног лежа', 'Прочитано', 'trener@mail.ru', 'Владимир', 'bulat@mail.ru', 'Булат'),
(36, 'Задание на дом', 'Тренировка шпагата', 'Прочитано', 'trener@mail.ru', 'Владимир', 'dima@mail.ru', 'Дмитрий'),
(42, 'Задание', 'Задержка дыхания', 'Прочитано', 'trener@mail.ru', 'Владимир', 'timur@mail.ru', 'Тимур');

-- --------------------------------------------------------

--
-- Структура таблицы `visits`
--

CREATE TABLE `visits` (
  `visit_id` int(12) NOT NULL,
  `date` date NOT NULL,
  `hosts` int(12) NOT NULL,
  `views` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `visits`
--

INSERT INTO `visits` (`visit_id`, `date`, `hosts`, `views`) VALUES
(33, '2022-05-13', 1, 5),
(34, '2022-05-14', 1, 16),
(35, '2022-05-17', 1, 8),
(36, '2022-05-18', 1, 12),
(37, '2022-05-19', 1, 4),
(38, '2022-05-20', 1, 9),
(39, '2022-05-21', 1, 6),
(40, '2022-05-23', 1, 24),
(41, '2022-05-24', 1, 11),
(42, '2022-05-25', 1, 3),
(43, '2022-05-26', 1, 22),
(44, '2022-05-27', 1, 14),
(45, '2022-05-30', 1, 2),
(46, '2022-06-06', 1, 6),
(47, '2022-06-08', 1, 1),
(48, '2022-06-09', 1, 47),
(49, '2022-06-10', 1, 8),
(50, '2022-06-12', 3, 63),
(52, '2022-06-13', 2, 72),
(53, '2022-06-14', 1, 82),
(54, '2022-06-15', 1, 42);

-- --------------------------------------------------------

--
-- Структура таблицы `zapisi`
--

CREATE TABLE `zapisi` (
  `id` int(11) NOT NULL,
  `name` varchar(56) NOT NULL,
  `profile` varchar(256) NOT NULL,
  `stage` varchar(256) NOT NULL,
  `phone` varchar(256) NOT NULL,
  `status` varchar(256) NOT NULL,
  `date` date NOT NULL,
  `time` varchar(255) NOT NULL,
  `time2` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `img` varchar(255) NOT NULL,
  `trener_email` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `zapisi`
--

INSERT INTO `zapisi` (`id`, `name`, `profile`, `stage`, `phone`, `status`, `date`, `time`, `time2`, `price`, `img`, `trener_email`, `user_email`, `user_name`) VALUES
(75, 'Владимир', 'Плаванье', '6 лет', '+7 (987) 545 3255', 'Завершен', '2022-06-15', '12', '14', 1000, 'zapisiimg/team11.jpg', 'trener@mail.ru', 'artem@mail.ru', 'Артем'),
(81, 'Владимир', 'Плаванье', '6 лет', '+7 (987) 545 3255', 'Завершен', '2022-06-15', '14', '18', 950, 'zapisiimg/team11.jpg', 'trener@mail.ru', 'rustam@mail.ru', 'Рустам'),
(82, 'Владимир', 'Плаванье', '6 лет', '+7 (987) 545 3255', 'Завершен', '2022-06-15', '12', '15', 750, 'zapisiimg/team11.jpg', 'trener@mail.ru', 'artem@mail.ru', 'Артем'),
(83, 'Ильдар', 'Йога', '3 года', '+7 (905) 678 4545', 'Завершен', '2022-06-15', '14', '18', 1300, 'zapisiimg/team1.jpg', 'ildar@mail.ru', 'artem@mail.ru', 'Артем'),
(96, 'Ильдар', 'Йога', '3 года', '+7 (905) 678 4545', 'Завершен', '2022-06-15', '12', '14', 1000, 'zapisiimg/team1.jpg', 'ildar@mail.ru', 'artem@mail.ru', 'Артем'),
(97, 'Владимир', 'Плаванье', '6 лет', '+7 (987) 545 3255', 'Занят', '2022-06-15', '12', '14', 1000, 'zapisiimg/team11.jpg', 'trener@mail.ru', 'rustam@mail.ru', 'Рустам'),
(99, 'Ильдар', 'Йога', '3 года', '+7 (905) 678 4545', 'Завершен', '2022-06-15', '14', '18', 1300, 'zapisiimg/team1.jpg', 'ildar@mail.ru', 'bulat@mail.ru', 'Булат'),
(100, 'Ильдар', 'Йога', '3 года', '+7 (905) 678 4545', 'Завершен', '2022-06-15', '12', '14', 1000, 'zapisiimg/team1.jpg', 'ildar@mail.ru', 'dima@mail.ru', 'Дмитрий'),
(103, 'Ильдар', 'Йога', '3 года', '+7 (905) 678 4545', 'Завершен', '2022-06-15', '20', '22', 1100, 'zapisiimg/team1.jpg', 'ildar@mail.ru', 'timur@mail.ru', 'Тимур'),
(104, 'Владимир', 'Плаванье', '6 лет', '+7 (987) 545 3255', 'Свободен', '2022-06-15', '18', '20', 1300, 'zapisiimg/team11.jpg', 'trener@mail.ru', '', ''),
(105, 'Ильдар', 'Йога', '3 года', '+7 (905) 678 4545', 'Свободен', '2022-06-15', '10', '12', 1000, 'zapisiimg/team1.jpg', 'ildar@mail.ru', '', ''),
(106, 'Владимир', 'Плаванье', '6 лет', '+7 (987) 545 3255', 'Свободен', '2022-06-15', '16', '18', 950, 'zapisiimg/team11.jpg', 'trener@mail.ru', '', ''),
(107, 'Ильдар', 'Йога', '3 года', '+7 (905) 678 4545', 'Занят', '2022-06-15', '14', '16', 1000, 'zapisiimg/team1.jpg', 'ildar@mail.ru', 'artem@mail.ru', 'Артем'),
(115, 'Владимир', 'Плаванье', '6 лет', '+7 (987) 545 3255', 'Свободен', '2022-06-15', '13', '15', 950, 'zapisiimg/team11.jpg', 'trener@mail.ru', '', ''),
(116, 'Ильдар', 'Йога', '3 года', '+7 (905) 678 4545', 'Свободен', '2022-06-15', '10', '12', 750, 'zapisiimg/team1.jpg', 'ildar@mail.ru', '', ''),
(118, 'Владимир', 'Плаванье', '6 лет', '+7 (987) 545 3255', 'Свободен', '2022-06-15', '19', '20', 750, 'zapisiimg/team11.jpg', 'trener@mail.ru', '', ''),
(119, 'Ильдар', 'Йога', '3 года', '+7 (905) 678 4545', 'Свободен', '2022-06-15', '11', '12', 950, 'zapisiimg/team1.jpg', 'ildar@mail.ru', '', '');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `calls`
--
ALTER TABLE `calls`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `card`
--
ALTER TABLE `card`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `ips`
--
ALTER TABLE `ips`
  ADD PRIMARY KEY (`ip_id`);

--
-- Индексы таблицы `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `orders2`
--
ALTER TABLE `orders2`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `task`
--
ALTER TABLE `task`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `usercard`
--
ALTER TABLE `usercard`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `userwork`
--
ALTER TABLE `userwork`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `visits`
--
ALTER TABLE `visits`
  ADD PRIMARY KEY (`visit_id`);

--
-- Индексы таблицы `zapisi`
--
ALTER TABLE `zapisi`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `calls`
--
ALTER TABLE `calls`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT для таблицы `card`
--
ALTER TABLE `card`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `ips`
--
ALTER TABLE `ips`
  MODIFY `ip_id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=137;

--
-- AUTO_INCREMENT для таблицы `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT для таблицы `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT для таблицы `orders2`
--
ALTER TABLE `orders2`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT для таблицы `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT для таблицы `task`
--
ALTER TABLE `task`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT для таблицы `usercard`
--
ALTER TABLE `usercard`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT для таблицы `userwork`
--
ALTER TABLE `userwork`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT для таблицы `visits`
--
ALTER TABLE `visits`
  MODIFY `visit_id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT для таблицы `zapisi`
--
ALTER TABLE `zapisi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=120;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
