-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 31, 2019 at 02:14 PM
-- Server version: 5.6.43
-- PHP Version: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rush00`
--
CREATE DATABASE IF NOT EXISTS `rush00` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `rush00`;

-- --------------------------------------------------------

--
-- Table structure for table `command`
--

CREATE TABLE IF NOT EXISTS `command` (
  `id_command` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `date_command` varchar(50) NOT NULL,
  `price_command` float NOT NULL,
  `status` varchar(50) NOT NULL,
  PRIMARY KEY (`id_command`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE IF NOT EXISTS `item` (
  `id_item` int(11) NOT NULL AUTO_INCREMENT,
  `link_img` varchar(300) NOT NULL,
  `type_id` int(11) NOT NULL,
  `season` varchar(20) NOT NULL,
  `name_item` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `price` float NOT NULL,
  `stock` int(10) NOT NULL,
  PRIMARY KEY (`id_item`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`id_item`, `link_img`, `type_id`, `season`, `name_item`, `description`, `price`, `stock`) VALUES
(19, 'https://image.flaticon.com/icons/svg/1193/1193959.svg', 2, 'hiver ', 'Artichaut', 'Un légume pas très bon à manger mais bon pour la santé', 5.99, 56),
(20, 'https://image.flaticon.com/icons/svg/1577/1577346.svg', 2, 'ete ', 'Poivron Rouge', 'Facile à cuisiner, il viendra relever le goût de vos plats !', 3.2, 260),
(21, 'https://image.flaticon.com/icons/svg/1581/1581804.svg', 2, 'hiver', 'Céleri', 'Askip c\'est bon d\'après le chef, mais faut le cuire dans une sauce tomate, ça croque un peu', 3, 10),
(22, 'https://image.flaticon.com/icons/svg/700/700844.svg', 2, 'hiver ', 'Courgette', 'Une petite courge', 4.5, 60),
(23, 'https://image.flaticon.com/icons/svg/135/135695.svg', 1, 'printemps ', 'Cerises', 'Un fruit plutôt printanier ', 8, 500),
(24, 'https://image.flaticon.com/icons/svg/135/135717.svg', 1, 'printemps ', 'Fraises', 'Un fruit très bon en salade.', 4, 150),
(25, 'https://image.flaticon.com/icons/svg/135/135620.svg', 1, 'hiver ', 'Orange', 'Un bon fruit pour faire du jus', 2, 300);

-- --------------------------------------------------------

--
-- Table structure for table `item_order`
--

CREATE TABLE IF NOT EXISTS `item_order` (
  `id_item` int(11) NOT NULL,
  `id_order` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  KEY `id_order` (`id_order`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `type`
--

CREATE TABLE IF NOT EXISTS `type` (
  `id_type` int(11) NOT NULL AUTO_INCREMENT,
  `name_type` varchar(255) NOT NULL,
  PRIMARY KEY (`id_type`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `type`
--

INSERT INTO `type` (`id_type`, `name_type`) VALUES
(1, 'fruit'),
(2, 'legume');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id_user` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `lastname` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `birthday` varchar(10) NOT NULL,
  `email` varchar(320) CHARACTER SET ascii NOT NULL,
  `phone` int(10) NOT NULL,
  `address` varchar(300) NOT NULL,
  `city` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `postal` int(5) NOT NULL,
  `password` varchar(512) NOT NULL,
  `admin` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `lastname`, `firstname`, `birthday`, `email`, `phone`, `address`, `city`, `country`, `postal`, `password`, `admin`) VALUES
(12, 'root', 'root', '2019-03-30', 'root@root.fr', 123456789, '96 bd bessieres', 'paris', 'france', 75018, '4e0658d00f47d86d19a0e792e4bb94b16db2e902d307da5637f57cf60e7a174cb4bb6d7095621745b2065df0c87b77af69f5d0fbd63359ad3cc6b72f076c3e1e', 1);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `item_order`
--
ALTER TABLE `item_order`
  ADD CONSTRAINT `item_order_ibfk_1` FOREIGN KEY (`id_order`) REFERENCES `command` (`id_command`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
