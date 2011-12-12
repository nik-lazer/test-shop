-- phpMyAdmin SQL Dump
-- version 3.4.7
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Дек 12 2011 г., 19:51
-- Версия сервера: 5.5.16
-- Версия PHP: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `task`
--

-- --------------------------------------------------------

--
-- Структура таблицы `answer`
--

CREATE TABLE IF NOT EXISTS `answer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `quest_id` int(11) NOT NULL,
  `value` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `is_answer` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=14 ;

--
-- Дамп данных таблицы `answer`
--

INSERT INTO `answer` (`id`, `quest_id`, `value`, `is_answer`) VALUES
(1, 1, 'sdfsd', 0),
(2, 1, 'sss23', 0),
(4, 1, 'Слава?', 1),
(5, 2, '1', 0),
(6, 2, 'Ответ', 1),
(7, 2, 'вввв', 0),
(8, 2, 'вввв1', 0),
(9, 3, '1231', 0),
(10, 3, '123112', 0),
(11, 3, 'Ответ', 1),
(12, 4, 'Нашшш', 0),
(13, 4, 'Ответ', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `question`
--

CREATE TABLE IF NOT EXISTS `question` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `complex` tinyint(4) NOT NULL,
  `type` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Дамп данных таблицы `question`
--

INSERT INTO `question` (`id`, `name`, `description`, `complex`, `type`) VALUES
(1, 'Вопрос1', '1111', 0, 1),
(2, 'Вопрос2', '', 0, 1),
(3, 'Вопрос3', '1231', 0, 1),
(4, 'Вопрос4', '', 2, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `task`
--

CREATE TABLE IF NOT EXISTS `task` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `time_create` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `status` tinyint(5) NOT NULL DEFAULT '0',
  `time_start` int(11) NOT NULL DEFAULT '0',
  `time_end` int(11) NOT NULL DEFAULT '0',
  `lot_id` int(11) NOT NULL DEFAULT '0',
  `proportion` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `count_users` int(11) NOT NULL DEFAULT '0',
  `count_end_users` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=29 ;

--
-- Дамп данных таблицы `task`
--

INSERT INTO `task` (`id`, `time_create`, `type`, `status`, `time_start`, `time_end`, `lot_id`, `proportion`, `count_users`, `count_end_users`) VALUES
(28, 1323708898, 1, 2, 0, 0, 2, '12/3/4', 0, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `task_question_relation`
--

CREATE TABLE IF NOT EXISTS `task_question_relation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `task_id` int(11) NOT NULL,
  `quest_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=15 ;

--
-- Дамп данных таблицы `task_question_relation`
--

INSERT INTO `task_question_relation` (`id`, `task_id`, `quest_id`) VALUES
(0, 25, 3),
(6, 26, 3),
(7, 27, 3),
(8, 27, 1),
(9, 27, 2),
(10, 27, 4),
(11, 28, 2),
(12, 28, 3),
(13, 28, 1),
(14, 28, 4);

-- --------------------------------------------------------

--
-- Структура таблицы `task_user`
--

CREATE TABLE IF NOT EXISTS `task_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `id_task` int(11) NOT NULL,
  `votes` text COLLATE utf8_unicode_ci NOT NULL,
  `time_start` int(11) NOT NULL,
  `time_end` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
