-- phpMyAdmin SQL Dump
-- version 3.4.7
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Дек 12 2011 г., 00:24
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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Дамп данных таблицы `answer`
--

INSERT INTO `answer` (`id`, `quest_id`, `value`, `is_answer`) VALUES
(1, 1, 'sdfsd', 0),
(2, 1, 'sss23', 0),
(4, 1, 'Слава?', 0);

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `question`
--

INSERT INTO `question` (`id`, `name`, `description`, `complex`, `type`) VALUES
(1, 'Привет', '1111', 0, 1);

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=24 ;

--
-- Дамп данных таблицы `task`
--

INSERT INTO `task` (`id`, `time_create`, `type`, `status`, `time_start`, `time_end`, `lot_id`, `proportion`, `count_users`, `count_end_users`) VALUES
(23, 1323632704, 1, 2, 0, 0, 2, '10/1/2', 0, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `task_question_relation`
--

CREATE TABLE IF NOT EXISTS `task_question_relation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `task_id` int(11) NOT NULL,
  `quest_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Дамп данных таблицы `task_question_relation`
--

INSERT INTO `task_question_relation` (`id`, `task_id`, `quest_id`) VALUES
(1, 21, 1),
(2, 22, 1),
(3, 23, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `task_user`
--

CREATE TABLE IF NOT EXISTS `task_user` (
  `id_user` int(11) NOT NULL,
  `id_task` int(11) NOT NULL,
  `votes` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
