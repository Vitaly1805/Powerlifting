-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Июн 02 2021 г., 11:58
-- Версия сервера: 8.0.19
-- Версия PHP: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `powerlifting`
--

-- --------------------------------------------------------

--
-- Структура таблицы `admin`
--

CREATE TABLE `admin` (
  `id_admin` int NOT NULL,
  `name` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `patronymic` varchar(100) NOT NULL,
  `login` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `admin`
--

INSERT INTO `admin` (`id_admin`, `name`, `lastname`, `patronymic`, `login`, `password`) VALUES
(1, 'Виталий', 'Носов', 'Вадимович', 'vitali@gmail.com', 'vitali'),
(2, 'Владимир', 'Ионов', 'Андреевич', 'admin@gmail.com', 'admin');

-- --------------------------------------------------------

--
-- Структура таблицы `approach`
--

CREATE TABLE `approach` (
  `id_approach` int NOT NULL,
  `id_questionnaire` int NOT NULL,
  `id_view` int NOT NULL,
  `number` int NOT NULL,
  `result` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `approach`
--

INSERT INTO `approach` (`id_approach`, `id_questionnaire`, `id_view`, `number`, `result`) VALUES
(164, 1, 1, 1, 140),
(165, 1, 1, 2, 164),
(166, 1, 1, 3, 181),
(167, 1, 2, 1, 160),
(168, 1, 2, 2, 140),
(169, 1, 2, 3, 150),
(170, 1, 3, 1, 140),
(171, 1, 3, 2, 162),
(172, 1, 3, 3, 180),
(173, 2, 1, 1, 123),
(174, 2, 1, 2, 124),
(175, 2, 1, 3, 130),
(176, 2, 2, 1, 123),
(177, 2, 2, 2, 145),
(178, 2, 2, 3, 156),
(179, 2, 3, 1, 123),
(180, 2, 3, 2, 135),
(181, 2, 3, 3, 145),
(182, 3, 1, 1, 140),
(183, 3, 1, 2, 150),
(184, 3, 1, 3, 181),
(185, 3, 2, 1, 121),
(186, 3, 2, 2, 140),
(187, 3, 2, 3, 150),
(188, 3, 3, 1, 130),
(189, 3, 3, 2, 160),
(190, 3, 3, 3, 130),
(236, 82, 1, 1, 233),
(237, 82, 1, 2, 0),
(238, 82, 1, 3, 0),
(239, 82, 2, 1, 133),
(240, 82, 2, 2, 0),
(241, 82, 2, 3, 0),
(242, 82, 3, 1, 140),
(243, 82, 3, 2, 0),
(244, 82, 3, 3, 0),
(245, 81, 1, 1, 233),
(246, 81, 1, 2, 0),
(247, 81, 1, 3, 0),
(248, 81, 2, 1, 133),
(249, 81, 2, 2, 0),
(250, 81, 2, 3, 0),
(251, 81, 3, 1, 140),
(252, 81, 3, 2, 0),
(253, 81, 3, 3, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `athlete`
--

CREATE TABLE `athlete` (
  `id_athlete` int NOT NULL,
  `id_trainer` int NOT NULL,
  `id_sports_category` int NOT NULL,
  `id_city` int NOT NULL,
  `id_team` int NOT NULL,
  `name` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `patronymic` varchar(100) NOT NULL,
  `login` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `weight` int NOT NULL,
  `max_press` int NOT NULL,
  `max_rod` int NOT NULL,
  `max_squat` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `athlete`
--

INSERT INTO `athlete` (`id_athlete`, `id_trainer`, `id_sports_category`, `id_city`, `id_team`, `name`, `lastname`, `patronymic`, `login`, `password`, `weight`, `max_press`, `max_rod`, `max_squat`) VALUES
(1, 1, 1, 2, 1, 'Захар', 'Семяшкин', 'Владимирович', 'zahar@gmail.com', 'zahar', 73, 140, 233, 133),
(2, 2, 2, 1, 2, 'Ярослав', 'Мельникович', 'Алексеевич', 'yar@gmail.com', 'yar', 72, 130, 150, 170),
(3, 1, 1, 1, 1, 'Андрей', 'Семенов', 'Андреевич', 'andrey@gmail.com', 'andrey', 71, 120, 140, 150),
(4, 3, 2, 3, 2, 'Алексей', 'Михеев', 'Владимирович', 'alex@mail.com', 'alex', 70, 132, 147, 165),
(5, 1, 1, 2, 3, 'Влад', 'Поташов', 'Радионович', 'vlad@gmail.com', 'vlad', 71, 122, 147, 162),
(6, 3, 1, 2, 3, 'Вадим', 'Носов', 'Геннадьевич', 'vadim@mail.com', 'vadim', 73, 152, 178, 171),
(7, 1, 1, 1, 3, 'Геннадий', 'Носов', 'Иосифович', 'gennady@gmail.com', 'gennady', 74, 155, 169, 167),
(8, 3, 2, 1, 1, 'Яков', 'Чупров', 'Андреевич', 'yakov@mail.com', 'yakov', 71, 129, 134, 153),
(52, 1, 1, 1, 1, 'Ыаыв', 'Ыва', 'Уца', '12w@mail.com', '2', 12, 324, 234, 324);

-- --------------------------------------------------------

--
-- Структура таблицы `city`
--

CREATE TABLE `city` (
  `id_city` int NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `city`
--

INSERT INTO `city` (`id_city`, `name`) VALUES
(1, 'Москва'),
(2, 'Санкт-Петербург'),
(3, 'Ухта');

-- --------------------------------------------------------

--
-- Структура таблицы `competition`
--

CREATE TABLE `competition` (
  `id_competition` int NOT NULL,
  `id_admin` int NOT NULL,
  `id_judge` int NOT NULL,
  `date` datetime NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `url` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `competition`
--

INSERT INTO `competition` (`id_competition`, `id_admin`, `id_judge`, `date`, `name`, `description`, `url`) VALUES
(2, 2, 1, '2021-05-14 00:00:00', 'Международный мастерский турнир «Мандарин»', 'Всероссийский мастерский турнир «Мандарин» по пауэрлифтингу, силовому двоеборью, жиму лёжа, становой тяге, народному жиму и строгому подъёму на бицепс по версиям WRPF/WEPF, Россия / Рязань, 28-29.08.21 (присвоение до МСМК включительно)', 'images\\competitions\\_28.08.2021.jpg'),
(3, 2, 2, '2021-05-21 11:42:00', 'Чемпионат Центрального федерального округа по пауэрлифтингу', 'Чемпионат Центрального федерального округа по пауэрлифтингу, силовому двоеборью, приседу, жиму лежа, народному жиму, становой тяге и пауэрспорту по версиям IPL/СПР, Россия / Москва, 06-07.11.2021 (присвоение до МСМК включительно)', 'images/competitions/_ЦФО_06-07.11.2021-2.png'),
(36, 2, 23, '2021-07-03 11:00:00', '1', '1', 'images/competitions/Evrazia_16-17.10.21.jpg'),
(37, 2, 23, '2021-06-07 11:00:00', '123', '12', 'images/competitions/WORLD-ВРПФ_2021-2.webp');

-- --------------------------------------------------------

--
-- Структура таблицы `judge`
--

CREATE TABLE `judge` (
  `id_judge` int NOT NULL,
  `name` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `patronymic` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `judge`
--

INSERT INTO `judge` (`id_judge`, `name`, `lastname`, `patronymic`) VALUES
(1, 'Георгий', 'Слабодич', 'Валентинович'),
(2, 'Аркадий', 'Голубенко', 'Васильевич'),
(23, 'Дмитрий', 'Иванов', 'Алексеевич'),
(24, 'Михаил', 'Иванов', 'Алексеевич');

-- --------------------------------------------------------

--
-- Структура таблицы `questionnaire`
--

CREATE TABLE `questionnaire` (
  `id_questionnaire` int NOT NULL,
  `id_athlete` int NOT NULL,
  `id_competition` int NOT NULL,
  `category` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `questionnaire`
--

INSERT INTO `questionnaire` (`id_questionnaire`, `id_athlete`, `id_competition`, `category`) VALUES
(1, 1, 2, '73'),
(2, 2, 2, '73'),
(3, 2, 3, '70'),
(81, 1, 37, '73'),
(82, 1, 36, '73'),
(83, 1, 37, '73');

-- --------------------------------------------------------

--
-- Структура таблицы `sports_category`
--

CREATE TABLE `sports_category` (
  `id_sports_category` int NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `sports_category`
--

INSERT INTO `sports_category` (`id_sports_category`, `name`) VALUES
(1, 'МСМК'),
(2, 'МС'),
(42, 'КМС'),
(43, '1 взрослый'),
(44, '2 взрослый'),
(45, '3 взрослый'),
(46, '1 юношеский'),
(47, '2 юношеский'),
(48, '3 юношеский');

-- --------------------------------------------------------

--
-- Структура таблицы `team`
--

CREATE TABLE `team` (
  `id_team` int NOT NULL,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `team`
--

INSERT INTO `team` (`id_team`, `name`) VALUES
(1, 'Дельфинчики'),
(2, 'Силачи'),
(3, 'Спартанцы'),
(1401, 'Wqeqw');

-- --------------------------------------------------------

--
-- Структура таблицы `trainer`
--

CREATE TABLE `trainer` (
  `id_trainer` int NOT NULL,
  `name` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `patronymic` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `trainer`
--

INSERT INTO `trainer` (`id_trainer`, `name`, `lastname`, `patronymic`) VALUES
(1, 'Умалат', 'Мурзабеков', 'Ахметович'),
(2, 'Юлия', 'Поздеева', 'Александровна'),
(3, 'Владимир', 'Поздеев', 'Александрович');

-- --------------------------------------------------------

--
-- Структура таблицы `view`
--

CREATE TABLE `view` (
  `id_view` int NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `view`
--

INSERT INTO `view` (`id_view`, `name`) VALUES
(1, 'Тяга'),
(2, 'Присед'),
(3, 'Жим');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Индексы таблицы `approach`
--
ALTER TABLE `approach`
  ADD PRIMARY KEY (`id_approach`),
  ADD KEY `id_questionnaire` (`id_questionnaire`),
  ADD KEY `id_view` (`id_view`);

--
-- Индексы таблицы `athlete`
--
ALTER TABLE `athlete`
  ADD PRIMARY KEY (`id_athlete`),
  ADD KEY `id_trainer` (`id_trainer`),
  ADD KEY `id_city` (`id_city`),
  ADD KEY `id_sports_category` (`id_sports_category`),
  ADD KEY `id_team` (`id_team`);

--
-- Индексы таблицы `city`
--
ALTER TABLE `city`
  ADD PRIMARY KEY (`id_city`);

--
-- Индексы таблицы `competition`
--
ALTER TABLE `competition`
  ADD PRIMARY KEY (`id_competition`),
  ADD KEY `id_admin` (`id_admin`),
  ADD KEY `id_judge` (`id_judge`);

--
-- Индексы таблицы `judge`
--
ALTER TABLE `judge`
  ADD PRIMARY KEY (`id_judge`);

--
-- Индексы таблицы `questionnaire`
--
ALTER TABLE `questionnaire`
  ADD PRIMARY KEY (`id_questionnaire`),
  ADD KEY `id_athlete` (`id_athlete`),
  ADD KEY `id_competition` (`id_competition`);

--
-- Индексы таблицы `sports_category`
--
ALTER TABLE `sports_category`
  ADD PRIMARY KEY (`id_sports_category`);

--
-- Индексы таблицы `team`
--
ALTER TABLE `team`
  ADD PRIMARY KEY (`id_team`);

--
-- Индексы таблицы `trainer`
--
ALTER TABLE `trainer`
  ADD PRIMARY KEY (`id_trainer`);

--
-- Индексы таблицы `view`
--
ALTER TABLE `view`
  ADD PRIMARY KEY (`id_view`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `approach`
--
ALTER TABLE `approach`
  MODIFY `id_approach` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=254;

--
-- AUTO_INCREMENT для таблицы `athlete`
--
ALTER TABLE `athlete`
  MODIFY `id_athlete` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT для таблицы `city`
--
ALTER TABLE `city`
  MODIFY `id_city` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1410;

--
-- AUTO_INCREMENT для таблицы `competition`
--
ALTER TABLE `competition`
  MODIFY `id_competition` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT для таблицы `judge`
--
ALTER TABLE `judge`
  MODIFY `id_judge` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT для таблицы `questionnaire`
--
ALTER TABLE `questionnaire`
  MODIFY `id_questionnaire` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT для таблицы `sports_category`
--
ALTER TABLE `sports_category`
  MODIFY `id_sports_category` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT для таблицы `team`
--
ALTER TABLE `team`
  MODIFY `id_team` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1402;

--
-- AUTO_INCREMENT для таблицы `trainer`
--
ALTER TABLE `trainer`
  MODIFY `id_trainer` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1426;

--
-- AUTO_INCREMENT для таблицы `view`
--
ALTER TABLE `view`
  MODIFY `id_view` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `approach`
--
ALTER TABLE `approach`
  ADD CONSTRAINT `approach_ibfk_2` FOREIGN KEY (`id_questionnaire`) REFERENCES `questionnaire` (`id_questionnaire`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `approach_ibfk_3` FOREIGN KEY (`id_view`) REFERENCES `view` (`id_view`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Ограничения внешнего ключа таблицы `athlete`
--
ALTER TABLE `athlete`
  ADD CONSTRAINT `athlete_ibfk_1` FOREIGN KEY (`id_trainer`) REFERENCES `trainer` (`id_trainer`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `athlete_ibfk_2` FOREIGN KEY (`id_city`) REFERENCES `city` (`id_city`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `athlete_ibfk_3` FOREIGN KEY (`id_sports_category`) REFERENCES `sports_category` (`id_sports_category`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `athlete_ibfk_4` FOREIGN KEY (`id_team`) REFERENCES `team` (`id_team`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Ограничения внешнего ключа таблицы `competition`
--
ALTER TABLE `competition`
  ADD CONSTRAINT `competition_ibfk_1` FOREIGN KEY (`id_admin`) REFERENCES `admin` (`id_admin`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `competition_ibfk_2` FOREIGN KEY (`id_judge`) REFERENCES `judge` (`id_judge`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Ограничения внешнего ключа таблицы `questionnaire`
--
ALTER TABLE `questionnaire`
  ADD CONSTRAINT `questionnaire_ibfk_1` FOREIGN KEY (`id_athlete`) REFERENCES `athlete` (`id_athlete`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `questionnaire_ibfk_2` FOREIGN KEY (`id_competition`) REFERENCES `competition` (`id_competition`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
