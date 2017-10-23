-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Окт 23 2017 г., 20:46
-- Версия сервера: 5.5.57
-- Версия PHP: 7.1.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `marketing`
--

-- --------------------------------------------------------

--
-- Структура таблицы `apteka`
--

CREATE TABLE `apteka` (
  `apteka_id` int(3) NOT NULL,
  `name` varchar(50) NOT NULL,
  `adres` varchar(200) NOT NULL,
  `date_act` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `ip_adres` varchar(15) NOT NULL,
  `db_name` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `catmc`
--

CREATE TABLE `catmc` (
  `id` int(6) NOT NULL,
  `name` varchar(200) NOT NULL,
  `prod_id` int(6) NOT NULL,
  `tax_id` int(3) NOT NULL,
  `morion_id` int(10) DEFAULT NULL,
  `marketing_id` int(3) DEFAULT NULL,
  `reg_nac` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `marketing`
--

CREATE TABLE `marketing` (
  `marketing_id` int(3) NOT NULL,
  `name` varchar(50) NOT NULL,
  `percent` int(2) NOT NULL,
  `sum` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `oborot`
--

CREATE TABLE `oborot` (
  `oborot_id` int(6) NOT NULL,
  `type` int(1) NOT NULL,
  `kol` float NOT NULL,
  `price` float NOT NULL,
  `sum` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `produser`
--

CREATE TABLE `produser` (
  `prod_id` int(6) NOT NULL,
  `name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `tax`
--

CREATE TABLE `tax` (
  `tax_id` int(1) NOT NULL,
  `name` varchar(10) NOT NULL,
  `percent` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `tax`
--

INSERT INTO `tax` (`tax_id`, `name`, `percent`) VALUES
(1, 'НДС 20%', 20),
(2, 'НДС 0%', 0),
(3, 'НДС 7%', 7);

-- --------------------------------------------------------

--
-- Структура таблицы `teksaldo`
--

CREATE TABLE `teksaldo` (
  `id` int(6) NOT NULL,
  `tov_id` int(6) NOT NULL,
  `apteka_id` int(3) NOT NULL,
  `date_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `kol` float NOT NULL,
  `price` float NOT NULL,
  `sum` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE `user` (
  `user_id` int(3) NOT NULL,
  `login` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `apteka`
--
ALTER TABLE `apteka`
  ADD PRIMARY KEY (`apteka_id`),
  ADD UNIQUE KEY `apteka_id` (`apteka_id`),
  ADD UNIQUE KEY `ip_adres` (`ip_adres`);

--
-- Индексы таблицы `catmc`
--
ALTER TABLE `catmc`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `marketing`
--
ALTER TABLE `marketing`
  ADD PRIMARY KEY (`marketing_id`),
  ADD UNIQUE KEY `marketing_id` (`marketing_id`);

--
-- Индексы таблицы `oborot`
--
ALTER TABLE `oborot`
  ADD UNIQUE KEY `oborot_id` (`oborot_id`);

--
-- Индексы таблицы `produser`
--
ALTER TABLE `produser`
  ADD PRIMARY KEY (`prod_id`);

--
-- Индексы таблицы `tax`
--
ALTER TABLE `tax`
  ADD PRIMARY KEY (`tax_id`),
  ADD UNIQUE KEY `tax_id` (`tax_id`);

--
-- Индексы таблицы `teksaldo`
--
ALTER TABLE `teksaldo`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `catmc`
--
ALTER TABLE `catmc`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `teksaldo`
--
ALTER TABLE `teksaldo`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(3) NOT NULL AUTO_INCREMENT;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
