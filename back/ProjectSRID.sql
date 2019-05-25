-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Май 25 2019 г., 14:38
-- Версия сервера: 5.7.20
-- Версия PHP: 7.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `ProjectSRID`
--

-- --------------------------------------------------------

--
-- Структура таблицы `Client`
--

CREATE TABLE `Client` (
  `ID_Client` int(11) NOT NULL,
  `FIO` varchar(255) DEFAULT NULL,
  `Phone` varchar(50) DEFAULT NULL,
  `Email` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `Client`
--

INSERT INTO `Client` (`ID_Client`, `FIO`, `Phone`, `Email`) VALUES
(1, 'gnome', '123456', 'gonme@gmail.com');

-- --------------------------------------------------------

--
-- Структура таблицы `Deal`
--

CREATE TABLE `Deal` (
  `ID_Deal` int(11) NOT NULL,
  `Offer_ID` int(11) NOT NULL,
  `Need_ID` int(11) NOT NULL,
  `DateTimeDeal` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `Need`
--

CREATE TABLE `Need` (
  `ID_Need` int(11) NOT NULL,
  `Realtor_ID` int(11) NOT NULL,
  `Client_ID` int(11) NOT NULL,
  `TypeObj_ID` int(11) NOT NULL,
  `Adress` varchar(50) DEFAULT NULL,
  `MinPrice` float DEFAULT NULL,
  `MaxPrice` float DEFAULT NULL,
  `MinArea` float DEFAULT NULL,
  `MaxArea` float DEFAULT NULL,
  `MinKolvoRoom` int(11) DEFAULT NULL,
  `MaxKolvoRoom` int(11) DEFAULT NULL,
  `MinFloor` int(11) DEFAULT NULL,
  `MaxFloor` int(11) DEFAULT NULL,
  `MinNumFloors` int(11) DEFAULT NULL,
  `MaxNumFloors` int(11) DEFAULT NULL,
  `Status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `ObjProperty`
--

CREATE TABLE `ObjProperty` (
  `ID_ObjProperty` int(11) NOT NULL,
  `CoordX` float DEFAULT NULL,
  `CoordY` float DEFAULT NULL,
  `City` varchar(50) DEFAULT NULL,
  `Street` varchar(50) DEFAULT NULL,
  `NumHouse` varchar(50) DEFAULT NULL,
  `NumApart` varchar(50) DEFAULT NULL,
  `Floor` int(11) DEFAULT NULL,
  `KolvoRoom` int(11) DEFAULT NULL,
  `Area` float DEFAULT NULL,
  `NumFloors` int(11) DEFAULT NULL,
  `TypeObj_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `Offer`
--

CREATE TABLE `Offer` (
  `ID_Offer` int(11) NOT NULL,
  `Realtor_ID` int(11) NOT NULL,
  `Client_ID` int(11) NOT NULL,
  `ObjProperty_ID` int(11) NOT NULL,
  `Price` float NOT NULL,
  `Status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `Realtor`
--

CREATE TABLE `Realtor` (
  `ID_Realtor` int(11) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Password` varchar(50) NOT NULL,
  `FIO` varchar(255) NOT NULL,
  `CommissionSare` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `TypeObj`
--

CREATE TABLE `TypeObj` (
  `ID_TypeObj` int(11) NOT NULL,
  `Name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `Client`
--
ALTER TABLE `Client`
  ADD PRIMARY KEY (`ID_Client`);

--
-- Индексы таблицы `Deal`
--
ALTER TABLE `Deal`
  ADD PRIMARY KEY (`ID_Deal`),
  ADD KEY `Need_ID` (`Need_ID`),
  ADD KEY `Offer_ID` (`Offer_ID`);

--
-- Индексы таблицы `Need`
--
ALTER TABLE `Need`
  ADD PRIMARY KEY (`ID_Need`),
  ADD KEY `Client_ID` (`Client_ID`),
  ADD KEY `Realtor_ID` (`Realtor_ID`),
  ADD KEY `TypeObj_ID` (`TypeObj_ID`);

--
-- Индексы таблицы `ObjProperty`
--
ALTER TABLE `ObjProperty`
  ADD PRIMARY KEY (`ID_ObjProperty`),
  ADD KEY `TypeObj_ID` (`TypeObj_ID`);

--
-- Индексы таблицы `Offer`
--
ALTER TABLE `Offer`
  ADD PRIMARY KEY (`ID_Offer`),
  ADD KEY `Client_ID` (`Client_ID`),
  ADD KEY `ObjProperty_ID` (`ObjProperty_ID`),
  ADD KEY `Realtor_ID` (`Realtor_ID`);

--
-- Индексы таблицы `Realtor`
--
ALTER TABLE `Realtor`
  ADD PRIMARY KEY (`ID_Realtor`);

--
-- Индексы таблицы `TypeObj`
--
ALTER TABLE `TypeObj`
  ADD PRIMARY KEY (`ID_TypeObj`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `Client`
--
ALTER TABLE `Client`
  MODIFY `ID_Client` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `Deal`
--
ALTER TABLE `Deal`
  MODIFY `ID_Deal` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `Need`
--
ALTER TABLE `Need`
  MODIFY `ID_Need` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `ObjProperty`
--
ALTER TABLE `ObjProperty`
  MODIFY `ID_ObjProperty` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `Offer`
--
ALTER TABLE `Offer`
  MODIFY `ID_Offer` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `Realtor`
--
ALTER TABLE `Realtor`
  MODIFY `ID_Realtor` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `TypeObj`
--
ALTER TABLE `TypeObj`
  MODIFY `ID_TypeObj` int(11) NOT NULL AUTO_INCREMENT;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `Deal`
--
ALTER TABLE `Deal`
  ADD CONSTRAINT `deal_ibfk_1` FOREIGN KEY (`Need_ID`) REFERENCES `Need` (`ID_Need`),
  ADD CONSTRAINT `deal_ibfk_2` FOREIGN KEY (`Offer_ID`) REFERENCES `Offer` (`ID_Offer`);

--
-- Ограничения внешнего ключа таблицы `Need`
--
ALTER TABLE `Need`
  ADD CONSTRAINT `need_ibfk_1` FOREIGN KEY (`Client_ID`) REFERENCES `Client` (`ID_Client`),
  ADD CONSTRAINT `need_ibfk_2` FOREIGN KEY (`Realtor_ID`) REFERENCES `Realtor` (`ID_Realtor`),
  ADD CONSTRAINT `need_ibfk_3` FOREIGN KEY (`TypeObj_ID`) REFERENCES `TypeObj` (`ID_TypeObj`);

--
-- Ограничения внешнего ключа таблицы `ObjProperty`
--
ALTER TABLE `ObjProperty`
  ADD CONSTRAINT `objproperty_ibfk_1` FOREIGN KEY (`TypeObj_ID`) REFERENCES `TypeObj` (`ID_TypeObj`);

--
-- Ограничения внешнего ключа таблицы `Offer`
--
ALTER TABLE `Offer`
  ADD CONSTRAINT `offer_ibfk_1` FOREIGN KEY (`Client_ID`) REFERENCES `Client` (`ID_Client`),
  ADD CONSTRAINT `offer_ibfk_2` FOREIGN KEY (`ObjProperty_ID`) REFERENCES `ObjProperty` (`ID_ObjProperty`),
  ADD CONSTRAINT `offer_ibfk_3` FOREIGN KEY (`Realtor_ID`) REFERENCES `Realtor` (`ID_Realtor`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
