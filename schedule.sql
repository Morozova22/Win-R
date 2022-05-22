-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Май 22 2022 г., 11:10
-- Версия сервера: 8.0.24
-- Версия PHP: 8.0.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `schedule`
--

-- --------------------------------------------------------

--
-- Структура таблицы `schedule`
--

CREATE TABLE `schedule` (
  `id` bigint NOT NULL,
  `type` int DEFAULT NULL,
  `day` int DEFAULT NULL,
  `pair` int DEFAULT NULL,
  `week_begining` date DEFAULT NULL,
  `groups` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `subgroup_number` varchar(10) DEFAULT NULL,
  `discipline` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `teachers` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `auditories` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `schedule`
--

INSERT INTO `schedule` (`id`, `type`, `day`, `pair`, `week_begining`, `groups`, `subgroup_number`, `discipline`, `teachers`, `auditories`) VALUES
(4369608, 3, 6, 4, '2022-04-11', 'Мумрики', '1', 'Методы улавливания полезной информации', 'Юксаре', 'Зимний сад'),
(4369609, 3, 5, 5, '2022-04-11', 'Муми-тролли', '1', 'Методы улавливания полезной информации', 'Юксаре', 'Обсерватория'),
(4369611, 3, 6, 5, '2022-04-11', 'Снорки', '1', 'Методы улавливания полезной информации', 'Юксаре', 'Обсерватория'),
(4369612, 3, 6, 3, '2022-04-11', 'Муми-тролли', '2', 'Методы улавливания полезной информации', 'Юксаре', 'Грот'),
(4370592, 1, 5, 3, '2022-04-11', 'Снорки', '', 'Основы собирания табуреток', 'Ти-ти-у-у', 'Обсерватория'),
(4370593, 3, 4, 2, '2022-04-11', '', '1', 'Основы собирания табуреток', '', ''),
(4370615, 3, 5, 5, '2022-04-11', 'Муми-тролли', '2', 'Обустраивание личного пространства', 'Муми-мама', 'Обсерватория'),
(4370618, 3, 3, 6, '2022-04-11', 'Мумрики', '1', 'Обустраивание личного пространства', 'Муми-мама', 'Грот'),
(4370620, 3, 5, 6, '2022-04-11', 'Муми-тролли', '1', 'Обустраивание личного пространства', 'Муми-мама', 'Обсерватория'),
(4370622, 2, 3, 4, '2022-04-11', 'Муми-тролли', '', 'Обустраивание личного пространства', 'Муми-мама', 'Грот'),
(4370623, 1, 4, 3, '2022-04-11', 'Муми-тролли,Мумрики', '', 'Обустраивание личного пространства', 'Муми-мама', 'Обсерватория'),
(4373425, 1, 5, 2, '2022-04-11', '', '', 'Способы выпутывания из безвыходных ситуаций', '', ''),
(4373428, 2, 3, 4, '2022-04-11', 'Снорки', '', 'Способы выпутывания из безвыходных ситуаций', 'Туу-тикки', 'Зимний сад'),
(4373494, 3, 4, 6, '2022-04-11', 'Мумрики', '1', 'Уборка территори', 'Тюлиппа', 'У кустов сирени'),
(4373495, 3, 6, 5, '2022-04-11', 'Муми-тролли', '1', 'Уборка территори', 'Тюлиппа', 'Чердак'),
(4373496, 1, 4, 5, '2022-04-11', 'Снорки,Муми-тролли,Мумрики', '', 'Уборка территори', 'Тюлиппа', 'У кустов сирени'),
(4373498, 3, 6, 4, '2022-04-11', 'Снорки', '1', 'Уборка территори', 'Тюлиппа', 'У кустов сирени'),
(4373499, 3, 3, 5, '2022-04-11', 'Муми-тролли', '2', 'Уборка территори', 'Тюлиппа', 'У кустов сирени'),
(4373500, 3, 3, 6, '2022-04-11', 'Муми-тролли', '2', 'Уборка территори', 'Тюлиппа', 'У кустов сирени'),
(4376056, 3, 6, 6, '2022-04-11', 'Муми-тролли', '1', 'Собирание оригами', 'Шуссель', 'Обсерватория'),
(4376057, 3, 4, 3, '2022-04-11', 'Снорки', '1', 'Собирание оригами', 'Шуссель', 'Грот'),
(4376058, 3, 6, 4, '2022-04-11', 'Муми-тролли', '2', 'Собирание оригами', 'Шуссель', 'Грот'),
(4376059, 3, 6, 3, '2022-04-11', 'Мумрики', '1', 'Собирание оригами', 'Шуссель', 'Обсерватория'),
(4376060, 1, 4, 4, '2022-04-11', 'Снорки,Муми-тролли,Мумрики', '', 'Собирание оригами', 'Муми-папа', 'Обсерватория'),
(4376790, 2, 3, 5, '2022-04-11', 'Мумрики', '', 'Плетение фенечек', '', 'Зимний сад'),
(4376792, 1, 3, 3, '2022-04-11', 'Муми-тролли,Мумрики', '', 'Плетение фенечек', '', 'Обсерватория'),
(4376814, 2, 5, 4, '2022-04-11', 'Муми-тролли', '', 'Игры на музыкальных инструментах', 'Морра', 'Танцплощадка'),
(4376817, 2, 3, 5, '2022-04-11', 'Снорки', '', 'Игры на музыкальных инструментах', 'Морра', 'Грот'),
(4376818, 2, 3, 4, '2022-04-11', 'Мумрики', '', 'Игры на музыкальных инструментах', 'Морра', 'Танцплощадка'),
(4380727, 3, 6, 4, '2022-04-18', 'Мумрики', '1', 'Методы улавливания полезной информации', 'Юксаре', 'Зимний сад'),
(4380728, 3, 5, 5, '2022-04-18', 'Муми-тролли', '1', 'Методы улавливания полезной информации', 'Юксаре', 'Обсерватория'),
(4380729, 1, 4, 4, '2022-04-18', 'Снорки,Муми-тролли,Мумрики', '', 'Методы улавливания полезной информации', 'Юксаре', 'Обсерватория'),
(4380730, 3, 6, 5, '2022-04-18', 'Снорки', '1', 'Методы улавливания полезной информации', 'Юксаре', 'Обсерватория'),
(4380731, 3, 6, 3, '2022-04-18', 'Муми-тролли', '2', 'Методы улавливания полезной информации', 'Юксаре', 'Грот'),
(4381623, 2, 3, 4, '2022-04-18', 'Снорки', '', 'Основы собирания табуреток', 'Ти-ти-у-у', 'Грот'),
(4381624, 1, 5, 3, '2022-04-18', 'Снорки', '', 'Основы собирания табуреток', 'Ти-ти-у-у', 'Грот'),
(4381625, 3, 4, 2, '2022-04-18', 'Снорки', '1', 'Основы собирания табуреток', 'Ти-ти-у-у', 'Обсерватория'),
(4381631, 3, 5, 5, '2022-04-18', 'Муми-тролли', '2', 'Обустраивание личного пространства', 'Муми-мама', 'Грот'),
(4381632, 3, 2, 4, '2022-04-18', 'Мумрики', '1', 'Обустраивание личного пространства', 'Муми-мама', 'Обсерватория'),
(4381634, 3, 5, 6, '2022-04-18', 'Муми-тролли', '1', 'Обустраивание личного пространства', 'Муми-мама', 'Обсерватория'),
(4381636, 2, 4, 5, '2022-04-18', 'Мумрики', '', 'Обустраивание личного пространства', 'Муми-мама', 'Грот'),
(4381638, 1, 4, 3, '2022-04-18', 'Муми-тролли,Мумрики', '', 'Обустраивание личного пространства', 'Муми-мама', 'Грот'),
(4384288, 1, 5, 2, '2022-04-18', 'Снорки', '', 'Способы выпутывания из безвыходных ситуаций', 'Туу-тикки', 'Обсерватория'),
(4384343, 3, 2, 5, '2022-04-18', 'Мумрики', '1', 'Уборка территори', 'Тюлиппа', 'Чердак'),
(4384345, 3, 6, 5, '2022-04-18', 'Муми-тролли', '1', 'Уборка территори', 'Тюлиппа', 'Чердак'),
(4384347, 3, 6, 4, '2022-04-18', 'Снорки', '1', 'Уборка территори', 'Тюлиппа', 'У кустов сирени'),
(4386220, 1, 3, 5, '2022-04-18', 'Снорки,Муми-тролли,Мумрики', '', 'Танцы', 'Тофсла', 'Танцплощадка'),
(4386754, 3, 6, 6, '2022-04-18', 'Муми-тролли', '1', 'Собирание оригами', 'Шуссель', 'Зимний сад'),
(4386756, 3, 4, 3, '2022-04-18', 'Снорки', '1', 'Собирание оригами', 'Шуссель', 'Зимний сад'),
(4386757, 3, 6, 4, '2022-04-18', 'Муми-тролли', '2', 'Собирание оригами', 'Шуссель', 'Грот'),
(4386758, 3, 6, 3, '2022-04-18', 'Мумрики', '1', 'Собирание оригами', 'Шуссель', 'Обсерватория'),
(4387462, 2, 3, 4, '2022-04-18', 'Муми-тролли', '', 'Плетение фенечек', '', 'Зимний сад'),
(4387463, 1, 3, 3, '2022-04-18', 'Муми-тролли,Мумрики', '', 'Плетение фенечек', '', 'Обсерватория'),
(4387483, 2, 5, 4, '2022-04-18', 'Муми-тролли', '', 'Игры на музыкальных инструментах', 'Морра', 'Зимний сад'),
(4387485, 1, 3, 6, '2022-04-18', 'Снорки,Муми-тролли,Мумрики', '', 'Игры на музыкальных инструментах', 'Морра', 'Грот'),
(4387486, 2, 4, 5, '2022-04-18', 'Снорки', '', 'Игры на музыкальных инструментах', 'Морра', 'Зимний сад'),
(4387488, 2, 3, 4, '2022-04-18', 'Мумрики', '', 'Игры на музыкальных инструментах', 'Морра', 'Танцплощадка');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `schedule`
--
ALTER TABLE `schedule`
  ADD PRIMARY KEY (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;