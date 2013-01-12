-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Янв 09 2013 г., 14:47
-- Версия сервера: 5.5.24-log
-- Версия PHP: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `edbo`
--

-- --------------------------------------------------------

--
-- Структура таблицы `personsextypes`
--

CREATE TABLE IF NOT EXISTS `personsextypes` (
  `idPersonSexTypes` int(11) NOT NULL,
  `PersonSexTypesName` char(12) NOT NULL,
  PRIMARY KEY (`idPersonSexTypes`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `personsextypes`
--

INSERT INTO `personsextypes` (`idPersonSexTypes`, `PersonSexTypesName`) VALUES
(0, 'Не визначено'),
(1, 'Чоловіча'),
(2, 'Жіноча');

-- --------------------------------------------------------

--
-- Структура таблицы `sys_roleassignments`
--

CREATE TABLE IF NOT EXISTS `sys_roleassignments` (
  `itemname` varchar(64) NOT NULL,
  `userid` varchar(64) NOT NULL,
  `bizrule` text,
  `data` text,
  PRIMARY KEY (`itemname`,`userid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `sys_roleassignments`
--

INSERT INTO `sys_roleassignments` (`itemname`, `userid`, `bizrule`, `data`) VALUES
('Admins', '1', '', 's:0:"";'),
('Operators', '4', '', 's:0:"";'),
('Root', '3', '', 's:0:"";');

-- --------------------------------------------------------

--
-- Структура таблицы `sys_rolechildren`
--

CREATE TABLE IF NOT EXISTS `sys_rolechildren` (
  `parent` varchar(64) NOT NULL,
  `child` varchar(64) NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `sys_roles`
--

CREATE TABLE IF NOT EXISTS `sys_roles` (
  `name` varchar(64) NOT NULL,
  `type` int(11) NOT NULL,
  `description` text,
  `bizrule` text,
  `data` text,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `sys_roles`
--

INSERT INTO `sys_roles` (`name`, `type`, `description`, `bizrule`, `data`) VALUES
('Admins', 2, '', '', 's:0:"";'),
('Operators', 2, '', '', 's:0:"";'),
('Root', 2, '', '', 's:0:"";'),
('Users', 0, '', '', 's:0:"";');

-- --------------------------------------------------------

--
-- Структура таблицы `sys_users`
--

CREATE TABLE IF NOT EXISTS `sys_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `info` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Дамп данных таблицы `sys_users`
--

INSERT INTO `sys_users` (`id`, `username`, `password`, `email`, `info`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin@znu.edu.ua', 'Super User'),
(3, 'munspel', '2c216b1ba5e33a27eb6d3df7de7f8c36', 'munspel@ukr.net', ''),
(4, 'user', 'ee11cbb19052e40b07aac0ca060c23ee', 'user@mail.ru', '');

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `sys_roleassignments`
--
ALTER TABLE `sys_roleassignments`
  ADD CONSTRAINT `sys_roleassignments_ibfk_1` FOREIGN KEY (`itemname`) REFERENCES `sys_roles` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `sys_rolechildren`
--
ALTER TABLE `sys_rolechildren`
  ADD CONSTRAINT `sys_rolechildren_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `sys_roles` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sys_rolechildren_ibfk_2` FOREIGN KEY (`child`) REFERENCES `sys_roles` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
