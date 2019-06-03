-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Июн 03 2019 г., 12:33
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
  `Email` varchar(50) DEFAULT NULL,
  `IsDelete` bit(1) NOT NULL DEFAULT b'0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `Client`
--

INSERT INTO `Client` (`ID_Client`, `FIO`, `Phone`, `Email`, `IsDelete`) VALUES
(1, 'Валерий Альбертович', '88005553535', 'pojiloi@mogila.com', b'0'),
(2, 'Зубенко Михаил', '8493848394', 'mafioznik@vorvzakone.com', b'0'),
(3, 'Озон Боярский', '80000000000', 'votetomenya@rashuyarilo.com', b'0'),
(4, 'Ержан Обезьянов', '83246737377', 'vstavaizaebal@narabotupora.com', b'0'),
(5, 'bbbbbbbbbbbbbbbbbbbbbbb', '55555555', 'wer@g.com', b'0'),
(6, 'kjhgfds', '435345', 'trik@rrtts.ittt', b'0'),
(7, 'reerererererer', '3333333333', 'dasdasd@gmaoi.com', b'0'),
(8, 'ppppppppppppppp', '0000000000000', 'syva1998@gmail.com', b'0'),
(9, 'jkjkjkjkjk', '777777', 'dasdasd@gmaoi.com', b'0');

-- --------------------------------------------------------

--
-- Структура таблицы `Deal`
--

CREATE TABLE `Deal` (
  `ID_Deal` int(11) NOT NULL,
  `Offer_ID` int(11) NOT NULL,
  `Need_ID` int(11) NOT NULL,
  `DateTimeDeal` datetime NOT NULL,
  `IsDelete` bit(1) NOT NULL DEFAULT b'0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `Deal`
--

INSERT INTO `Deal` (`ID_Deal`, `Offer_ID`, `Need_ID`, `DateTimeDeal`, `IsDelete`) VALUES
(1, 3, 1, '2019-06-11 09:11:33', b'0'),
(2, 1, 2, '2019-06-02 14:43:36', b'0'),
(4, 6, 2, '2019-06-06 12:01:00', b'0');

-- --------------------------------------------------------

--
-- Структура таблицы `Need`
--

CREATE TABLE `Need` (
  `ID_Need` int(11) NOT NULL,
  `Realtor_ID` int(11) NOT NULL,
  `Client_ID` int(11) NOT NULL,
  `TypeObj_ID` int(11) NOT NULL,
  `Address` varchar(50) DEFAULT NULL,
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
  `Status_ID` int(11) NOT NULL,
  `IsDelete` bit(1) NOT NULL DEFAULT b'0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `Need`
--

INSERT INTO `Need` (`ID_Need`, `Realtor_ID`, `Client_ID`, `TypeObj_ID`, `Address`, `MinPrice`, `MaxPrice`, `MinArea`, `MaxArea`, `MinKolvoRoom`, `MaxKolvoRoom`, `MinFloor`, `MaxFloor`, `MinNumFloors`, `MaxNumFloors`, `Status_ID`, `IsDelete`) VALUES
(1, 1, 1, 4, 'Любой', 432, 654, 5, 6, 54, 34, 77, 84, 12, 345, 1, b'0'),
(2, 2, 2, 3, 'ЗАчемстолькополей', 6546, 45666, 666, 4446, 56, 78, 67, 90, 1, 3, 2, b'0');

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
  `TypeObj_ID` int(11) NOT NULL,
  `IsDelete` bit(1) NOT NULL DEFAULT b'0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `ObjProperty`
--

INSERT INTO `ObjProperty` (`ID_ObjProperty`, `CoordX`, `CoordY`, `City`, `Street`, `NumHouse`, `NumApart`, `Floor`, `KolvoRoom`, `Area`, `NumFloors`, `TypeObj_ID`, `IsDelete`) VALUES
(1, 228, 227, 'Городок', 'Кожановская', '91', '19', 1, 228, 1000, 100, 2, b'0'),
(2, 676, 567, 'Загород', 'Студенческая', '48', '84', 2, 229, 2000, 200, 1, b'0'),
(3, 322, 321, 'Соло', 'Виковская', '32', '23', 3, 230, 3000, 300, 3, b'0'),
(4, 877, 687, 'Крута', 'Пиковская', '18', '81', 4, 231, 4000, 400, 4, b'0');

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
  `Status_ID` int(11) NOT NULL,
  `IsDelete` bit(1) NOT NULL DEFAULT b'0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `Offer`
--

INSERT INTO `Offer` (`ID_Offer`, `Realtor_ID`, `Client_ID`, `ObjProperty_ID`, `Price`, `Status_ID`, `IsDelete`) VALUES
(1, 1, 1, 1, 1, 1, b'0'),
(2, 2, 2, 2, 22, 2, b'0'),
(3, 3, 3, 3, 333, 1, b'0'),
(4, 4, 4, 4, 4444, 2, b'0'),
(6, 4, 9, 4, 3333, 1, b'0');

-- --------------------------------------------------------

--
-- Структура таблицы `Realtor`
--

CREATE TABLE `Realtor` (
  `ID_Realtor` int(11) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Password` varchar(50) NOT NULL,
  `FIO` varchar(255) NOT NULL,
  `CommissionShare` float DEFAULT NULL,
  `IsDelete` bit(1) NOT NULL DEFAULT b'0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `Realtor`
--

INSERT INTO `Realtor` (`ID_Realtor`, `Email`, `Password`, `FIO`, `CommissionShare`, `IsDelete`) VALUES
(1, 'pervii@gmail.com', '1', 'Первый Риелтор', 200, b'0'),
(2, 'vtoroii@gmail.com', '2', 'Второй Риелтор', 150, b'0'),
(3, 'tretii@gmail.com', '3', 'Третий Риелтор', 100, b'0'),
(4, 'chetvertii@gmail.com', '4', 'Четвертый Риелтор', 500, b'0');

-- --------------------------------------------------------

--
-- Структура таблицы `Status`
--

CREATE TABLE `Status` (
  `ID_Status` int(11) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `IsDelete` bit(1) NOT NULL DEFAULT b'0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `Status`
--

INSERT INTO `Status` (`ID_Status`, `Name`, `IsDelete`) VALUES
(1, 'Ждем-с', b'0'),
(2, 'Оке', b'0');

-- --------------------------------------------------------

--
-- Структура таблицы `TypeObj`
--

CREATE TABLE `TypeObj` (
  `ID_TypeObj` int(11) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `IsDelete` bit(1) NOT NULL DEFAULT b'0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `TypeObj`
--

INSERT INTO `TypeObj` (`ID_TypeObj`, `Name`, `IsDelete`) VALUES
(1, 'Дворец', b'0'),
(2, 'Вилла', b'0'),
(3, 'Замок', b'0'),
(4, 'Теремок', b'0');

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
  ADD KEY `Status_ID` (`Status_ID`),
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
  ADD KEY `Realtor_ID` (`Realtor_ID`),
  ADD KEY `Status_ID` (`Status_ID`);

--
-- Индексы таблицы `Realtor`
--
ALTER TABLE `Realtor`
  ADD PRIMARY KEY (`ID_Realtor`);

--
-- Индексы таблицы `Status`
--
ALTER TABLE `Status`
  ADD PRIMARY KEY (`ID_Status`);

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
  MODIFY `ID_Client` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT для таблицы `Deal`
--
ALTER TABLE `Deal`
  MODIFY `ID_Deal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `Need`
--
ALTER TABLE `Need`
  MODIFY `ID_Need` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `ObjProperty`
--
ALTER TABLE `ObjProperty`
  MODIFY `ID_ObjProperty` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT для таблицы `Offer`
--
ALTER TABLE `Offer`
  MODIFY `ID_Offer` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `Realtor`
--
ALTER TABLE `Realtor`
  MODIFY `ID_Realtor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `Status`
--
ALTER TABLE `Status`
  MODIFY `ID_Status` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `TypeObj`
--
ALTER TABLE `TypeObj`
  MODIFY `ID_TypeObj` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

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
  ADD CONSTRAINT `need_ibfk_3` FOREIGN KEY (`Status_ID`) REFERENCES `Status` (`ID_Status`),
  ADD CONSTRAINT `need_ibfk_4` FOREIGN KEY (`TypeObj_ID`) REFERENCES `TypeObj` (`ID_TypeObj`);

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
  ADD CONSTRAINT `offer_ibfk_3` FOREIGN KEY (`Realtor_ID`) REFERENCES `Realtor` (`ID_Realtor`),
  ADD CONSTRAINT `offer_ibfk_4` FOREIGN KEY (`Status_ID`) REFERENCES `Status` (`ID_Status`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
