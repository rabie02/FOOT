-- phpMyAdmin SQL Dump
-- version 5.1.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 05, 2023 at 05:41 PM
-- Server version: 5.7.24
-- PHP Version: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `urbain_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `adminn`
--

CREATE TABLE `adminn` (
  `id_ad` int(11) NOT NULL,
  `firstname_ad` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `email` varchar(80) NOT NULL,
  `password` varchar(255) NOT NULL,
  `telephone` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `adminn`
--

INSERT INTO `adminn` (`id_ad`, `firstname_ad`, `lastname`, `email`, `password`, `telephone`) VALUES
(1, 'ahmed', 'admin', 'admin@admin.com', '123', '000'),
(2, 'yazid', 'admin', 'yazid@admin.com', '1212', '000');

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

CREATE TABLE `client` (
  `id` int(11) NOT NULL,
  `firstname` varchar(20) DEFAULT NULL,
  `lastname` varchar(20) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(20) DEFAULT NULL,
  `telephone` decimal(10,0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`id`, `firstname`, `lastname`, `email`, `password`, `telephone`) VALUES
(43, 'ahmed', 'ad', 'ahmed@admin.com', '123', '655495342'),
(44, 'ahmed', 'adnane', 'shotgun0644@gmail.com', '123', '666117017'),
(45, 'ahmed', 'ad', 'ahmed@a.fr', '000', '0'),
(46, 'test', 'karim', 'karim@gmail.com', '000', '0'),
(47, 'ahmed', 'ad', 'ahmed@admin.comss', '000', '0');

-- --------------------------------------------------------

--
-- Table structure for table `commande`
--

CREATE TABLE `commande` (
  `id_commande` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `adresse` varchar(255) NOT NULL,
  `ville` varchar(255) NOT NULL,
  `code_postal` varchar(10) NOT NULL,
  `produits` text NOT NULL,
  `id` int(11) DEFAULT NULL,
  `paiement` varchar(50) NOT NULL,
  `date_commande` date DEFAULT NULL,
  `heure_commande` time DEFAULT NULL,
  `etat_commande` varchar(20) NOT NULL DEFAULT 'en cours'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `commande`
--

INSERT INTO `commande` (`id_commande`, `nom`, `adresse`, `ville`, `code_postal`, `produits`, `id`, `paiement`, `date_commande`, `heure_commande`, `etat_commande`) VALUES
(41, 'ahmed', '20', 'sale test', '44000', '{\"77\":1,\"76\":1}', 43, 'paiement a la livraison', '2023-07-09', '19:32:43', 'Confirme'),
(42, 'ahmed', '20', 'sale test', '44000', '{\"76\":1}', 43, 'paiement a la livraison', '2023-07-13', '01:23:42', 'Confirme'),
(43, 'ahmed', '20', 'sale test', '44000', '{\"79\":1}', 43, 'paiement a la livraison', '2023-07-13', '01:27:45', 'Annule'),
(44, 'ahmed', '20', 'sale test', '44000', '{\"83\":1}', 43, 'paiement a la livraison', '2023-07-14', '19:30:41', 'Confirme'),
(45, 'ahmed', '20', 'sale test', '44000', '{\"87\":1}', 43, 'paypal', '2023-07-15', '00:17:49', 'Confirme');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `id_message` int(11) NOT NULL,
  `id_clt` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `message` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`id_message`, `id_clt`, `name`, `email`, `phone`, `message`) VALUES
(7, 43, 'ahmed ad', 'ahmed@admin.com', '666117017', 'dd\r\n'),
(8, 43, 'ahmed ad', 'ahmed@admin.com', '666117017', ''),
(9, 43, 'ahmed ad', 'ahmed@admin.com', '666117017', 'gvyhuodsjfesiuydbfursiuyduijff'),
(10, 43, 'f', 'e', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id_product` int(11) NOT NULL,
  `nom_produit` varchar(50) NOT NULL,
  `prix` float NOT NULL,
  `photo` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `category` varchar(50) DEFAULT NULL,
  `type` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id_product`, `nom_produit`, `prix`, `photo`, `description`, `category`, `type`) VALUES
(76, 'BALLON CHAMPIONS LEAGUE', 1900, '14.jpg', 'ballon champions league 2023', 'adultes', 'ballon'),
(77, 'Ballon paris', 200, '1.jpg', 'ballon paris saint germain entrainnement', 'adultes', 'ballon'),
(78, 'ballon nike', 350, '2.jpg', 'ballon nike originale 2022', 'adultes', 'ballon'),
(79, 'ballon mondiale', 2500, '3.jpeg', 'ballon mondiale al hilm 2022', 'adultes', 'ballon'),
(80, 'gant de gardien', 250, '6.jpg', 'gant de gardien kipsta ', 'adultes', 'gant'),
(81, 'chaussures de foot', 500, '11.jpeg', 'Chaussures De Foot nike original pro', 'adultes', 'chaussure'),
(82, 'spadrille', 150, '10.jpg', 'spadrille enfant', 'enfants', 'chaussure'),
(83, 'spadrille ', 150, '9.jpg', 'spadrille fille ', 'enfants', 'chaussure'),
(84, 'chaussettes', 30, '8.jpg', 'chaussettes mini ', 'adultes', 'chaussure'),
(85, 'short de foot', 150, '7.jpg', 'short de foot original', 'adultes', 'tenue'),
(87, 'filet de foot', 100, '4.jpg', 'filet de foot a 4 ', 'adultes', 'autre'),
(88, 'chaussures de foot', 500, '5.jpg', 'Chaussures De Foot adidas original pro', 'adultes', 'chaussure');

-- --------------------------------------------------------

--
-- Table structure for table `reservation`
--

CREATE TABLE `reservation` (
  `id_reservation` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `type` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `time` varchar(255) NOT NULL,
  `id_clt` int(11) NOT NULL,
  `etat_reservation` varchar(20) NOT NULL DEFAULT 'en cours'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `reservation`
--

INSERT INTO `reservation` (`id_reservation`, `name`, `email`, `phone`, `type`, `date`, `time`, `id_clt`, `etat_reservation`) VALUES
(48, 'ahmed ad', 'ahmed@admin.com', '655495342', 'foot 7', '2023-07-14', '20', 43, 'valider'),
(49, 'ahmed ad', 'ahmed@admin.com', '655495342', 'foot 7', '2023-07-10', '20', 43, 'annule'),
(50, 'ahmed ad', 'ahmed@admin.com', '655495342', 'foot 7', '2023-07-10', '21', 43, 'valider'),
(51, 'ahmed ad', 'ahmed@admin.com', '655495342', 'foot 9', '2023-07-14', '04', 43, 'en cours'),
(52, 'ahmed ad', 'ahmed@admin.com', '655495342', 'foot 9', '2023-07-22', '13', 43, 'en cours'),
(53, 'ahmed ad', 'ahmed@admin.com', '655495342', 'foot 9', '2023-07-22', '08', 43, 'en cours');

-- --------------------------------------------------------

--
-- Table structure for table `terrain`
--

CREATE TABLE `terrain` (
  `id_terrain` int(11) NOT NULL,
  `type` varchar(50) NOT NULL,
  `disponibilite` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `terrain`
--

INSERT INTO `terrain` (`id_terrain`, `type`, `disponibilite`) VALUES
(1, 'foot 5', 'disponible'),
(2, 'foot 7', 'disponible'),
(3, 'foot 9', 'disponible'),
(4, 'foot 11', 'disponible');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `adminn`
--
ALTER TABLE `adminn`
  ADD PRIMARY KEY (`id_ad`);

--
-- Indexes for table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `commande`
--
ALTER TABLE `commande`
  ADD PRIMARY KEY (`id_commande`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id_message`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id_product`);

--
-- Indexes for table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`id_reservation`);

--
-- Indexes for table `terrain`
--
ALTER TABLE `terrain`
  ADD PRIMARY KEY (`id_terrain`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `adminn`
--
ALTER TABLE `adminn`
  MODIFY `id_ad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `client`
--
ALTER TABLE `client`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `commande`
--
ALTER TABLE `commande`
  MODIFY `id_commande` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id_message` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id_product` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- AUTO_INCREMENT for table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `id_reservation` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `terrain`
--
ALTER TABLE `terrain`
  MODIFY `id_terrain` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
