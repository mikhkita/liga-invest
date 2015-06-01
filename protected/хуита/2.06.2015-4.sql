-- phpMyAdmin SQL Dump
-- version 4.0.10.6
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1:3306
-- Время создания: Июн 02 2015 г., 02:45
-- Версия сервера: 5.5.41-log
-- Версия PHP: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `liga`
--

-- --------------------------------------------------------

--
-- Структура таблицы `faq`
--

CREATE TABLE IF NOT EXISTS `faq` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `question` varchar(1000) NOT NULL,
  `answer` text NOT NULL,
  `sort` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Дамп данных таблицы `faq`
--

INSERT INTO `faq` (`id`, `question`, `answer`, `sort`) VALUES
(1, 'Здравствуйте, меня зовут Ричард Брэнсон, я владелец авиакомпании Virgin Atlantic.', 'Неужели такой премиальный бренд не может себе позволить нанять достаточное количество сотрудников в службу поддержки?', 10),
(2, 'Здравствуйте, меня зовут Ричард Брэнсон, я владелец авиакомпании Virgin Atlantic.', 'Неужели такой премиальный бренд не может себе позволить нанять достаточное количество сотрудников в службу поддержки?', 20),
(3, 'Здравствуйте, меня зовут Ричард Брэнсон, я владелец авиакомпании Virgin Atlantic.', 'Неужели такой премиальный бренд не может себе позволить нанять достаточное количество сотрудников в службу поддержки?', 30);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
