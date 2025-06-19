-- Adminer 5.2.1 MariaDB 10.4.32-MariaDB dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `commande`;
CREATE TABLE `commande` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `vehicule_id` int(11) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `date_debut` varchar(255) NOT NULL,
  `date_fin` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_6EEAA67D4A4A3511` (`vehicule_id`),
  CONSTRAINT `FK_6EEAA67D4A4A3511` FOREIGN KEY (`vehicule_id`) REFERENCES `vehicule` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `commandes`;
CREATE TABLE `commandes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `date_debut` date NOT NULL,
  `date_fin` date NOT NULL,
  `id_vehicule` varchar(255) NOT NULL,
  `confirmer` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `commandes` (`id`, `name`, `email`, `date_debut`, `date_fin`, `id_vehicule`, `confirmer`) VALUES
(47,	'LANTOTIANA',	'LANTOTIANA@gmail.com',	'2025-06-27',	'2025-06-17',	'9',	'reserver'),
(48,	'LANTOTIANA',	'LANTOTIANA@gmail.com',	'2025-06-28',	'2025-06-25',	'9',	'xxx'),
(49,	'ddd',	'dddd@email.com',	'2025-06-26',	'2025-07-02',	'12',	'vue'),
(50,	'ddd',	'dddd@email.com',	'2025-06-26',	'2025-07-02',	'12',	'vue'),
(51,	'LANTOTIANA',	'dddd@email.com',	'2025-06-03',	'2025-06-04',	'16',	'reserver');

DROP TABLE IF EXISTS `discution`;
CREATE TABLE `discution` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `discution` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `contact` varchar(255) NOT NULL,
  `id_vehicule` varchar(255) NOT NULL,
  `confirmation` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `discution` (`id`, `discution`, `email`, `contact`, `id_vehicule`, `confirmation`) VALUES
(1,	'qsfqs',	'qsdfqs',	'sdfqsdf',	'qsfq',	'sdfqs'),
(2,	'Aucune discussion fournie.',	'Aucune discussion fournie.',	'Aucune discussion fournie.',	'2',	'Aucune discussion fournie.'),
(3,	'jjjjjjjj',	'qsf@gmail.com',	'jjjjjjjj',	'2',	'En attente'),
(4,	'gggggggggggggggggggggggggg',	'qsf@gmail.com',	'gggggg',	'2',	'En attente'),
(5,	'.NSLFNQDFNQSDF',	'qsf@gmail.com',	'097987',	'2',	'En attente'),
(7,	'sqdfqsdfs dfqsd qdfqsdfsd',	'qsf@gmail.com',	'qlfqsf qsfhsd',	'2',	'En attente'),
(8,	'sqdfqsdfs dfqsd qdfqsdfsd',	'qsf@gmail.com',	'qlfqsf qsfhsd',	'2',	'En attente'),
(9,	'sqdfqsdfs dfqsd qdfqsdfsd',	'qsf@gmail.com',	'qlfqsf qsfhsd',	'2',	'En attente'),
(10,	'qsdfqsdfqsdf',	'qsf@gmail.com',	'98745957',	'2',	'En attente'),
(11,	'ffffff',	'ffffffff',	'ffffffff',	'fffffffffff',	'fffffffffffffffff');

DROP TABLE IF EXISTS `doctrine_migration_versions`;
CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20250506061252',	'2025-05-06 08:13:55',	651),
('DoctrineMigrations\\Version20250506063653',	'2025-05-06 08:40:13',	489),
('DoctrineMigrations\\Version20250509102444',	'2025-05-09 12:26:35',	362),
('DoctrineMigrations\\Version20250509160627',	'2025-05-09 18:06:36',	260),
('DoctrineMigrations\\Version20250528074037',	'2025-05-28 09:41:12',	407),
('DoctrineMigrations\\Version20250528074223',	'2025-05-28 09:42:45',	160),
('DoctrineMigrations\\Version20250529054704',	'2025-05-29 07:47:16',	176),
('DoctrineMigrations\\Version20250529060636',	'2025-05-29 08:06:50',	1383),
('DoctrineMigrations\\Version20250530184735',	'2025-05-30 20:48:14',	1122),
('DoctrineMigrations\\Version20250530202543',	'2025-05-30 22:25:58',	1065),
('DoctrineMigrations\\Version20250531052638',	'2025-05-31 07:26:52',	304),
('DoctrineMigrations\\Version20250531053151',	'2025-05-31 07:32:04',	141),
('DoctrineMigrations\\Version20250602112002',	'2025-06-02 13:20:29',	232),
('DoctrineMigrations\\Version20250602135833',	'2025-06-02 15:58:39',	325),
('DoctrineMigrations\\Version20250602135938',	'2025-06-02 15:59:48',	114),
('DoctrineMigrations\\Version20250603054148',	'2025-06-03 07:42:00',	210),
('DoctrineMigrations\\Version20250605113353',	'2025-06-05 13:34:59',	1379),
('DoctrineMigrations\\Version20250605122507',	'2025-06-05 14:25:45',	146),
('DoctrineMigrations\\Version20250618133437',	'2025-06-18 15:35:02',	318);

DROP TABLE IF EXISTS `messenger_messages`;
CREATE TABLE `messenger_messages` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `body` longtext NOT NULL,
  `headers` longtext NOT NULL,
  `queue_name` varchar(190) NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `available_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `delivered_at` datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`id`),
  KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
  KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
  KEY `IDX_75EA56E016BA31DB` (`delivered_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `negosiation`;
CREATE TABLE `negosiation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `discution` varchar(255) NOT NULL,
  `emails` varchar(255) NOT NULL,
  `contacte` varchar(255) NOT NULL,
  `id_vehicule` varchar(255) NOT NULL,
  `confirmation` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `negosiation` (`id`, `discution`, `emails`, `contacte`, `id_vehicule`, `confirmation`) VALUES
(1,	'g',	'g',	'g',	'g',	'g'),
(2,	'y',	'y',	'y',	'y',	'y');

DROP TABLE IF EXISTS `produit`;
CREATE TABLE `produit` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `categorie` varchar(255) NOT NULL,
  `reference` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `proprietaire`;
CREATE TABLE `proprietaire` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `cin` varchar(255) NOT NULL,
  `tel` varchar(255) NOT NULL,
  `contatrat` varchar(255) NOT NULL,
  `id_vehicule` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `proprietaire` (`id`, `name`, `prenom`, `cin`, `tel`, `contatrat`, `id_vehicule`) VALUES
(29,	'LANTOTIANA JOSEPH',	'charly',	'8888888888',	'345990241',	'CDD',	'1'),
(30,	'charly',	'lantotiana joseph',	'101211267206',	'345990241',	'CDI',	'1');

DROP TABLE IF EXISTS `tomobiles`;
CREATE TABLE `tomobiles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `proprietaire_id` int(11) DEFAULT NULL,
  `type` varchar(255) NOT NULL,
  `categorie` varchar(255) NOT NULL,
  `place` varchar(255) NOT NULL,
  `motereur` varchar(255) NOT NULL,
  `marque` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `image2` varchar(255) NOT NULL,
  `image3` varchar(255) NOT NULL,
  `image4` varchar(255) NOT NULL,
  `reservation` varchar(255) NOT NULL,
  `prix` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_64D9B54E76C50E4A` (`proprietaire_id`),
  CONSTRAINT `FK_64D9B54E76C50E4A` FOREIGN KEY (`proprietaire_id`) REFERENCES `proprietaire` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `tomobiles` (`id`, `proprietaire_id`, `type`, `categorie`, `place`, `motereur`, `marque`, `image`, `image2`, `image3`, `image4`, `reservation`, `prix`, `description`) VALUES
(12,	29,	'plaisir',	'normal',	'5',	'essence',	'plaisir',	'6851970e5725e.jpg',	'6851970e58859.jpg',	'6851970e594c1.jpg',	'6851970e5a20b.jpg',	'xxx',	'30000',	'DSFSQDFQSDF FQSFQ QSFQSF'),
(15,	30,	'plaisir',	'etat',	'5',	'gasoil',	'plaisir',	'68519c09886f6.jpg',	'68519c098aaae.jpg',	'68519c098bdbd.jpg',	'68519c098d126.jpg',	'xxx',	'30000',	'SQFSFQSD QFF Qdfsdc'),
(16,	29,	'different',	'bonne occasion',	'5',	'essence',	'different',	'68519c9371b98.jpg',	'68519c9372e69.jpg',	'68519c9375d49.jpg',	'68519c9376be6.jpg',	'reserver',	'40000',	'QFQSDFQ DFQSDF QSDFSDF');

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(180) NOT NULL,
  `roles` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL COMMENT '(DC2Type:json)' CHECK (json_valid(`roles`)),
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_IDENTIFIER_USERNAME` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `user` (`id`, `username`, `roles`, `password`, `email`) VALUES
(1,	'charly',	'[]',	'$2y$13$eMzP4Cew3F2.I6DlF8esCeRD7QmgllJPGvgWLYSr3bhOXI9PxQyxa',	'charly@gmail.com');

DROP TABLE IF EXISTS `vehicule`;
CREATE TABLE `vehicule` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(255) NOT NULL,
  `categorie` varchar(255) NOT NULL,
  `prix` varchar(255) NOT NULL,
  `proprietaire` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `place` varchar(255) NOT NULL,
  `moteur` varchar(255) NOT NULL,
  `marque` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `image2` varchar(255) NOT NULL,
  `image3` varchar(255) NOT NULL,
  `image4` varchar(255) NOT NULL,
  `id_proprety_id` int(11) DEFAULT NULL,
  `id_proprietaire` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_292FFF1DF02A4E78` (`id_proprety_id`),
  CONSTRAINT `FK_292FFF1DF02A4E78` FOREIGN KEY (`id_proprety_id`) REFERENCES `proprietaire` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `vehicule` (`id`, `type`, `categorie`, `prix`, `proprietaire`, `description`, `place`, `moteur`, `marque`, `image`, `image2`, `image3`, `image4`, `id_proprety_id`, `id_proprietaire`) VALUES
(1,	'D',	'DDD',	'DDD',	'DDD',	'D',	'D',	'DDDD',	'DD',	'6821b726a62e5.jpg',	'C:\\xampp\\tmp\\phpA1D2.tmp',	'C:\\xampp\\tmp\\phpA1F2.tmp',	'C:\\xampp\\tmp\\phpA222.tmp',	NULL,	'');

-- 2025-06-19 05:45:20 UTC