-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mer. 20 jan. 2021 à 20:46
-- Version du serveur :  10.4.14-MariaDB
-- Version de PHP : 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `wish`
--

drop table user;
drop table list;
drop table item;

create table `user` (
    `email` VARCHAR(255) Primary Key,
    `name` VARCHAR(255),
    `password` VARCHAR(255)
);


create table `list`(
    `idList` VARCHAR(8) PRIMARY KEY,
    `Nomlist` VARCHAR(32),
    `nomAuteur` VARCHAR(32),
    `descr` VARCHAR(500)
);


create table `item`(
    `idItem` varchar(8) PRIMARY KEY,
    `idList` VARCHAR(8),
    `NomItem` VARCHAR(32),
    `description` VARCHAR(500),
    `cout` int(8)
 );

INSERT INTO `user` (`email`, `name`,`password`) VALUES
('guilaume@mail.com', 'guillaume', 1234);

INSERT INTO `list` (`idList`, `Nomlist`, `nomAuteur`, `descr`) VALUES
('l1', 'test', 'ceci est un test','testNom'),
('l2', 'Ma wishlist','Guillaume', 'Ma wishlist pour noel');

INSERT INTO `item` (`idItem`, `idList`, `NomItem`, `description`, `cout`) VALUES
('i1','l1', 'test', 'ceci est un test', 0),
('i2','l2', 'Console super trop bien','The new console incredible', 200),
('i3','l2', 'Console super trop bien++', 'La next gen En rupture de stock', 250);