-- phpMyAdmin SQL Dump
-- version 4.0.10.6
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1:3306
-- Время создания: Июн 02 2015 г., 02:50
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

-- --------------------------------------------------------

--
-- Структура таблицы `investition`
--

CREATE TABLE IF NOT EXISTS `investition` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `text` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Дамп данных таблицы `investition`
--

INSERT INTO `investition` (`id`, `name`, `image`, `text`) VALUES
(1, '10% в месяц', 'upload/images/p19mde6uo61b3j39er9m1d6j1i93e.png', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.'),
(3, '20% в месяц', '', 'asdsdfsdf'),
(4, '15% в месяц', NULL, 'asd');

-- --------------------------------------------------------

--
-- Структура таблицы `model_names`
--

CREATE TABLE IF NOT EXISTS `model_names` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(128) NOT NULL,
  `name` varchar(128) NOT NULL,
  `vin_name` varchar(128) NOT NULL,
  `rod_name` varchar(128) NOT NULL,
  `admin_menu` tinyint(1) NOT NULL DEFAULT '0',
  `sort` smallint(6) DEFAULT '9999',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

--
-- Дамп данных таблицы `model_names`
--

INSERT INTO `model_names` (`id`, `code`, `name`, `vin_name`, `rod_name`, `admin_menu`, `sort`) VALUES
(8, 'text', 'Тексты', 'Текст', 'Текста', 0, NULL),
(9, 'settings', 'Настройки', 'Параметр', 'Параметра', 1, 1000),
(10, 'user', 'Пользователи', 'Пользователя', 'Пользователя', 0, NULL),
(11, 'instruction', 'Инструкция', 'Параметр', 'Параметра', 1, 100),
(12, 'investition', 'Инвестиц. программы', 'Программу', 'Программы', 1, 200),
(13, 'news', 'Новости', 'Новость', 'Новости', 1, 300),
(14, 'support', 'Служба поддержки', 'Запрос', 'Запроса', 1, 500),
(15, 'office', 'Оформление в офисе', 'Параметр', 'Параметра', 1, 400),
(16, 'faq', 'F.A.Q', 'F.A.Q', 'F.A.Q', 1, 600);

-- --------------------------------------------------------

--
-- Структура таблицы `news`
--

CREATE TABLE IF NOT EXISTS `news` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `text` text NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Дамп данных таблицы `news`
--

INSERT INTO `news` (`id`, `name`, `text`, `date`) VALUES
(1, 'Инвестиции в транспорт', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum', '2015-05-21'),
(2, 'Инвестиции в России 2015', 'Инвестиции в России 2015', '2015-05-02'),
(3, 'Инвестиции в транспорт 2014', 'Инвестиции в транспорт 2014', '2015-05-20');

-- --------------------------------------------------------

--
-- Структура таблицы `role`
--

CREATE TABLE IF NOT EXISTS `role` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Дамп данных таблицы `role`
--

INSERT INTO `role` (`id`, `code`, `name`) VALUES
(1, 'root', 'Создатель'),
(2, 'admin', 'Администратор'),
(3, 'manager', 'Контент-менеджер');

-- --------------------------------------------------------

--
-- Структура таблицы `settings`
--

CREATE TABLE IF NOT EXISTS `settings` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `value` text,
  `code` varchar(50) NOT NULL,
  `sort` int(11) NOT NULL DEFAULT '9999',
  `controller_code` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Дамп данных таблицы `settings`
--

INSERT INTO `settings` (`id`, `name`, `value`, `code`, `sort`, `controller_code`) VALUES
(1, 'Заголовок страницы', 'Чип-тюнинг от Tk Motors', 'TITLE', 10, 'settings'),
(2, 'Описание', 'Какое-то описание', 'DESCRIPTION', 20, 'settings'),
(3, 'Ключевые фразы', 'Список ключевых фраз', 'KEYWORDS', 30, 'settings'),
(4, 'Заголовок', 'ООО "Лига Инвест Групп" - Инструкция как по....', 'INST_TITLE', 10, 'instruction'),
(5, 'Видео', '<iframe width="685" height="420" src="https://www.youtube.com/embed/5qoMtprA5AY" frameborder="0" allowfullscreen=""></iframe>', 'INST_VIDEO', 20, 'instruction'),
(6, 'Анкета', '', 'ANKETA', 40, 'settings'),
(7, 'Персональное соглашение', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum." Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."', 'AGREEMENT', 50, 'settings'),
(8, 'Время работы', 'Часы приема:\r\nПонедельник-Пятница с 10:00 до 19:00\r\nСуббота с 10:00 до 16:00\r\nВоскресенье выходной', 'OFFICE_TIME', 30, 'office'),
(9, 'Описание', 'Вы выбрали способ инвестирования: через кассу в офисе компании.Средства \r\nинвестирования:10 000 рублей. \r\nМы ждем Вас завтра в 10:00 утра до 19:00 часов вечера.\r\nНапоминаем, что при себе необходимо иметь \r\nпаспорт: ( серия и номер показывается) а так же оригиналы или копию ИНН.', 'OFFICE_DESCRIPTION', 10, 'office'),
(10, 'Адрес', 'Город: Санкт-Петербург\r\nУлица: Миллионная\r\nДом: 29\r\nТелефон: +7 812 389 55 22', 'OFFICE_ADDR', 20, 'office'),
(11, 'Точка на карте', '59.942342, 30.320029', 'OFFICE_MAP', 40, 'office'),
(12, 'Заголовок', 'Лига Инвест Групп принимает подписаный Вами договор', 'OFFICE_TITLE', 5, 'office');

-- --------------------------------------------------------

--
-- Структура таблицы `support`
--

CREATE TABLE IF NOT EXISTS `support` (
  `date` date NOT NULL,
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `question` text NOT NULL,
  `answer` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `support`
--

INSERT INTO `support` (`date`, `id`, `user_id`, `question`, `answer`) VALUES
('2015-06-01', 1, 1, 'qwe1', ''),
('2015-06-01', 2, 1, 'Здравствуйте, меня зовут Ричард Брэнсон, я владелец авиакомпании Virgin Atlantic. Сейчас все операторы заняты. Это непорядок. Давайте поступим следующим образом. Если через 18 секунд никто не ответит на ваш звонок, вы получите скидку 450 фунтов. Я начинаю обратный отсчет — 18, 17, 16, 15…', 'Неужели такой премиальный бренд не может себе позволить нанять достаточное количество сотрудников в службу поддержки? Из тех, кто читает этот текст есть кто-нибудь, кто жил в другой стране и звонил в местную службу поддержки Apple? Мне очень интересно — неужели в США, в Германии, во Франции или в Великобритании тоже ждут по полчаса ответа оператора?');

-- --------------------------------------------------------

--
-- Структура таблицы `text`
--

CREATE TABLE IF NOT EXISTS `text` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `text` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `usr_id` int(11) NOT NULL AUTO_INCREMENT,
  `usr_login` varchar(128) NOT NULL,
  `usr_password` varchar(128) NOT NULL,
  `usr_name` varchar(50) NOT NULL,
  `usr_surname` varchar(50) NOT NULL,
  `usr_middle_name` varchar(50) DEFAULT NULL,
  `usr_passport_series` varchar(4) DEFAULT NULL,
  `usr_passport_number` varchar(6) DEFAULT NULL,
  `usr_output` varchar(255) DEFAULT NULL,
  `usr_output_date` varchar(20) DEFAULT NULL,
  `usr_unit_code` varchar(7) DEFAULT NULL,
  `usr_phone_number` varchar(20) DEFAULT NULL,
  `usr_email` varchar(128) NOT NULL,
  `usr_qiwi` varchar(20) DEFAULT NULL,
  `usr_yandex` varchar(20) DEFAULT NULL,
  `usr_webmoney` varchar(13) DEFAULT NULL,
  `usr_card` varchar(20) DEFAULT NULL,
  `usr_rol_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`usr_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`usr_id`, `usr_login`, `usr_password`, `usr_name`, `usr_surname`, `usr_middle_name`, `usr_passport_series`, `usr_passport_number`, `usr_output`, `usr_output_date`, `usr_unit_code`, `usr_phone_number`, `usr_email`, `usr_qiwi`, `usr_yandex`, `usr_webmoney`, `usr_card`, `usr_rol_id`) VALUES
(1, 'root', '85676905d35fb12da70e8cb8bc8cebb0', 'Иван', 'Иванов', '', '', '', '', '11.11.1111', '', '', 'beatbox787@gmail.com', '', '', '', '', 1),
(3, 'admin', 'eaaba36a95aedcfd1c21a0d011e12ecd', 'Петр', 'Петров', 'Петрович', NULL, NULL, NULL, NULL, NULL, NULL, 'asdas@asdasd.ru', NULL, NULL, NULL, NULL, 2);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
