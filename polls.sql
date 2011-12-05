-- phpMyAdmin SQL Dump
-- version 3.4.7
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Дек 05 2011 г., 18:38
-- Версия сервера: 5.5.16
-- Версия PHP: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `shop`
--

-- --------------------------------------------------------

--
-- Структура таблицы `polls`
--

CREATE TABLE IF NOT EXISTS `polls` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `published` tinyint(4) NOT NULL DEFAULT '0',
  `statistic_type` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `polls`
--

INSERT INTO `polls` (`id`, `name`, `published`, `statistic_type`) VALUES
(1, 'Как на Руси жить хорошо?', 1, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `polls_variable`
--

CREATE TABLE IF NOT EXISTS `polls_variable` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `polls_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `sort` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `polls_id` (`polls_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=31 ;

--
-- Дамп данных таблицы `polls_variable`
--

INSERT INTO `polls_variable` (`id`, `polls_id`, `name`, `sort`) VALUES
(29, 1, 'sfsdfфывф', 0),
(30, 1, 'sdfsdfsdfs', 0),
(26, 1, 'ываываы', 1),
(28, 1, 'sfsdf', 0),
(25, 1, 'ываываы', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `polls_votes`
--

CREATE TABLE IF NOT EXISTS `polls_votes` (
  `id_user` int(11) NOT NULL,
  `id_polls` int(11) NOT NULL,
  `id_variable` int(11) NOT NULL,
  PRIMARY KEY (`id_user`),
  KEY `id_user` (`id_user`,`id_polls`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
