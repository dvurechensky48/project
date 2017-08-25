-- phpMyAdmin SQL Dump
-- version 4.0.10.20
-- https://www.phpmyadmin.net
--
-- Хост: 10.100.18.66:3306
-- Время создания: Авг 25 2017 г., 13:27
-- Версия сервера: 10.1.21-MariaDB
-- Версия PHP: 5.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `repairs`
--

-- --------------------------------------------------------

--
-- Структура таблицы `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(150) NOT NULL,
  `pass` varchar(500) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `admin`
--

INSERT INTO `admin` (`id`, `login`, `pass`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3');

-- --------------------------------------------------------

--
-- Структура таблицы `client`
--

CREATE TABLE IF NOT EXISTS `client` (
  `id_client` int(11) NOT NULL AUTO_INCREMENT,
  `client_name` varchar(100) NOT NULL,
  `client_phone` varchar(20) NOT NULL,
  PRIMARY KEY (`id_client`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=83 ;

--
-- Дамп данных таблицы `client`
--

INSERT INTO `client` (`id_client`, `client_name`, `client_phone`) VALUES
(79, 'Никита', '79513033355'),
(80, 'Василий', '79996665544'),
(81, 'Анна', '13124124'),
(82, 'Василий', '454545');

-- --------------------------------------------------------

--
-- Структура таблицы `photo`
--

CREATE TABLE IF NOT EXISTS `photo` (
  `id_photo` int(11) NOT NULL AUTO_INCREMENT,
  `id_request` int(11) NOT NULL,
  PRIMARY KEY (`id_photo`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=85 ;

--
-- Дамп данных таблицы `photo`
--

INSERT INTO `photo` (`id_photo`, `id_request`) VALUES
(81, 86);

-- --------------------------------------------------------

--
-- Структура таблицы `requests`
--

CREATE TABLE IF NOT EXISTS `requests` (
  `id_request` int(11) NOT NULL AUTO_INCREMENT,
  `id_client` int(11) NOT NULL,
  `application_name` varchar(1000) CHARACTER SET utf8 NOT NULL,
  `application_text` text CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id_request`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=90 ;

--
-- Дамп данных таблицы `requests`
--

INSERT INTO `requests` (`id_request`, `id_client`, `application_name`, `application_text`) VALUES
(86, 79, 'Сломался телефон', 'У меня сломался телефон');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
