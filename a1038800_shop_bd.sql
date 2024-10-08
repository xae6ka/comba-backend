-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Окт 06 2024 г., 08:51
-- Версия сервера: 8.0.30
-- Версия PHP: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `a1038800_shop_bd`
--

-- --------------------------------------------------------

--
-- Структура таблицы `busket`
--

CREATE TABLE `busket` (
  `id` int NOT NULL,
  `userId` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `busket`
--

INSERT INTO `busket` (`id`, `userId`) VALUES
(1, 1),
(2, 2),
(18, 18),
(39, 39),
(55, 55),
(56, 56);

-- --------------------------------------------------------

--
-- Структура таблицы `busketToCloth`
--

CREATE TABLE `busketToCloth` (
  `id` int NOT NULL,
  `busketId` int NOT NULL,
  `clothId` int NOT NULL,
  `count` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `busketToCloth`
--

INSERT INTO `busketToCloth` (`id`, `busketId`, `clothId`, `count`) VALUES
(48, 1, 1, 1),
(49, 1, 2, 1),
(58, 55, 1, 1),
(59, 55, 2, 1),
(68, 56, 1, 1),
(71, 56, 9, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `cloth`
--

CREATE TABLE `cloth` (
  `id` int NOT NULL,
  `header` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cost` int NOT NULL,
  `imgSrc` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'static/default.jpg',
  `promo` varchar(256) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `promoTitle` varchar(256) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `cloth`
--

INSERT INTO `cloth` (`id`, `header`, `cost`, `imgSrc`, `promo`, `promoTitle`) VALUES
(1, 'Nike Pro Ultra 12V', 199, 'static/default.jpg', NULL, NULL),
(2, 'AIR FLIGHT LITE MID LTR', 299, 'static/default.jpg', NULL, NULL),
(3, 'NIKE TECH HERA', 99, 'static/default.jpg', NULL, NULL),
(8, '[Nike Defy All Day', 499, 'static/default.jpg', NULL, NULL),
(9, 'Nike Pro Ultra 12V', 199, '', '1', 'Promo 2 pairs');

-- --------------------------------------------------------

--
-- Структура таблицы `favorite`
--

CREATE TABLE `favorite` (
  `id` int NOT NULL,
  `userId` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `favorite`
--

INSERT INTO `favorite` (`id`, `userId`) VALUES
(1, 1),
(2, 2);

-- --------------------------------------------------------

--
-- Структура таблицы `favoriteToCloth`
--

CREATE TABLE `favoriteToCloth` (
  `id` int NOT NULL,
  `favoriteId` int NOT NULL,
  `clothId` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `favoriteToCloth`
--

INSERT INTO `favoriteToCloth` (`id`, `favoriteId`, `clothId`) VALUES
(1, 1, 3),
(2, 1, 1),
(3, 2, 3),
(4, 2, 2);

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

CREATE TABLE `orders` (
  `id` int NOT NULL,
  `userId` int NOT NULL,
  `adress` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payOffline` tinyint(1) NOT NULL,
  `completed` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `orders`
--

INSERT INTO `orders` (`id`, `userId`, `adress`, `payOffline`, `completed`) VALUES
(1, 1, 'Ул. Пушкина, дом Колотушкина', 0, 0),
(2, 1, 'Ул. Пушкина, дом Колотушкина', 1, 0),
(3, 2, 'Ул. Колотушкина, дом Пушкина', 0, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `ordersToCloth`
--

CREATE TABLE `ordersToCloth` (
  `id` int NOT NULL,
  `orderId` int NOT NULL,
  `clothId` int NOT NULL,
  `count` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `ordersToCloth`
--

INSERT INTO `ordersToCloth` (`id`, `orderId`, `clothId`, `count`) VALUES
(1, 1, 1, 4),
(2, 1, 2, 2),
(3, 2, 3, 1),
(4, 3, 1, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `login` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pass` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `login`, `pass`, `email`) VALUES
(1, 'Vasya446', '12345678', 'Vasya446@mail.ru'),
(2, 'Ivan2899', '12345678', 'Ivan2899@mail.ru'),
(18, 'newUser', 'qwerty123', 'newuser@mail.ru'),
(56, 'xae6kaa', 'IProger01', 'xae6kacode@gmail.com'),
(57, 'newUser', 'qwerty123', 'xae6kacode@gmail.com');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `busket`
--
ALTER TABLE `busket`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `busketToCloth`
--
ALTER TABLE `busketToCloth`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `cloth`
--
ALTER TABLE `cloth`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `favorite`
--
ALTER TABLE `favorite`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `favoriteToCloth`
--
ALTER TABLE `favoriteToCloth`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `ordersToCloth`
--
ALTER TABLE `ordersToCloth`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `busket`
--
ALTER TABLE `busket`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT для таблицы `busketToCloth`
--
ALTER TABLE `busketToCloth`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT для таблицы `cloth`
--
ALTER TABLE `cloth`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT для таблицы `favorite`
--
ALTER TABLE `favorite`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `favoriteToCloth`
--
ALTER TABLE `favoriteToCloth`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `ordersToCloth`
--
ALTER TABLE `ordersToCloth`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
