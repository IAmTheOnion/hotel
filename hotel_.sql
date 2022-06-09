-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 09 Cze 2022, 21:20
-- Wersja serwera: 10.4.21-MariaDB
-- Wersja PHP: 7.4.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `hotel`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `books`
--

CREATE TABLE `books` (
  `id` int(11) NOT NULL,
  `room_num` varchar(4) NOT NULL,
  `arrival` date DEFAULT NULL,
  `departure` date DEFAULT NULL,
  `customer_id` int(3) NOT NULL,
  `promotion` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `books`
--

INSERT INTO `books` (`id`, `room_num`, `arrival`, `departure`, `customer_id`, `promotion`) VALUES
(1, '003', '2022-06-03', '2022-06-05', 1, 0),
(2, '008', '2022-06-17', '2022-06-19', 2, 0),
(3, '006', '2022-06-10', '2022-06-12', 3, 0),
(4, '001', '2022-06-10', '2022-06-12', 1, 0),
(5, '008', '2022-06-10', '2022-06-12', 1, 0),
(6, '007', '2022-06-10', '2022-06-12', 1, 0),
(7, '006', '2022-06-10', '2022-06-12', 1, 0);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `customers`
--

CREATE TABLE `customers` (
  `id` int(3) NOT NULL,
  `name` varchar(40) NOT NULL,
  `surname` varchar(40) NOT NULL,
  `telephone_num` varchar(12) NOT NULL,
  `email` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `customers`
--

INSERT INTO `customers` (`id`, `name`, `surname`, `telephone_num`, `email`) VALUES
(1, 'Kacper', 'Ołdziejewski', '123123123', 'kacper@gmail.com'),
(2, 'Kacper', 'Ołdziejewski', '321321321', 'kacper@gmail.com'),
(3, 'Kacper', 'Ołdziejewski', '696969699', 'kutas@hmail.com');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `rooms`
--

CREATE TABLE `rooms` (
  `room_num` varchar(3) NOT NULL,
  `room_tier` varchar(20) NOT NULL,
  `price` int(4) NOT NULL,
  `adults` int(1) NOT NULL,
  `kids` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `rooms`
--

INSERT INTO `rooms` (`room_num`, `room_tier`, `price`, `adults`, `kids`) VALUES
('001', 'economic', 700, 2, 3),
('002', 'economic', 700, 2, 3),
('003', 'economic', 700, 2, 3),
('004', 'economic', 700, 2, 3),
('005', 'economic', 700, 2, 3),
('006', 'economic', 700, 2, 3),
('007', 'economic', 700, 2, 3),
('008', 'economic', 700, 2, 3),
('009', 'economic', 2000, 5, 3),
('010', 'economic', 2000, 5, 3),
('101', 'lux', 2000, 2, 1),
('102', 'lux', 2000, 2, 1),
('103', 'lux', 2000, 2, 1),
('104', 'lux', 2000, 2, 1),
('105', 'lux', 2000, 2, 1),
('201', 'penthouse', 10000, 5, 3),
('202', 'penthouse', 10000, 5, 3),
('203', 'penthouse', 10000, 5, 3),
('204', 'penthouse', 10000, 5, 3),
('205', 'warmianin', 20000, 1, 1);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`room_num`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `books`
--
ALTER TABLE `books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT dla tabeli `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
