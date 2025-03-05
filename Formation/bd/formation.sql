-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 05, 2025 at 04:37 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `formation`
--
CREATE DATABASE IF NOT EXISTS `formation` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `formation`;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `id_category` int(11) NOT NULL AUTO_INCREMENT,
  `name_category` varchar(250) NOT NULL,
  PRIMARY KEY (`id_category`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `formador`
--

DROP TABLE IF EXISTS `formador`;
CREATE TABLE IF NOT EXISTS `formador` (
  `id_formador` int(11) NOT NULL AUTO_INCREMENT,
  `name_formador` varchar(100) NOT NULL,
  `telephone_formador` varchar(100) NOT NULL,
  `email_formador` varchar(250) NOT NULL,
  PRIMARY KEY (`id_formador`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `formation`
--

DROP TABLE IF EXISTS `formation`;
CREATE TABLE IF NOT EXISTS `formation` (
  `id_formation` int(11) NOT NULL AUTO_INCREMENT,
  `name_formation` int(250) NOT NULL,
  `formator_formation` int(11) NOT NULL,
  `duration_in_h_formation` varchar(20) NOT NULL,
  `category_formation` int(11) NOT NULL,
  `post_conser_formation` int(11) NOT NULL,
  `type_formation` enum('Normal','Recyclage','','') NOT NULL DEFAULT 'Normal',
  `comment_formation` longtext NOT NULL,
  PRIMARY KEY (`id_formation`),
  KEY `formator_formation` (`formator_formation`,`category_formation`,`post_conser_formation`),
  KEY `category_formation` (`category_formation`),
  KEY `post_conser_formation` (`post_conser_formation`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `operator`
--

DROP TABLE IF EXISTS `operator`;
CREATE TABLE IF NOT EXISTS `operator` (
  `id_operator` int(11) NOT NULL AUTO_INCREMENT,
  `name_operator` varchar(50) NOT NULL,
  `lastname_operator` varchar(50) NOT NULL,
  `email_operator` varchar(250) NOT NULL,
  `status_operator` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id_operator`),
  KEY `status_operator` (`status_operator`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `operator`
--

INSERT INTO `operator` (`id_operator`, `name_operator`, `lastname_operator`, `email_operator`, `status_operator`) VALUES
(1, 'Op1', 'Op1Ss', 'op1s@mm.com', 1),
(2, 'Op2', 'Op2S', 'op2@mm.com', 1),
(3, 'Op3', 'Op3S', 'op3@mm.com', 2);

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

DROP TABLE IF EXISTS `post`;
CREATE TABLE IF NOT EXISTS `post` (
  `id_post` int(11) NOT NULL AUTO_INCREMENT,
  `name_post` varchar(100) NOT NULL,
  PRIMARY KEY (`id_post`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

DROP TABLE IF EXISTS `role`;
CREATE TABLE IF NOT EXISTS `role` (
  `id_role` int(11) NOT NULL AUTO_INCREMENT,
  `name_role` varchar(11) NOT NULL,
  PRIMARY KEY (`id_role`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id_role`, `name_role`) VALUES
(1, 'admin'),
(2, 'user_admin'),
(3, 'user_view');

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

DROP TABLE IF EXISTS `status`;
CREATE TABLE IF NOT EXISTS `status` (
  `id_status` int(11) NOT NULL AUTO_INCREMENT,
  `name_status` varchar(11) NOT NULL,
  PRIMARY KEY (`id_status`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`id_status`, `name_status`) VALUES
(1, 'Desactive'),
(2, 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `nome_usuario` varchar(100) NOT NULL,
  `email_usuario` varchar(250) NOT NULL,
  `senha_usuario` varchar(255) NOT NULL,
  `role` int(11) NOT NULL,
  `data_cadastro_usuario` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id_usuario`),
  KEY `role` (`role`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nome_usuario`, `email_usuario`, `senha_usuario`, `role`, `data_cadastro_usuario`) VALUES
(1, 'ivan1', 'ivan1@mm.com', '$2y$10$6zU3vIme1LtEU1Mt4vanzec.VjCnjALzKX4ozPBFaXx//BhKZAzDa', 2, '2025-03-05 12:31:43');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `formation`
--
ALTER TABLE `formation`
  ADD CONSTRAINT `formation_ibfk_1` FOREIGN KEY (`category_formation`) REFERENCES `category` (`id_category`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `formation_ibfk_2` FOREIGN KEY (`post_conser_formation`) REFERENCES `post` (`id_post`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `formation_ibfk_3` FOREIGN KEY (`formator_formation`) REFERENCES `formador` (`id_formador`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `operator`
--
ALTER TABLE `operator`
  ADD CONSTRAINT `operator_ibfk_1` FOREIGN KEY (`status_operator`) REFERENCES `status` (`id_status`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`role`) REFERENCES `role` (`id_role`) ON DELETE NO ACTION ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
