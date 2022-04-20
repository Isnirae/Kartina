-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mer. 05 mai 2021 à 14:38
-- Version du serveur :  5.7.31
-- Version de PHP : 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `kartina`
--

-- --------------------------------------------------------

--
-- Structure de la table `addresses`
--

DROP TABLE IF EXISTS `addresses`;
CREATE TABLE IF NOT EXISTS `addresses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Street` varchar(255) NOT NULL,
  `Number` varchar(4000) NOT NULL,
  `PostalCode` varchar(20) NOT NULL,
  `City` varchar(45) NOT NULL,
  `Country` varchar(45) NOT NULL,
  `User_id` int(11) NOT NULL,
  PRIMARY KEY (`id`,`User_id`),
  KEY `fk_Addresses_User1_idx` (`User_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `articles`
--

DROP TABLE IF EXISTS `articles`;
CREATE TABLE IF NOT EXISTS `articles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(45) NOT NULL,
  `Stock` int(11) NOT NULL DEFAULT '3000',
  `ImageUrl` varchar(100) DEFAULT NULL,
  `Tags` varchar(25) DEFAULT NULL,
  `Orientation` varchar(45) DEFAULT NULL,
  `Date` datetime NOT NULL,
  `FrDescription` varchar(4000) DEFAULT NULL,
  `EnDescription` varchar(4000) DEFAULT NULL,
  `GerDescription` varchar(4000) DEFAULT NULL,
  `Price` float NOT NULL,
  `Themes_id` int(11) NOT NULL,
  `User_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_Articles_Themes_idx` (`Themes_id`),
  KEY `fk_Articles_User1_idx` (`User_id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `articles`
--

INSERT INTO `articles` (`id`, `Name`, `Stock`, `ImageUrl`, `Tags`, `Orientation`, `Date`, `FrDescription`, `EnDescription`, `GerDescription`, `Price`, `Themes_id`, `User_id`) VALUES
(14, 'And there was light', 2500, '608684fbbb89c-and-there-was-light.jpg', NULL, '', '2021-04-26 00:00:00', 'Envol d\'un Ara bleu', 'Envol d\'un Ara bleu', 'Envol d\'un Ara bleu', 65, 4, 3),
(15, 'Big Mouth', 3000, '608687bd7fb29-big mouth.jpg', NULL, '', '2021-04-26 00:00:00', 'Le roi des animaux dans toute sa magnificence ', 'Le roi des animaux dans toute sa magnificence ', 'Le roi des animaux dans toute sa magnificence ', 59, 4, 3),
(16, 'Le gorille', 3000, '6086d99627cba-not-so-different.jpg', NULL, '', '2021-04-26 00:00:00', 'Voici une superbe image d\'un gorille', 'Voici une superbe image d\'un gorille', 'Voici une superbe image d\'un gorille', 156, 4, 3),
(17, 'Ebony and Ivory', 3000, '6087e0cd7e0b0-ebony-and-ivory.jpg', NULL, '', '2021-04-27 00:00:00', 'Cliché exceptionnel qu\'on ne prend qu\'une fois dans sa vie.', 'Cliché exceptionnel qu\'on ne prend qu\'une fois dans sa vie.', 'Cliché exceptionnel qu\'on ne prend qu\'une fois dans sa vie.', 130, 4, 3),
(18, 'Argnetique', 3000, '608813311d6bc-argentique.jpg', NULL, '', '2021-04-27 00:00:00', 'Rien ne vaut le charme de l\'argentique', 'Rien ne vaut le charme de l\'argentique', 'Rien ne vaut le charme de l\'argentique', 91, 3, 4),
(19, 'Vol au dessus des gratte-ciel', 3000, '608813b964edf-avion.jpg', NULL, '', '2021-04-27 00:00:00', 'La société moderne et le rêve des hommes d\'aller toujours plus haut.', 'La société moderne et le rêve des hommes d\'aller toujours plus haut.', 'La société moderne et le rêve des hommes d\'aller toujours plus haut.', 85, 3, 4),
(20, 'Le roi de la forêt', 3000, '608813fed9b93-cerf.jpg', NULL, '', '2021-04-27 00:00:00', 'Tout simplement majestueux.', 'Tout simplement majestueux.', 'Tout simplement majestueux.', 104, 4, 4),
(21, 'Waterfall', 3000, '6088147c2a113-chute d\'eau.jpg', NULL, '', '2021-04-27 00:00:00', 'Don\'t go chasing waterfalls\r\nPlease stick to the rivers and the lakes that you\'re used to\r\nI know that you\'re gonna have it your way or nothing at all\r\nBut I think you\'re moving too fast', 'Don\'t go chasing waterfalls\r\nPlease stick to the rivers and the lakes that you\'re used to\r\nI know that you\'re gonna have it your way or nothing at all\r\nBut I think you\'re moving too fast', 'Don\'t go chasing waterfalls\r\nPlease stick to the rivers and the lakes that you\'re used to\r\nI know that you\'re gonna have it your way or nothing at all\r\nBut I think you\'re moving too fast', 59, 3, 4),
(22, 'Freckles', 3000, '608814b77b6a0-rousse.jpg', NULL, '', '2021-04-27 00:00:00', 'Laissez-vous envouter ...', 'Laissez-vous envouter ...', 'Laissez-vous envouter ...', 195, 9, 4),
(23, 'La Dame de Fer', 3000, '60881573d96c1-tour eiffel.jpg', NULL, '', '2021-04-27 00:00:00', 'L\'une des 7 merveilles du monde. Enfin pas vraiment, mais on l\'aime quand même .', 'L\'une des 7 merveilles du monde. Enfin pas vraiment, mais on l\'aime quand même .', 'L\'une des 7 merveilles du monde. Enfin pas vraiment, mais on l\'aime quand même .', 85, 2, 4),
(24, 'Les merveilles de la nuit', 3000, '608816621dfce-lune.jpg', NULL, '', '2021-04-27 00:00:00', '&quot;La simple vision de cette merveille me transforme littéralement en une tout autre personne&quot;\r\n- Remus John Lupin', '&quot;La simple vision de cette merveille me transforme littéralement en une tout autre personne&quot;\r\n- Remus John Lupin', '&quot;La simple vision de cette merveille me transforme littéralement en une tout autre personne&quot;\r\n- Remus John Lupin', 124, 7, 4),
(25, 'La montagne, ça vous gagne', 3000, '60881477b6a0-montagne.jpg', NULL, '', '2021-04-27 00:00:00', '“Le silence de la montagne est encore plus beau lorsque les oiseaux se sont tus.”', '“Le silence de la montagne est encore plus beau lorsque les oiseaux se sont tus.”', '“Le silence de la montagne est encore plus beau lorsque les oiseaux se sont tus.”', 79, 6, 3);

-- --------------------------------------------------------

--
-- Structure de la table `finishes`
--

DROP TABLE IF EXISTS `finishes`;
CREATE TABLE IF NOT EXISTS `finishes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `FrName` varchar(60) DEFAULT NULL,
  `EnName` varchar(60) DEFAULT NULL,
  `GerName` varchar(60) DEFAULT NULL,
  `FrDescription` varchar(4000) DEFAULT NULL,
  `EnDescription` varchar(4000) DEFAULT NULL,
  `GerDescription` varchar(4000) DEFAULT NULL,
  `ImageUrl` varchar(200) DEFAULT NULL,
  `PercentagePriceChange` float NOT NULL,
  `Finishescol` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `finishes`
--

INSERT INTO `finishes` (`id`, `FrName`, `EnName`, `GerName`, `FrDescription`, `EnDescription`, `GerDescription`, `ImageUrl`, `PercentagePriceChange`, `Finishescol`) VALUES
(1, 'support passe partout noir', NULL, NULL, NULL, NULL, NULL, 'ARTSHOT.jpg', 120, NULL),
(2, 'support passe partout blanc', NULL, NULL, NULL, NULL, NULL, 'ARTSHOT.jpg', 120, NULL),
(3, 'support papier photo', NULL, NULL, NULL, NULL, NULL, 'PAPIER-PHOTO.jpg', 100, NULL),
(4, 'support aluminium verre', NULL, NULL, NULL, NULL, NULL, 'SUPPORT-ALUMINIUM-AVEC-VERRE-ACRYLIQUE.jpg', 115, NULL),
(5, 'support aluminium', NULL, NULL, NULL, NULL, NULL, 'SUPPORT-ALUMINIUM.jpg', 110, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `formats`
--

DROP TABLE IF EXISTS `formats`;
CREATE TABLE IF NOT EXISTS `formats` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `FrName` varchar(60) DEFAULT NULL,
  `EnName` varchar(60) DEFAULT NULL,
  `GerName` varchar(60) DEFAULT NULL,
  `Size` varchar(100) DEFAULT NULL,
  `ImageUrl` varchar(200) DEFAULT NULL,
  `Description` varchar(4000) DEFAULT NULL,
  `PercentagePriceChange` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `formats`
--

INSERT INTO `formats` (`id`, `FrName`, `EnName`, `GerName`, `Size`, `ImageUrl`, `Description`, `PercentagePriceChange`) VALUES
(1, 'Classique', NULL, NULL, '24 x 30 cm', NULL, NULL, '1'),
(2, 'Grand', NULL, NULL, '60 x 75 cm	', NULL, NULL, '2'),
(3, 'Géant', NULL, NULL, '100 x 125 cm	', NULL, NULL, '4'),
(4, 'Collector', NULL, NULL, '120 x 150 cm	', NULL, NULL, '10');

-- --------------------------------------------------------

--
-- Structure de la table `frames`
--

DROP TABLE IF EXISTS `frames`;
CREATE TABLE IF NOT EXISTS `frames` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `FrName` varchar(60) DEFAULT NULL,
  `EnName` varchar(60) DEFAULT NULL,
  `GerName` varchar(60) DEFAULT NULL,
  `FrDescription` varchar(2000) DEFAULT NULL,
  `EnDescription` varchar(2000) DEFAULT NULL,
  `GerDescription` varchar(2000) DEFAULT NULL,
  `ImageUrl` varchar(200) DEFAULT NULL,
  `PercentagePriceChange` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `frames`
--

INSERT INTO `frames` (`id`, `FrName`, `EnName`, `GerName`, `FrDescription`, `EnDescription`, `GerDescription`, `ImageUrl`, `PercentagePriceChange`) VALUES
(1, 'sans encadrement', NULL, NULL, NULL, NULL, NULL, 'SANS-ENCADREMENT.jpg', '100'),
(2, 'encadrement noir satin', NULL, NULL, NULL, NULL, NULL, 'ENCADREMENT-NOIR-SATIN.jpg', '105'),
(3, 'encadrement blanc satin', NULL, NULL, NULL, NULL, NULL, 'ENCADREMENT-BLANC-SATIN.jpg', '105'),
(4, 'encadrement noyer', NULL, NULL, NULL, NULL, NULL, 'ENCADREMENT-NOYER.jpg', '110'),
(5, 'encadrement chêne', NULL, NULL, NULL, NULL, NULL, 'ENCADREMENT-CHENE.jpg', '110'),
(6, 'bois blanc', NULL, NULL, NULL, NULL, NULL, 'BOIS-BLANC.jpg', '110'),
(7, 'acajou mat', NULL, NULL, NULL, NULL, NULL, 'ACAJOU-MAT.jpg', '110'),
(8, 'aluminium noir', NULL, NULL, NULL, NULL, NULL, 'ALUMINIUM-NOIR.jpg', '120'),
(9, 'aluminium blanc', NULL, NULL, NULL, NULL, NULL, 'BOIS-BLANC.jpg', '120');

-- --------------------------------------------------------

--
-- Structure de la table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `OrdersDate` datetime NOT NULL,
  `Delivery` varchar(4000) DEFAULT NULL,
  `DeliveryCosts` float DEFAULT NULL,
  `Status` varchar(200) DEFAULT NULL,
  `User_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_Orders_User1_idx` (`User_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `orederedarticles`
--

DROP TABLE IF EXISTS `orederedarticles`;
CREATE TABLE IF NOT EXISTS `orederedarticles` (
  `Quantity` int(11) DEFAULT NULL,
  `Price` float DEFAULT NULL,
  `TVA` float DEFAULT NULL,
  `Orders_id` int(11) NOT NULL,
  `Articles_id` int(11) NOT NULL,
  `Formats_id` int(11) NOT NULL,
  `Finishes_id` int(11) NOT NULL,
  `Frames_id` int(11) NOT NULL,
  PRIMARY KEY (`Articles_id`),
  KEY `fk_OrederedArticles_Orders1_idx` (`Orders_id`),
  KEY `fk_OrederedArticles_Formats1_idx` (`Formats_id`),
  KEY `fk_OrederedArticles_Finishes1_idx` (`Finishes_id`),
  KEY `fk_OrederedArticles_Frames1_idx` (`Frames_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `themes`
--

DROP TABLE IF EXISTS `themes`;
CREATE TABLE IF NOT EXISTS `themes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `FrName` varchar(45) DEFAULT NULL,
  `EnName` varchar(45) DEFAULT NULL,
  `GerName` varchar(45) DEFAULT NULL,
  `FrDescription` varchar(4000) DEFAULT NULL,
  `EnDescription` varchar(4000) DEFAULT NULL,
  `GerDescription` varchar(4000) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `themes`
--

INSERT INTO `themes` (`id`, `FrName`, `EnName`, `GerName`, `FrDescription`, `EnDescription`, `GerDescription`) VALUES
(1, 'Mode', NULL, NULL, NULL, NULL, NULL),
(2, 'Urban', NULL, NULL, NULL, NULL, NULL),
(3, 'Noir et Blanc', NULL, NULL, NULL, NULL, NULL),
(4, 'Nature', NULL, NULL, NULL, NULL, NULL),
(5, 'Voyage', NULL, NULL, NULL, NULL, NULL),
(6, 'Paysage', NULL, NULL, NULL, NULL, NULL),
(7, 'Rêve et Création', NULL, NULL, NULL, NULL, NULL),
(8, 'Sport et Technique', NULL, NULL, NULL, NULL, NULL),
(9, 'Célébrités et Histoire', NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Alias` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Email` varchar(45) NOT NULL,
  `Gender` varchar(45) DEFAULT NULL,
  `FirstName` varchar(45) DEFAULT NULL,
  `LastName` varchar(45) DEFAULT NULL,
  `DateOfBirth` datetime NOT NULL,
  `PhoneNumber` int(11) DEFAULT NULL,
  `FrDescription` varchar(4000) DEFAULT NULL,
  `EnDescription` varchar(4000) DEFAULT NULL,
  `GerDescription` varchar(4000) DEFAULT NULL,
  `Role` varchar(20) NOT NULL DEFAULT 'User',
  `Twitter` varchar(200) DEFAULT NULL,
  `Facebook` varchar(200) DEFAULT NULL,
  `WebSite` varchar(200) DEFAULT NULL,
  `Pinterest` varchar(200) DEFAULT NULL,
  `ProEmail` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `Alias`, `Password`, `Email`, `Gender`, `FirstName`, `LastName`, `DateOfBirth`, `PhoneNumber`, `FrDescription`, `EnDescription`, `GerDescription`, `Role`, `Twitter`, `Facebook`, `WebSite`, `Pinterest`, `ProEmail`) VALUES
(1, 'Tom', '$2y$10$.dqX3a6w6t7qqoAjFL1b3Ondq6aKm6nT9QcUOzAFVhrPuNPXkXb2C', 'M1593201513@hotmail.fr', 'Mr', 'Thomas', 'Fourot', '1991-09-26 00:00:00', NULL, NULL, NULL, NULL, 'user', NULL, NULL, NULL, NULL, NULL),
(2, 'Michel', '$2y$10$YHy1xmxNOv.siif6WBqj7us1dMDF./G2insQoZIjtc.1.rGTma4ue', 'jeandupont@gmail.com', 'Mr', 'Michel', 'Dupont', '2002-02-02 00:00:00', NULL, NULL, NULL, NULL, 'user', NULL, NULL, NULL, NULL, NULL),
(3, 'Jean', '$2y$10$6wsNCyann.aBB0V5TFoZJOMsfkXr9waH9X0J60bp82e45iLfRPZzi', 'artist@artist.com', 'Mr', 'Jean', 'Bombeur', '1994-05-26 00:00:00', NULL, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed pulvinar eget dolor et fringilla. Praesent vel tellus mauris. Suspendisse aliquam lorem quis nisl dignissim, vel sollicitudin lorem dictum. Donec at erat rutrum, congue nisi eget, laoreet magna. Suspendisse gravida urna rhoncus dictum imperdiet. Quisque arcu nunc, imperdiet et porta at, tempor vitae neque. Vestibulum ut placerat velit, eget ullamcorper nunc. Fusce dapibus maximus ex non gravida. Maecenas dignissim porta neque, in ornare elit convallis sed. Etiam interdum sem et lectus maximus convallis. Nam pharetra placerat libero et efficitur. Curabitur suscipit eros nec felis congue malesuada. Fusce volutpat sodales risus at tincidunt. Praesent lacus nunc, pellentesque ut semper quis, dapibus quis lectus.\r\n\r\nIn posuere nec massa ac venenatis. Nulla vulputate fringilla facilisis. Vivamus rhoncus, metus at blandit dapibus, mi orci aliquet nisi, ac malesuada risus lorem ut arcu. Etiam dictum libero eu nisl pretium, eu tincidunt risus volutpat. Suspendisse fermentum nibh non pharetra malesuada. Sed ut lorem neque. Nulla rutrum quam non libero consequat ullamcorper. Nam eget suscipit eros. Integer id bibendum dolor, volutpat semper justo. Pellentesque fringilla vitae mauris quis consequat. Morbi et porta massa. Curabitur eleifend, purus a pulvinar molestie, est lectus luctus est, ac tincidunt arcu lectus in mi. Nullam feugiat ligula in erat tempus, at vehicula mauris malesuada. Sed posuere efficitur est, at volutpat est dapibus non. Mauris ut fringilla metus. Integer auctor tincidunt varius.\r\n\r\nProin aliquam ullamcorper eros, ac semper orci dictum in. Sed lacus purus, pharetra a eros at, viverra dictum eros. Sed id eros dolor. Vestibulum cursus auctor risus a lacinia. Quisque fringilla, urna quis consequat lacinia, tellus sem posuere augue, a feugiat ligula quam vitae massa. Pellentesque molestie venenatis ultricies. Fusce consequat augue eget scelerisque consectetur. Etiam non aliquam nulla. Nullam vitae nunc eget magna bibendum pulvinar. Nam maximus ligula ac massa euismod, quis ullamcorper enim vulputate.\r\n\r\nIn elit quam, pharetra sit amet varius sit amet, hendrerit a ante. Suspendisse porta nibh ut turpis tempus fringilla. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Vestibulum tortor nunc, aliquet vel ex id, mollis malesuada dui. Praesent aliquet, nisi et lacinia dapibus, nibh neque posuere sapien, et suscipit lorem lectus elementum dolor. Nulla commodo arcu vitae ipsum vehicula, vitae sodales enim accumsan. Mauris porttitor aliquam tortor, id ultrices lacus volutpat nec. Vivamus laoreet volutpat laoreet. Aliquam tellus ante, condimentum vitae tellus quis, faucibus volutpat risus. Vestibulum suscipit turpis at fermentum tincidunt. Ut dictum tortor in enim ullamcorper commodo. Ut a erat finibus, molestie turpis sit amet, condimentum nulla. Phasellus interdum nulla massa, nec consectetur dui sagittis nec.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed pulvinar eget dolor et fringilla. Praesent vel tellus mauris. Suspendisse aliquam lorem quis nisl dignissim, vel sollicitudin lorem dictum. Donec at erat rutrum, congue nisi eget, laoreet magna. Suspendisse gravida urna rhoncus dictum imperdiet. Quisque arcu nunc, imperdiet et porta at, tempor vitae neque. Vestibulum ut placerat velit, eget ullamcorper nunc. Fusce dapibus maximus ex non gravida. Maecenas dignissim porta neque, in ornare elit convallis sed. Etiam interdum sem et lectus maximus convallis. Nam pharetra placerat libero et efficitur. Curabitur suscipit eros nec felis congue malesuada. Fusce volutpat sodales risus at tincidunt. Praesent lacus nunc, pellentesque ut semper quis, dapibus quis lectus.\r\n\r\nIn posuere nec massa ac venenatis. Nulla vulputate fringilla facilisis. Vivamus rhoncus, metus at blandit dapibus, mi orci aliquet nisi, ac malesuada risus lorem ut arcu. Etiam dictum libero eu nisl pretium, eu tincidunt risus volutpat. Suspendisse fermentum nibh non pharetra malesuada. Sed ut lorem neque. Nulla rutrum quam non libero consequat ullamcorper. Nam eget suscipit eros. Integer id bibendum dolor, volutpat semper justo. Pellentesque fringilla vitae mauris quis consequat. Morbi et porta massa. Curabitur eleifend, purus a pulvinar molestie, est lectus luctus est, ac tincidunt arcu lectus in mi. Nullam feugiat ligula in erat tempus, at vehicula mauris malesuada. Sed posuere efficitur est, at volutpat est dapibus non. Mauris ut fringilla metus. Integer auctor tincidunt varius.\r\n\r\nProin aliquam ullamcorper eros, ac semper orci dictum in. Sed lacus purus, pharetra a eros at, viverra dictum eros. Sed id eros dolor. Vestibulum cursus auctor risus a lacinia. Quisque fringilla, urna quis consequat lacinia, tellus sem posuere augue, a feugiat ligula quam vitae massa. Pellentesque molestie venenatis ultricies. Fusce consequat augue eget scelerisque consectetur. Etiam non aliquam nulla. Nullam vitae nunc eget magna bibendum pulvinar. Nam maximus ligula ac massa euismod, quis ullamcorper enim vulputate.\r\n\r\nIn elit quam, pharetra sit amet varius sit amet, hendrerit a ante. Suspendisse porta nibh ut turpis tempus fringilla. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Vestibulum tortor nunc, aliquet vel ex id, mollis malesuada dui. Praesent aliquet, nisi et lacinia dapibus, nibh neque posuere sapien, et suscipit lorem lectus elementum dolor. Nulla commodo arcu vitae ipsum vehicula, vitae sodales enim accumsan. Mauris porttitor aliquam tortor, id ultrices lacus volutpat nec. Vivamus laoreet volutpat laoreet. Aliquam tellus ante, condimentum vitae tellus quis, faucibus volutpat risus. Vestibulum suscipit turpis at fermentum tincidunt. Ut dictum tortor in enim ullamcorper commodo. Ut a erat finibus, molestie turpis sit amet, condimentum nulla. Phasellus interdum nulla massa, nec consectetur dui sagittis nec.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed pulvinar eget dolor et fringilla. Praesent vel tellus mauris. Suspendisse aliquam lorem quis nisl dignissim, vel sollicitudin lorem dictum. Donec at erat rutrum, congue nisi eget, laoreet magna. Suspendisse gravida urna rhoncus dictum imperdiet. Quisque arcu nunc, imperdiet et porta at, tempor vitae neque. Vestibulum ut placerat velit, eget ullamcorper nunc. Fusce dapibus maximus ex non gravida. Maecenas dignissim porta neque, in ornare elit convallis sed. Etiam interdum sem et lectus maximus convallis. Nam pharetra placerat libero et efficitur. Curabitur suscipit eros nec felis congue malesuada. Fusce volutpat sodales risus at tincidunt. Praesent lacus nunc, pellentesque ut semper quis, dapibus quis lectus.\r\n\r\nIn posuere nec massa ac venenatis. Nulla vulputate fringilla facilisis. Vivamus rhoncus, metus at blandit dapibus, mi orci aliquet nisi, ac malesuada risus lorem ut arcu. Etiam dictum libero eu nisl pretium, eu tincidunt risus volutpat. Suspendisse fermentum nibh non pharetra malesuada. Sed ut lorem neque. Nulla rutrum quam non libero consequat ullamcorper. Nam eget suscipit eros. Integer id bibendum dolor, volutpat semper justo. Pellentesque fringilla vitae mauris quis consequat. Morbi et porta massa. Curabitur eleifend, purus a pulvinar molestie, est lectus luctus est, ac tincidunt arcu lectus in mi. Nullam feugiat ligula in erat tempus, at vehicula mauris malesuada. Sed posuere efficitur est, at volutpat est dapibus non. Mauris ut fringilla metus. Integer auctor tincidunt varius.\r\n\r\nProin aliquam ullamcorper eros, ac semper orci dictum in. Sed lacus purus, pharetra a eros at, viverra dictum eros. Sed id eros dolor. Vestibulum cursus auctor risus a lacinia. Quisque fringilla, urna quis consequat lacinia, tellus sem posuere augue, a feugiat ligula quam vitae massa. Pellentesque molestie venenatis ultricies. Fusce consequat augue eget scelerisque consectetur. Etiam non aliquam nulla. Nullam vitae nunc eget magna bibendum pulvinar. Nam maximus ligula ac massa euismod, quis ullamcorper enim vulputate.\r\n\r\nIn elit quam, pharetra sit amet varius sit amet, hendrerit a ante. Suspendisse porta nibh ut turpis tempus fringilla. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Vestibulum tortor nunc, aliquet vel ex id, mollis malesuada dui. Praesent aliquet, nisi et lacinia dapibus, nibh neque posuere sapien, et suscipit lorem lectus elementum dolor. Nulla commodo arcu vitae ipsum vehicula, vitae sodales enim accumsan. Mauris porttitor aliquam tortor, id ultrices lacus volutpat nec. Vivamus laoreet volutpat laoreet. Aliquam tellus ante, condimentum vitae tellus quis, faucibus volutpat risus. Vestibulum suscipit turpis at fermentum tincidunt. Ut dictum tortor in enim ullamcorper commodo. Ut a erat finibus, molestie turpis sit amet, condimentum nulla. Phasellus interdum nulla massa, nec consectetur dui sagittis nec.', 'artist', NULL, NULL, NULL, NULL, NULL),
(4, 'Alain', '$2y$10$cTPV0PsY1bXki/i0isl0ouQ4EZ..vlRjCHHED8TdwqonEKr0d9itK', 'alainterieur@kartina.com', 'Mr', 'Alain', 'Térieur', '1987-08-13 00:00:00', NULL, NULL, NULL, NULL, 'artist', NULL, NULL, NULL, NULL, NULL);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `addresses`
--
ALTER TABLE `addresses`
  ADD CONSTRAINT `fk_Addresses_User1` FOREIGN KEY (`User_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `articles`
--
ALTER TABLE `articles`
  ADD CONSTRAINT `fk_Articles_Themes` FOREIGN KEY (`Themes_id`) REFERENCES `themes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Articles_User1` FOREIGN KEY (`User_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `fk_Orders_User1` FOREIGN KEY (`User_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `orederedarticles`
--
ALTER TABLE `orederedarticles`
  ADD CONSTRAINT `fk_OrederedArticles_Articles1` FOREIGN KEY (`Articles_id`) REFERENCES `articles` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_OrederedArticles_Finishes1` FOREIGN KEY (`Finishes_id`) REFERENCES `finishes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_OrederedArticles_Formats1` FOREIGN KEY (`Formats_id`) REFERENCES `formats` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_OrederedArticles_Frames1` FOREIGN KEY (`Frames_id`) REFERENCES `frames` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_OrederedArticles_Orders1` FOREIGN KEY (`Orders_id`) REFERENCES `orders` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
