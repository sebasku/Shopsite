-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 25, 2021 at 03:08 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `s.kulaga`
--

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `id` int(11) NOT NULL,
  `username` varchar(25) NOT NULL,
  `email` varchar(255) NOT NULL,
  `role` enum('Moderator','Admin') NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`id`, `username`, `email`, `role`, `password`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'mail@mail.com', 'Admin', '21232f297a57a5a743894a0e4a801fc3', '2020-03-29 18:03:00', '2020-05-01 19:33:52'),
(3, 'moderator', 'mail@mail.pl', 'Moderator', '0408f3c997f309c03b08bf3a4bc7b730', '2020-03-29 18:05:00', '2021-01-25 09:14:41');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `employee_id` int(11) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `isWoman` tinyint(1) DEFAULT NULL,
  `image` varchar(255) NOT NULL,
  `descr` text NOT NULL,
  `cost` int(5) NOT NULL,
  `quantity` int(5) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `type_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `employee_id`, `name`, `isWoman`, `image`, `descr`, `cost`, `quantity`, `created_at`, `updated_at`, `type_id`) VALUES
(1, 3, 'Koszula z bawe??ny egipskiej i lnu', 0, 'img1.jpg', 'Koszula o dopasowanym fasonie uszyta z wysokiej jako??ci, g??adkiej tkaniny. bawe??na egipska to bawe??na o d??u??szym i mocniejszym w????knie, co sprawia, ??e wykonane z niej materia??y s?? delikatne, mi??kkie i wytrzyma??e. Jest zbierana r??cznie, co pozwala na wyselekcjonowanie najbardziej dojrza??ych surowc??w.', 129, 3, '2018-02-03 05:58:02', '2021-01-24 16:49:22', 1),
(2, 1, 'Koszula z bawe??ny i lnu', 0, 'img1.jpg', 'Koszula o regularnym fasonie uszyta z g??adkiej tkaniny z bawe??ny i lnu.', 89, 2, '2020-03-31 22:29:58', '2021-01-24 17:04:59', 1),
(3, 1, 'Koszula ze st??jk??', 0, 'img1.jpg', 'Koszula o regularnym fasonie uszyta z g??adkiej tkaniny z domieszk?? lnu.', 99, 4, '2020-03-31 22:31:22', '2021-01-24 17:04:59', 1),
(4, 1, 'G??adki T-shirt', 0, 'img1.jpg', 'T-shirt o regularnym kroju, z okr??g??ym dekoltem i kr??tkimi r??kawami, uszyty z mi??kkiej, g??adkiej dzianiny.', 39, 3, '2020-03-31 22:36:30', '2021-01-24 17:04:59', 2),
(5, 1, 'T-shirt z nadrukiem', 0, 'img1.jpg', 'T-shirt o regularnym kroju, z okr??g??ym dekoltem i kr??tkim r??kawem, uszyty z mi??kkiej dzianiny z nadrukiem na przodzie.', 39, 7, '2020-03-31 22:37:35', '2021-01-24 17:04:59', 2),
(6, 1, 'T-shirt z dzianiny pika', 0, 'img1.jpg', 'T-shirt o regularnym kroju, z okr??g??ym dekoltem i kr??tkim r??kawem, uszyty z mi??kkiej, g??adkiej dzianiny pika.', 49, 5, '2020-03-31 22:38:55', '2021-01-24 17:04:59', 2),
(7, 1, 'Klasyczny sweter z organicznej bawe??ny', 0, 'img1.jpg', 'Sweter o regularnym fasonie, z okr??g??ym dekoltem i d??ugimi r??kawami, z brzegami wyko??czonymi ??ci??gaczami, uszyty z dzianiny z klasycznym splotem.', 89, 5, '2020-03-31 22:44:48', '2021-01-24 17:04:59', 3),
(8, 1, 'Sweter z melan??owej dzianiny', 0, 'img1.jpg', 'Sweter o klasycznym fasonie, z okr??g??ym dekoltem i d??ugimi r??kawami, z brzegami wyko??czonymi ??ci??gaczami, uszyty z dzianiny o regularnym splocie.', 139, 8, '2020-03-31 22:46:14', '2021-01-24 17:04:59', 3),
(9, 1, 'Golf z pr????kowanej dzianiny', 0, 'img1.jpg', 'Sweter o dopasowanym fasonie, z wywijanym golfem i d??ugimi prostymi r??kawami, ze ??ci??gaczem przy dekolcie, uszyty z mi??kkiej dzianiny.', 79, 8, '2020-03-31 22:47:34', '2021-01-24 17:04:59', 3),
(10, 1, 'Bluza ze strukturalnym wzorem', 0, 'img1.jpg', 'Bluza o swobodnym kroju, z szerokim kapturem z trokami i obni??on?? lini?? ramion, uszyty ze strukturalnej dzianiny.', 139, 9, '2020-03-31 22:49:14', '2021-01-24 17:04:59', 4),
(11, 1, 'Rozpinana bluza z bawe??ny organicznej', 0, 'img1.jpg', 'Rozpinana bluza o regularnym kroju, z kapturem z trokami, zapinana na zamek i z otwartymi kieszeniami bocznymi, a uszyta zosta??a g??adkiej, mi??kkiej dzianiny.', 129, 1, '2020-03-31 22:51:27', '2021-01-24 17:04:59', 4),
(12, 1, 'G??adka bluza z bawe??n?? organiczn??', 0, 'img1.jpg', 'Bluza o swobodnym kroju, z szerokim kapturem z trokami i d??ugimi r??kawami z obni??on?? lini?? ramion, a tak??e z kieszeni?? kangurk?? na przodzie, uszyta z g??adkiej, mi??kkiej dzianiny.', 89, 2, '2020-03-31 22:53:26', '2021-01-24 17:04:59', 4),
(13, 1, 'Chinosy ze strukturalnej tkaniny', 0, 'img1.jpg', 'Spodnie chino, zapinane na suwak i guzik, z d??ugimi i dopasowanymi nogawkami, o bardzo dopasowanym fasonie, uszyte ze strukturalnej bawe??nianej tkaniny.', 129, 6, '2020-03-31 22:55:51', '2021-01-24 17:04:59', 5),
(14, 1, 'Spodnie z efektem nieregularnego sprania', 0, 'img1.jpg', 'Spodnie o regularnym fasonie carrot, zapinane na metalowy suwak i guzik, ze swobodnymi nogawkami zw????anymi u do??u, uszyte z tkaniny o sko??nym splocie z efektem nieregularnego sprania.', 169, 4, '2020-03-31 22:56:56', '2021-01-24 17:04:59', 5),
(15, 1, 'Bawe??niane spodnie slim', 0, 'img1.jpg', 'Spodnie o dopasowanym fasonie, zapinane na suwak i guzik, o d??ugich dopasowanych nogawkaach, uszyte z bawe??nianej, g??adkiej tkaniny.', 89, 7, '2020-03-31 22:58:31', '2021-01-24 17:04:59', 5),
(16, 1, 'Spodnie jeansowe slim', 0, 'img1.jpg', 'Spodnie jeansowe, zapinane na suwak i guzik, z d??ugimi i dopasowanymi nogawkami, o stonowanym fasonie, uszyte z denimu w kilku wersjach kolorystycznych.', 99, 1, '2020-03-31 23:06:58', '2021-01-24 17:04:59', 6),
(17, 1, 'Jeansowe ogrodniczki carrot regular', 0, 'img1.jpg', 'Ogrodniczki jeansowe, z regulacj?? d??ugo??ci szelek, zapi??ciami na metalowe guziki po bokach i naszywanymi kieszeniami z ty??u, o regularnym fasonie carrot, uszyte z denimu w klasycznym, niebieskim kolorze.', 199, 2, '2020-03-31 23:08:26', '2021-01-24 17:04:59', 6),
(18, 1, 'Jeansy z bawe??ny organicznej', 0, 'img1.jpg', 'Spodnie jeansowe, z zapi??ciem na suwak i guzik i d??ugimi nogawkami, kt??re delikatnie zw????aj?? si?? u do??u, o regularnym kroju, uszyte z denimu z efektem sprania.', 129, 4, '2020-03-31 23:09:38', '2021-01-24 17:04:59', 6),
(19, 1, 'Koszula z marszczonymi ramionami', 1, 'img1.jpg', 'Koszula o swobodnym fasonie uszyta z przyjemnej w dotyku tkaniny ze strukturalnym wzorem.', 129, 2, '2018-02-02 09:40:14', '2021-01-24 17:04:59', 1),
(20, 3, 'Koszula z kieszeniami', 1, 'img1.jpg', 'Koszula o swobodnym fasonie, z klasycznym ko??nierzykiem i zapi??ciem na guziki z przodu, naszywan?? kieszeni?? piersiow??, uszyta z przyjemnej w dotyku tkaniny z wiskozy.', 99, 4, '2020-04-01 10:44:18', '2021-01-24 17:04:59', 1),
(21, 3, 'D??uga koszula z paskiem', 1, 'img1.jpg', 'Koszula o swobodnym, przed??u??onym fasonie, z bufiastymi r??kawami i mankietami zapinanymi na guzik, z paskiem na talii, klasycznym ko??nierzem i zapi??ciem na guzik na przodzie, wykonana z bawe??nianej tkaniny z dodatkiem elastycznych w????kien.', 139, 9, '2020-04-01 10:46:13', '2021-01-24 17:04:59', 1),
(22, 3, 'Wiskozowy T-shirt', 1, 'img1.jpg', 'T-shirt o dopasowanym kroju, z p????okr??g??ym dekoltem z przodu i g????bokim dekoltem na plecach, r??kawy o d??ugo??ci do ??okcia, uszyty z mi??kkiej, elastycznej dzianiny.', 29, 10, '2020-04-01 10:59:18', '2021-01-24 17:04:59', 2),
(23, 3, 'T-shirt z dekoltem V', 1, 'img1.jpg', 'T-shirt o regularnym kroju, z dekoltem w kszta??cie V i kr??tkimi r??kawami, uszyty z mi??kkiej, g??adkiej dzianiny.', 39, 14, '2020-04-01 11:03:31', '2021-01-24 17:04:59', 2),
(24, 3, 'T-shirt basic', 1, 'img1.jpg', 'T-shirt o swobodnym fasonie, z p????okr??g??ym dekoltem i kr??tkimi r??kawami, uszyty z g??adkiej dzianiny.', 59, 13, '2020-04-01 11:04:44', '2021-01-24 17:04:59', 2),
(25, 3, 'Sweter z dekoltem V', 1, 'img1.jpg', 'Sweter o swobodnym fasonie, z dekoltem w kszta??cie V i obni??on?? lini?? ramion, uszyty z dzianiny o regularnym splocie.', 79, 8, '2020-04-01 11:07:00', '2021-01-24 17:04:59', 3),
(26, 3, 'A??urowy sweter', 1, 'img1.jpg', 'Sweter o dopasowanym fasonie, z zabudowanym dekoltem z p????golfem i d??ugimi r??kawami z koronkow?? wstawk??, uszyty z dzianiny z a??urowym wzorem.', 99, 13, '2020-04-01 11:08:39', '2021-01-24 17:04:59', 3),
(27, 3, 'Lekki kardigan', 1, 'img1.jpg', 'Lekki kardigan o swobodnym fasonie, z d??ugimi szerokimi r??kawami i obni??on?? lini?? ramion, uszyty z dzianiny.', 69, 8, '2020-04-01 11:09:53', '2021-01-24 17:04:59', 3),
(28, 3, 'Bluza The Beatles', 1, 'img1.jpg', 'Bluza o swobodnym fasonie, z p????okr??g??ym dekoltem i obni??on?? lini?? ramion, uszyta z dzianiny z nadrukiem zespo??u The Beatles.', 99, 15, '2020-04-01 11:13:12', '2021-01-24 17:04:59', 4),
(29, 3, 'Bluza oversize z nadrukiem', 1, 'img1.jpg', 'Bluza o swobodnym kroju, z okr??g??ym dekoltem i d??ugimi r??kawami i obni??on?? lini?? ramion, uszyta z bawe??nianej dzianiny z grafik?? na przodzie.', 99, 10, '2020-04-01 11:15:05', '2021-01-24 17:04:59', 4),
(30, 3, 'Bluza Tom & Jerry', 1, 'img1.jpg', 'Bluza o swobodnym fasonie, z kapturem z troczkami i d??ugimi r??kawami z obni??on?? lini?? ramion, uszyta z dzianiny z nadrukiem z kresk??wki na przodzie.', 99, 4, '2020-04-01 11:16:20', '2021-01-24 17:04:59', 4),
(31, 3, 'Spodnie kuloty', 1, 'img1.jpg', 'Spodnie typu culotte, o wysokim stanie i zapi??ciu na kryty zamek, z szerokimi nogawkami i zaznaczonym kantem.', 99, 5, '2020-04-01 11:18:39', '2021-01-24 17:04:59', 5),
(32, 3, 'Spodnie z elastyczn?? tali??', 1, 'img1.jpg', 'Spodnie o swobodnym fasonie, o elastycznej talii z troczkami i nogawkami z zaznaczonym kantem, uszyte z tkaniny ze wzorem.', 89, 7, '2020-04-01 11:20:02', '2021-01-24 17:04:59', 5),
(33, 3, 'Spodnie z paskiem', 1, 'img1.jpg', 'Spodnie typu paperbag, o elastycznej talii i wi??zaniu na dodatkowy pasek, z dopasowanymi, podwini??tymi nogawkami 7/8, uszyte z elastycznej dzianiny.', 79, 3, '2020-04-01 11:21:25', '2021-01-24 17:04:59', 5),
(34, 1, 'Jeansy slim', 1, 'img1.jpg', 'Jeansy o dopasowanym fasonie, ze zw????anymi nogawkami i zapi??ciem na guzik i zamek, maj?? pi???? kieszeni i guziki przy nogawkach, uszyte s?? z bawe??ny z domieszk?? elastycznych w????kien.', 99, 6, '2020-04-01 11:23:57', '2021-01-24 17:04:59', 6),
(35, 1, 'Jeansy z kieszeniami cargo', 1, 'img1.jpg', 'Jeansy o swobodnym fasonie, z prostymi nogawkami i zapi??ciem na zamek i guzik, maj?? dwie kieszenie typu cargo na nogawkach, uszyte z mieszanki bawe??ny, lnu i lyocellu.', 119, 6, '2020-04-01 11:25:46', '2021-01-24 17:04:59', 6),
(36, 1, 'Jeansy boyfriend', 1, 'img1.jpg', 'Jeansy typu boyfriend slim, z zapi??ciem na zamek i guzik, z pi??cioma kieszeniami, uszyte w 100% z bawe??ny i maj?? efekt sprania.', 119, 3, '2020-04-01 11:27:25', '2021-01-24 17:04:59', 6);

-- --------------------------------------------------------

--
-- Table structure for table `product_type`
--

CREATE TABLE `product_type` (
  `id` int(11) NOT NULL,
  `product_type` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product_type`
--

INSERT INTO `product_type` (`id`, `product_type`) VALUES
(1, 'shirts'),
(2, 't-shirts'),
(3, 'sweaters'),
(4, 'hoodies'),
(5, 'trousers'),
(6, 'jeans');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(25) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `created_at`, `updated_at`) VALUES
(1, 'user', 'mail@mail.com', 'ee11cbb19052e40b07aac0ca060c23ee', '2020-03-29 18:04:00', '2020-05-04 22:19:20'),
(2, 'test1', 'test@mail.xdxd', '7815696ecbf1c96e6894b779456d330e', '2021-01-24 18:28:25', '2021-01-25 09:07:08'),
(5, 'user123', 'sdasd2@mail.pl', '6ad14ba9986e3615423dfca256d04e3f', '2021-01-25 13:11:06', '2021-01-25 13:11:06');

-- --------------------------------------------------------

--
-- Table structure for table `user_cart`
--

CREATE TABLE `user_cart` (
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_quantity` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `id_2` (`id`),
  ADD UNIQUE KEY `id_3` (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `employee_id` (`employee_id`),
  ADD KEY `type_id` (`type_id`);

--
-- Indexes for table `product_type`
--
ALTER TABLE `product_type`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `user_cart`
--
ALTER TABLE `user_cart`
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `product_type`
--
ALTER TABLE `product_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`employee_id`) REFERENCES `employee` (`id`),
  ADD CONSTRAINT `products_ibfk_2` FOREIGN KEY (`type_id`) REFERENCES `product_type` (`id`);

--
-- Constraints for table `user_cart`
--
ALTER TABLE `user_cart`
  ADD CONSTRAINT `user_cart_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `user_cart_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
