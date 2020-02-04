-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Фев 04 2020 г., 12:08
-- Версия сервера: 5.6.41-log
-- Версия PHP: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `t_platform`
--

-- --------------------------------------------------------

--
-- Структура таблицы `answer_item`
--

CREATE TABLE `answer_item` (
  `id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `text` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_right` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `answer_item`
--

INSERT INTO `answer_item` (`id`, `question_id`, `text`, `is_right`) VALUES
(1, 1, 'answer', NULL),
(2, 3, 'right', 1),
(3, 3, 'false', NULL),
(4, 3, 'false', NULL),
(5, 2, 'right', 1),
(6, 2, 'false', NULL),
(7, 2, 'right', 1),
(8, 2, 'false', NULL),
(9, 10, 'answer', NULL),
(10, 12, 'right', 1),
(11, 12, 'false', NULL),
(12, 12, 'false', NULL),
(13, 11, 'right', 1),
(14, 11, 'false', NULL),
(15, 11, 'right', 1),
(16, 11, 'false', NULL),
(17, 7, 'turtle plastrons', 1),
(18, 7, 'animal bones', 1),
(19, 7, 'tarot cards', NULL),
(20, 7, 'fire flame', NULL),
(21, 9, 'The Yantze river delta', NULL),
(22, 9, 'The Yellow river delta', 1),
(23, 9, 'The Mekong river delta', NULL),
(24, 4, 'The Great Wall', NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `completed`
--

CREATE TABLE `completed` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `test_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `completed`
--

INSERT INTO `completed` (`id`, `user_id`, `test_id`) VALUES
(1, NULL, 3),
(2, NULL, 3),
(3, 1, 3),
(4, 1, 1),
(5, 1, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `migration_versions`
--

CREATE TABLE `migration_versions` (
  `version` varchar(14) COLLATE utf8mb4_unicode_ci NOT NULL,
  `executed_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `question`
--

CREATE TABLE `question` (
  `id` int(11) NOT NULL,
  `test_id` int(11) NOT NULL,
  `type_id` int(11) NOT NULL,
  `text` longtext COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `question`
--

INSERT INTO `question` (`id`, `test_id`, `type_id`, `text`) VALUES
(1, 3, 3, 'The right answer is \"answer\"'),
(2, 3, 2, 'Choose the right answer(s)'),
(3, 3, 1, 'Chose the right answer'),
(4, 1, 3, 'What has the first chinese emperor Qin Shihuang build?'),
(7, 1, 2, 'What did Chinese people use to predict their faith during the Yin dinasty period?'),
(9, 1, 1, 'What was the cradle of Chinese civilization?'),
(10, 3, 3, 'The right answer is \"answer\"'),
(11, 3, 2, 'Choose the right answer(s)'),
(12, 3, 1, 'Chose the right answer');

-- --------------------------------------------------------

--
-- Структура таблицы `question_type`
--

CREATE TABLE `question_type` (
  `id` int(11) NOT NULL,
  `type` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `question_type`
--

INSERT INTO `question_type` (`id`, `type`) VALUES
(1, 'single'),
(2, 'multiple'),
(3, 'text');

-- --------------------------------------------------------

--
-- Структура таблицы `test`
--

CREATE TABLE `test` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `test`
--

INSERT INTO `test` (`id`, `name`) VALUES
(1, 'History of Ancient China'),
(3, 'New Test');

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username_canonical` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_canonical` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `salt` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `confirmation_token` varchar(180) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password_requested_at` datetime DEFAULT NULL,
  `roles` longtext COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:array)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `username`, `username_canonical`, `email`, `email_canonical`, `enabled`, `salt`, `password`, `last_login`, `confirmation_token`, `password_requested_at`, `roles`) VALUES
(1, 'Astrid', 'astrid', 'evgeniia.shumakova@gmail.com', 'evgeniia.shumakova@gmail.com', 1, 'pFQkeO09LXtMH2oIz8WuAlxE6nJSEE0mLHsWr8XImy0', '$2y$13$Ov/H1C5JOXZLRHnnha91g.5/RAHJVvIi11Z7EeAXho.85WdDNRWTi', '2020-02-04 11:18:13', NULL, NULL, 'a:0:{}');

-- --------------------------------------------------------

--
-- Структура таблицы `user_answer`
--

CREATE TABLE `user_answer` (
  `id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `completed_id` int(11) NOT NULL,
  `answer_text` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `user_answer`
--

INSERT INTO `user_answer` (`id`, `question_id`, `completed_id`, `answer_text`) VALUES
(1, 1, 1, 'answer'),
(2, 2, 1, NULL),
(3, 3, 1, NULL),
(4, 10, 1, 'ans'),
(5, 11, 1, NULL),
(6, 12, 1, NULL),
(7, 1, 2, 'answer'),
(8, 2, 2, NULL),
(9, 3, 2, NULL),
(10, 10, 2, 'ans'),
(11, 11, 2, NULL),
(12, 12, 2, NULL),
(13, 1, 3, 'answer'),
(14, 2, 3, NULL),
(15, 3, 3, NULL),
(16, 10, 3, 'ans'),
(17, 11, 3, NULL),
(18, 12, 3, NULL),
(19, 4, 4, 'The Great Wall'),
(20, 7, 4, NULL),
(21, 9, 4, NULL),
(22, 4, 5, 'The Great Wall'),
(23, 7, 5, NULL),
(24, 9, 5, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `user_answer_answer_item`
--

CREATE TABLE `user_answer_answer_item` (
  `user_answer_id` int(11) NOT NULL,
  `answer_item_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `user_answer_answer_item`
--

INSERT INTO `user_answer_answer_item` (`user_answer_id`, `answer_item_id`) VALUES
(2, 5),
(2, 6),
(3, 2),
(5, 13),
(5, 15),
(6, 10),
(8, 5),
(8, 6),
(9, 2),
(11, 13),
(11, 15),
(12, 10),
(14, 6),
(15, 4),
(17, 13),
(17, 14),
(18, 10),
(20, 17),
(20, 18),
(21, 23),
(23, 17),
(23, 18),
(24, 23);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `answer_item`
--
ALTER TABLE `answer_item`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_4130C6DE1E27F6BF` (`question_id`);

--
-- Индексы таблицы `completed`
--
ALTER TABLE `completed`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_3AF85C6EA76ED395` (`user_id`),
  ADD KEY `IDX_3AF85C6E1E5D0459` (`test_id`);

--
-- Индексы таблицы `migration_versions`
--
ALTER TABLE `migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Индексы таблицы `question`
--
ALTER TABLE `question`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_B6F7494E1E5D0459` (`test_id`),
  ADD KEY `IDX_B6F7494EC54C8C93` (`type_id`);

--
-- Индексы таблицы `question_type`
--
ALTER TABLE `question_type`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `test`
--
ALTER TABLE `test`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_8D93D64992FC23A8` (`username_canonical`),
  ADD UNIQUE KEY `UNIQ_8D93D649A0D96FBF` (`email_canonical`),
  ADD UNIQUE KEY `UNIQ_8D93D649C05FB297` (`confirmation_token`);

--
-- Индексы таблицы `user_answer`
--
ALTER TABLE `user_answer`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_BF8F51181E27F6BF` (`question_id`),
  ADD KEY `IDX_BF8F511881604B56` (`completed_id`);

--
-- Индексы таблицы `user_answer_answer_item`
--
ALTER TABLE `user_answer_answer_item`
  ADD PRIMARY KEY (`user_answer_id`,`answer_item_id`),
  ADD KEY `IDX_2C7AB006AAD3C5E3` (`user_answer_id`),
  ADD KEY `IDX_2C7AB0065A2F9D2F` (`answer_item_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `answer_item`
--
ALTER TABLE `answer_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT для таблицы `completed`
--
ALTER TABLE `completed`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `question`
--
ALTER TABLE `question`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT для таблицы `question_type`
--
ALTER TABLE `question_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `test`
--
ALTER TABLE `test`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `user_answer`
--
ALTER TABLE `user_answer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `answer_item`
--
ALTER TABLE `answer_item`
  ADD CONSTRAINT `FK_4130C6DE1E27F6BF` FOREIGN KEY (`question_id`) REFERENCES `question` (`id`);

--
-- Ограничения внешнего ключа таблицы `completed`
--
ALTER TABLE `completed`
  ADD CONSTRAINT `FK_3AF85C6E1E5D0459` FOREIGN KEY (`test_id`) REFERENCES `test` (`id`),
  ADD CONSTRAINT `FK_3AF85C6EA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Ограничения внешнего ключа таблицы `question`
--
ALTER TABLE `question`
  ADD CONSTRAINT `FK_B6F7494E1E5D0459` FOREIGN KEY (`test_id`) REFERENCES `test` (`id`),
  ADD CONSTRAINT `FK_B6F7494EC54C8C93` FOREIGN KEY (`type_id`) REFERENCES `question_type` (`id`);

--
-- Ограничения внешнего ключа таблицы `user_answer`
--
ALTER TABLE `user_answer`
  ADD CONSTRAINT `FK_BF8F51181E27F6BF` FOREIGN KEY (`question_id`) REFERENCES `question` (`id`),
  ADD CONSTRAINT `FK_BF8F511881604B56` FOREIGN KEY (`completed_id`) REFERENCES `completed` (`id`);

--
-- Ограничения внешнего ключа таблицы `user_answer_answer_item`
--
ALTER TABLE `user_answer_answer_item`
  ADD CONSTRAINT `FK_2C7AB0065A2F9D2F` FOREIGN KEY (`answer_item_id`) REFERENCES `answer_item` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_2C7AB006AAD3C5E3` FOREIGN KEY (`user_answer_id`) REFERENCES `user_answer` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

