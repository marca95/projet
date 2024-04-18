-- --------------------------------------------------------
-- Hôte:                         127.0.0.1
-- Version du serveur:           11.3.2-MariaDB - mariadb.org binary distribution
-- SE du serveur:                Win64
-- HeidiSQL Version:             12.6.0.6765
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Listage de la structure de la base pour zoo
CREATE DATABASE IF NOT EXISTS `zoo` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;
USE `zoo`;

-- Listage de la structure de la table zoo. accueil_services
CREATE TABLE IF NOT EXISTS `accueil_services` (
  `id_service` int(11) NOT NULL,
  `content` text NOT NULL,
  `img1` varchar(255) NOT NULL,
  `img2` varchar(255) NOT NULL,
  `title_btn` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_service`),
  CONSTRAINT `accueil_services_ibfk_1` FOREIGN KEY (`id_service`) REFERENCES `services` (`id_service`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Listage des données de la table zoo.accueil_services : ~3 rows (environ)
INSERT INTO `accueil_services` (`id_service`, `content`, `img1`, `img2`, `title_btn`) VALUES
	(1, 'Une balade du domaine en petit train avec notre pilote expérimenté René', '../img/accueil/train.png', '../img/accueil/rene.jpeg', 'Pour plus d\'info'),
	(2, 'Vous pourrez également visiter les animaux dans leurs habitats et vous balladez avec des\r\n              animaux inoffensifs,\r\n              telles que des chèvres, des moutons, des ânes pour le bonheur des petits comme des grands!', '../img/accueil/visite1.jpg', '../img/accueil/visite2.jpg', 'Pour plus d\'info'),
	(3, 'Venez découvrir nos magnifiques plats concoctés par nos chefs qualifiés.\r\n              Vous y découvrirez une cuisine authentique, créative mais surtout des plats zéro déchet.\r\n              Nous utilisons le maximum de produits locaux afin de respecter notre conviction, <i>\r\n                une planète plus verte.</i>', '../img/accueil/resto1.jpg', '../img/accueil/resto2.jpg', 'Pour plus d\'info');

-- Listage de la structure de la table zoo. animals
CREATE TABLE IF NOT EXISTS `animals` (
  `id_animal` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `type` varchar(50) NOT NULL,
  `race` varchar(50) NOT NULL,
  `id_location` int(11) NOT NULL,
  `id_home` int(11) NOT NULL,
  `root` varchar(255) DEFAULT NULL,
  `commonName` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_animal`),
  KEY `fk_id_location` (`id_location`),
  KEY `fk_id_home` (`id_home`),
  CONSTRAINT `fk_id_home` FOREIGN KEY (`id_home`) REFERENCES `homes` (`id_home`),
  CONSTRAINT `fk_id_location` FOREIGN KEY (`id_location`) REFERENCES `locations` (`id_location`)
) ENGINE=InnoDB AUTO_INCREMENT=113 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Listage des données de la table zoo.animals : ~89 rows (environ)
INSERT INTO `animals` (`id_animal`, `name`, `type`, `race`, `id_location`, `id_home`, `root`, `commonName`) VALUES
	(1, 'Teddy', 'cerf', 'Cervus elaphus', 2, 1, '../img/habitats/cerf.jpg', 'Le cerf'),
	(2, 'Peggy', 'cochon', 'Gascon', 1, 1, '../img/habitats/cochon.jpg', 'Les cochons'),
	(3, 'Dan', 'cochon', 'Gascon', 1, 1, '../img/habitats/cochon.jpg', 'Les cochons'),
	(4, 'Jayson', 'lapin', 'Bélier Hollandais', 1, 1, '../img/habitats/lapin.jpg', 'Les lapins'),
	(5, 'Olie', 'lapin', 'Bélier Hollandais', 1, 1, '../img/habitats/lapin.jpg', 'Les lapins'),
	(6, 'Vinc', 'dain', 'Européen', 1, 1, '../img/habitats/dains.jpg', 'Les dains'),
	(7, 'Carole', 'dain', 'Européen', 1, 1, '../img/habitats/dains.jpg', 'Les dains'),
	(8, 'Sabine', 'poule', 'Poules d\'ornement', 1, 1, '../img/habitats/poule.jpg', 'Les poules'),
	(9, 'Jacky', 'poule', 'Poules d\'ornement', 1, 1, '../img/habitats/poule.jpg', 'Les poules'),
	(10, 'Banbi', 'chevreuil', 'Capreolus Pygargus', 2, 1, '../img/habitats/chevreuil.jpg', 'Les chevreuils'),
	(11, 'Harry', 'chevreuil', 'Capreolus Pygargus', 2, 1, '../img/habitats/chevreuil.jpg', 'Les chevreuils'),
	(12, 'Bino', 'ecureuil', 'Roux d\'Europe', 1, 1, '../img/habitats/ecureuil.jpg', 'Les écureuils'),
	(13, 'Clark', 'ecureuil', 'Roux d\'Europe', 1, 1, '../img/habitats/ecureuil.jpg', 'Les écureuils'),
	(14, '', 'poisson', 'Clown Loach', 2, 2, '../img/habitats/poisson.jpg', 'Les poissons Asiatique'),
	(15, 'Isa', 'tortue', 'Grecque', 1, 2, '../img/habitats/tortue.jpg', 'Les tortues'),
	(16, 'Coralie', 'tortue', 'Grecque', 1, 2, '../img/habitats/tortue.jpg', 'Les tortues'),
	(17, '', 'flamand rose', 'Phoenicoptéridés', 1, 2, '../img/habitats/flamand.jpg', 'Les flamands Rose'),
	(18, '', 'grenouille', 'Rieuse', 1, 2, '../img/habitats/grenouille.jpg', 'Les grenouilles'),
	(19, 'Billye', 'canard', 'Coureur indien', 2, 2, '../img/habitats/canard.jpg', 'Les canards'),
	(20, 'Mick', 'canard', 'Coureur indien', 2, 2, '../img/habitats/canard.jpg', 'Les canards'),
	(21, 'Djo', 'castor', 'Fiber', 1, 2, '../img/habitats/castor.jpg', 'Nos castors'),
	(22, 'Bill', 'castor', 'Fiber', 1, 2, '../img/habitats/castor.jpg', 'Nos castors'),
	(23, 'Margaux', 'oie', 'Bourbonnais', 1, 2, '../img/habitats/oie.jpg', 'Les oies'),
	(24, 'José', 'oie', 'Bourbonnais', 1, 2, '../img/habitats/oie.jpg', 'Les oies'),
	(25, 'Spider', 'araignée', 'Actinopodidae', 3, 3, '../img/habitats/araignee.jpg', 'L\'araignée'),
	(26, 'Victor', 'cameleon', 'Furcifer', 4, 3, '../img/habitats/cameleon.jpg', 'Le caméléon'),
	(27, 'Sniki', 'boa', 'Boa constricteur', 4, 3, '../img/habitats/boa.jpg', 'Le boa'),
	(28, 'Célio', 'crocodile', 'Crocodile américain', 3, 3, '../img/habitats/crocodile.jpg', 'Le crocodile'),
	(29, 'Pico', 'python', 'Anchietae Bocage', 4, 3, '../img/habitats/python.jpg', 'Le python'),
	(30, '', 'sauterelle', 'Dectique verrucivore', 2, 3, '../img/habitats/sauterelle.jpg', 'Les sauterelles'),
	(31, 'Sabrola', 'alligator', 'Alligator de Chine', 2, 3, '../img/habitats/alligator.jpg', 'L\'alligator'),
	(32, 'Willy', 'dauphin', 'Tursiops aduncus', 3, 7, '../img/habitats/dauphin.jpg', 'Le dauphin'),
	(33, 'Raphael', 'tortue', 'Caouanne', 1, 7, '../img/habitats/tortue1.jpg', 'Les tortues'),
	(34, 'Michelangelo', 'tortue', 'Caouanne', 1, 7, '../img/habitats/tortue1.jpg', 'Les tortues'),
	(35, 'César', 'hippocampe', 'Hippocampus kuda', 2, 7, '../img/habitats/hippocampe.jpg', 'Les hippocampes'),
	(36, 'Juliette', 'hippocampe', 'Hippocampus kuda', 2, 7, '../img/habitats/hippocampe.jpg', 'Les hippocampes'),
	(37, 'Ben', 'phoque', 'Phoque à capuchon', 5, 7, '../img/habitats/phoques.jpg', 'Les phoques'),
	(38, 'Istas', 'phoque', 'Phoque à capuchon', 5, 7, '../img/habitats/phoques.jpg', 'Les phoques'),
	(39, 'Tej', 'pingouin', 'Alca torda', 5, 7, '../img/habitats/pingouin.jpg', 'Les pingouins'),
	(40, 'Tor', 'pingouin', 'Alca torda', 5, 7, '../img/habitats/pingouin.jpg', 'Les pingouins'),
	(41, 'Mamy', 'requin', 'Requin du Groenland', 5, 7, '../img/habitats/requin.jpg', 'Le requin'),
	(42, '', 'meduse', 'Roux d\'Europe', 1, 7, '../img/habitats/meduse.jpg', 'Les méduses'),
	(43, 'Reco', 'bison', 'Bison d\'Amérique', 3, 4, '../img/habitats/bison.jpg', 'Les bisons'),
	(44, 'Cogne', 'bison', 'Bison d\'Amérique', 3, 4, '../img/habitats/bison.jpg', 'Les bisons'),
	(45, 'Cow', 'vache', 'Watusi', 3, 4, '../img/habitats/vache.jpg', 'Les vaches'),
	(46, 'Poker', 'vache', 'Watusi', 3, 4, '../img/habitats/vache.jpg', 'Les vaches'),
	(47, 'Olav', 'girafe', 'Masaï', 4, 4, '../img/habitats/girafe.jpg', 'Les girafes'),
	(48, 'Béné', 'girafe', 'Masaï', 4, 4, '../img/habitats/girafe.jpg', 'Les girafes'),
	(49, 'Jayson', 'mouton', 'Roux du Valais', 1, 4, '../img/habitats/mouton.jpg', 'Les moutons'),
	(50, 'Anne', 'mouton', 'Roux du Valais', 1, 4, '../img/habitats/mouton.jpg', 'Les moutons'),
	(51, 'Kev', 'antilope', 'Elanp du Cap', 4, 4, '../img/habitats/antilope.jpg', 'Les antilopes'),
	(52, 'Ana', 'antilope', 'Elanp du Cap', 4, 4, '../img/habitats/antilope.jpg', 'Les antilopes'),
	(53, 'Tax', 'elephant', 'Elephant d\'Asie', 2, 4, '../img/habitats/elephant.jpg', 'Les éléphants'),
	(54, 'Dumbo', 'elephant', 'Elephant d\'Asie', 2, 4, '../img/habitats/elephant.jpg', 'Les éléphants'),
	(55, 'Cindy', 'cheval', 'Camarillo white', 1, 4, '../img/habitats/cheval.jpg', 'Les chevaux'),
	(56, 'Karl', 'cheval', 'Camarillo white', 1, 4, '../img/habitats/cheval.jpg', 'Les chevaux'),
	(57, 'Simba', 'lion', 'Lion du Sénégal', 4, 5, '../img/habitats/lion.jpg', 'Les lions'),
	(58, 'Pumba', 'lion', 'Lion du Sénégal', 4, 5, '../img/habitats/lion.jpg', 'Les lions'),
	(59, 'Ave', 'rhinoceros', 'Rhinocéros noir', 4, 5, '../img/habitats/rhinoceros.jpg', 'Les rhinocéroses'),
	(60, 'Steve', 'rhinoceros', 'Rhinocéros noir', 4, 5, '../img/habitats/rhinoceros.jpg', 'Les rhinocéros'),
	(61, 'Hulk', 'buffle', 'Syncerus caffer', 4, 5, '../img/habitats/buffle.jpg', 'Les buffles'),
	(62, 'Batman', 'buffle', 'Syncerus caffer', 4, 5, '../img/habitats/buffle.jpg', 'Les buffles'),
	(63, 'Léo', 'leopard', 'Panthera pardus', 4, 5, '../img/habitats/leopard.jpg', 'Les léopards'),
	(64, 'Par', 'leopard', 'Panthera pardus', 4, 5, '../img/habitats/leopard.jpg', 'Les léopards'),
	(65, 'Jola', 'jaguar', 'Jaguar Roux', 2, 5, '../img/habitats/jaguar.jpg', 'Les jaguars'),
	(66, 'Burdi', 'jaguar', 'Jaguar Roux', 2, 5, '../img/habitats/jaguar.jpg', 'Les jaguars'),
	(67, 'Louve', 'loup', 'Loup sauvage', 1, 5, '../img/habitats/loup.jpg', 'Les loups'),
	(68, 'Francis', 'loup', 'Loup sauvage', 1, 5, '../img/habitats/loup.jpg', 'Les loups'),
	(69, 'Rob', 'chameaux', 'Kharai', 4, 5, '../img/habitats/chameau.jpg', 'Les chameaux'),
	(70, 'Camal', 'chameaux', 'Kharai', 4, 5, '../img/habitats/chameau.jpg', 'Les chameaux'),
	(71, 'Daphnée', 'ours brun', 'Ours brun', 2, 6, '../img/habitats/ours.jpg', 'Les ours brun'),
	(72, 'Yama', 'ours brun', 'Ours brun', 2, 6, '../img/habitats/ours.jpg', 'Les ours brun'),
	(73, 'Izidor', 'panda', 'Panda Géant', 2, 6, '../img/habitats/panda.jpg', 'Les pandas'),
	(74, 'Kami', 'panda', 'Panda Géant', 2, 6, '../img/habitats/panda.jpg', 'Les pandas'),
	(75, 'Mickey', 'oran-outang', 'Pango', 2, 6, '../img/habitats/orang-outang.jpg', 'L\'oran-outang'),
	(76, 'Val', 'gorille', 'Gorille de l\'Est', 2, 6, '../img/habitats/gorille.jpg', 'Les gorilles'),
	(77, 'Hicko', 'gorille', 'Gorille de l\'Est', 2, 6, '../img/habitats/gorille.jpg', 'Les gorilles'),
	(78, '', 'saimiri', 'Singes-écureuils', 4, 6, '../img/habitats/saimiri.jpg', 'Les saïmiris'),
	(79, 'Chi', 'kango', 'Kangourou roux', 6, 6, '../img/habitats/kangourou.jpg', 'Les kangourous'),
	(80, 'Dora', 'kango', 'Kangourou roux', 6, 6, '../img/habitats/kangourou.jpg', 'Les kangourous'),
	(81, 'Ivo', 'ours blanc', 'Grolar', 5, 6, '../img/habitats/ours-polaire.jpg', 'L\'ours polaire'),
	(82, 'Rico', 'perroquet', 'Ara', 3, 8, '../img/habitats/perroquet.jpg', 'Le perroquet'),
	(83, 'Vilo', 'toucan', 'Toco', 3, 8, '../img/habitats/toucan.jpg', 'Le toucan'),
	(84, 'Jo', 'aigle', 'Royal', 1, 8, '../img/habitats/aigle.jpg', 'L\'aigle'),
	(85, 'Olivier', 'faucon', 'Lanier', 1, 8, '../img/habitats/faucon.jpg', 'Le faucon'),
	(86, 'Tia', 'autruche', 'Autruche à nuque rouge', 4, 8, '../img/habitats/autruche.jpg', 'Les autruches'),
	(87, 'Milo', 'autruche', 'Autruche à nuque rouge', 4, 8, '../img/habitats/autruche.jpg', 'Les autruches'),
	(88, 'Ken', 'hibou', 'Grand-duc', 2, 8, '../img/habitats/hibou.jpg', 'Le hibou'),
	(89, 'Bastil', 'chouette', 'Hulotte', 1, 8, '../img/habitats/chouette.jpg', 'La chouette');

-- Listage de la structure de la table zoo. avis
CREATE TABLE IF NOT EXISTS `avis` (
  `id_avis` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `status` varchar(10) DEFAULT NULL,
  `id_employe` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_avis`),
  KEY `id_employe` (`id_employe`),
  CONSTRAINT `avis_ibfk_1` FOREIGN KEY (`id_employe`) REFERENCES `users` (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Listage des données de la table zoo.avis : ~4 rows (environ)
INSERT INTO `avis` (`id_avis`, `first_name`, `content`, `status`, `id_employe`) VALUES
	(1, 'Nathalie', 'Le Zoo d\'Arcadia est un espace où les visiteurs peuvent admirer des milliers d\'animaux dans un immense parc. L\'accueil est bon avec le cadre bienveillant et bien aménagé. Le zoo se distingue par sa grande diversité animalière avec des centaines et des centaines d\'espèces venues de tous les continents. Découverte et émerveillement sont donc les mots qui résument les avis des visiteurs du Zoo de Arcadia.', 'published', 12),
	(12, 'Berenice', 'Tres jolie endroit, pleins de couleurs, le restaurant est vraiment tres bon. Les animaux y sont vraiment bien. Je conseille vivement!', 'published', 12),
	(13, 'Pierre', '3ieme commentaire', 'pending', 12),
	(15, 'éé', 'éé', 'pending', NULL);

-- Listage de la structure de la table zoo. contact
CREATE TABLE IF NOT EXISTS `contact` (
  `id_contact` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `DESCRIPTION` text NOT NULL,
  PRIMARY KEY (`id_contact`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Listage des données de la table zoo.contact : ~0 rows (environ)

-- Listage de la structure de la table zoo. foods
CREATE TABLE IF NOT EXISTS `foods` (
  `id_animal` int(11) NOT NULL,
  `food` varchar(100) DEFAULT NULL,
  `grams` float DEFAULT NULL,
  `date_pass` datetime DEFAULT NULL,
  `id_employed` int(11) DEFAULT NULL,
  KEY `id_employed` (`id_employed`),
  KEY `fk_id_animal` (`id_animal`),
  CONSTRAINT `fk_id_animal` FOREIGN KEY (`id_animal`) REFERENCES `animals` (`id_animal`) ON DELETE CASCADE,
  CONSTRAINT `foods_ibfk_2` FOREIGN KEY (`id_employed`) REFERENCES `users` (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Listage des données de la table zoo.foods : ~19 rows (environ)
INSERT INTO `foods` (`id_animal`, `food`, `grams`, `date_pass`, `id_employed`) VALUES
	(2, 'Trognon de pommes ', 400, '2023-04-11 15:52:00', 12),
	(3, 'frites', 10, '2023-04-12 00:00:00', 12),
	(4, 'frites', 10, '2023-04-12 00:00:00', 12),
	(5, 'frites', 10, '2023-04-12 00:00:00', 12),
	(6, 'frites', 10, '2023-04-12 00:00:00', 12),
	(7, 'frites', 10, '2023-04-12 00:00:00', 12),
	(8, 'frites', 10, '2023-04-12 00:00:00', 12),
	(9, 'frites', 10, '2023-04-12 00:00:00', 12),
	(10, 'frites', 10, '2023-04-12 00:00:00', 12),
	(11, 'frites', 10, '2023-04-12 00:00:00', 12),
	(12, 'frites', 10, '2023-04-12 00:00:00', 12),
	(13, 'noisettes et camembert', 200, '2023-07-28 00:00:00', 12),
	(14, 'Mis de pain', 300, '2023-06-22 07:48:00', 12),
	(1, 'Du riz et des pommes', 1000, '2023-04-12 12:32:00', 12),
	(75, 'Bananes', 1000, '2023-04-15 15:48:00', 12),
	(43, 'Foins ', 2500, '2023-04-16 11:12:00', 12),
	(84, 'Petites souris', 300, '2023-04-16 11:18:00', 12),
	(15, 'graine pour tortues ', 200, '2024-04-16 11:40:00', 12),
	(64, 'Viande fraiche', 4000, '2024-04-17 15:21:00', 12);

-- Listage de la structure de la table zoo. homes
CREATE TABLE IF NOT EXISTS `homes` (
  `id_home` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `description` text DEFAULT NULL,
  `main_root` varchar(255) NOT NULL,
  `second_root` varchar(255) NOT NULL,
  `url_img_accueil` varchar(255) NOT NULL,
  `commonName` varchar(255) NOT NULL,
  `second_title` varchar(255) NOT NULL,
  PRIMARY KEY (`id_home`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Listage des données de la table zoo.homes : ~8 rows (environ)
INSERT INTO `homes` (`id_home`, `name`, `description`, `main_root`, `second_root`, `url_img_accueil`, `commonName`, `second_title`) VALUES
	(1, 'foret', 'Cette forêt s\'étend sur plus de 3000m² où se cachent de nombreux cervidés ainsi que quelques animaux de la ferme. Vous pouvez vous y balader en toute tranquillité, profiter du calme et des magnifiques hêtres de plus de 80 ans. Ces animaux sont inoffensifs. Merci de respecter le silence et de veiller à leur bien-être.', '../img/habitats/foret.jpg', '../img/habitats/foret1.jpg', '../img/accueil/foret.jpg', 'La fôret', 'La foret d\'Arcadia'),
	(2, 'etang', 'Grand bassin d\'eau avec petite île au milieu pour que nos canards puissent se reposer\r\n              sans être déranger. Notre étang cache des nombreuses espèces.\r\n              La qualité de l\'eau est controlé hebdomadairement par nos vétérinaire, afin de s\'assurer le bien-être de\r\n              nos animaux.\r\n', '../img/habitats/etang.jpg', '../img/habitats/etang1.jpg', '../img/accueil/etang.jpg', 'L\'étang', 'La plage'),
	(3, 'vivarium', 'Nous appelons la zone de danger le lieu où se situent tous nos vivariums. Nous abritons des animaux pour lesquels une piqûre ou une morsure pourrait être fatale pour l\'homme. Les animaux sont placés dans des vivariums appropriés, avec une température idéale pour chacun.', '../img/habitats/vivarium.jpg', '../img/habitats/vivarium1.jpg', '../img/accueil/terrarium.jpg', 'Le vivarium', 'La zone de danger'),
	(4, 'pature', 'Cet immense champs vert ou sont stockés également nos installations pour l\'énergie verte est l\'habitat de beaucoup de gros animaux, autant d\'Afrique que d\'Amérique.\r\n', '../img/habitats/pature.jpg', '../img/habitats/pature1.jpg', '../img/accueil/pature.jpeg', 'Les pâtures', 'L\'espace vert'),
	(5, 'ranch', 'Vous allez rentrer dans le monde du western, avec les décorations en bois ancien. Vous allez également découvrir le roi de la jungle ainsi que le big Five d\'Afrique.', '../img/habitats/ranch.jpg', '../img/habitats/ranch1.jpg', '../img/accueil/ranch.jpg', 'Le ranch', 'Le west-Arca'),
	(6, 'taniere', 'Certains animaux préfèrent rester dans l\'obscurité aux abris des regards. D\'autres justement préfèrent rester au soleil et rentrer dans leur tanière le soir afin de ne pas être à découvert.\r\n              Vous y découvrirez des animaux venus de tout autour du monde!\r\n', '../img/habitats/taniere.jpg', '../img/habitats/taniere1.jpg', '../img/accueil/tanieres.jpg', 'Les tanières', 'La pénombre'),
	(7, 'oceanarium', 'Magnifique espace vitrée où se situe également un tunnel de + de 50m de long pour rentrer dans le monde de l\'océan. Cette espace est l\'une de plus grande fierté du patron car il habrite des\r\n              spécimen rare et très ancien.', '../img/habitats/oceanarium.jpg', '../img/habitats/oceanarium1.jpg', '../img/accueil/oceanarium.jpg', 'L\'océanarium', 'Le sous-marin'),
	(8, 'voliere', 'Notre volière accueil jusqu\'à 50 espèces de volatiles différents. Ici, nous allons vous\r\n              montrez les animaux ayant le plus de succès auprès de nos visiteurs, mais croyez nous, tous, sont en très\r\n              bonne santé et vivent \'leur best life\'.\r\n', '../img/habitats/voliere.jpg', '../img/habitats/voliere1.jpg', '../img/accueil/voliere.jpg', 'La volière', 'Le ciel d\'Arcadia');

-- Listage de la structure de la table zoo. horaires
CREATE TABLE IF NOT EXISTS `horaires` (
  `id_horaire` int(11) NOT NULL AUTO_INCREMENT,
  `day_week` varchar(50) NOT NULL,
  `start_time` varchar(50) DEFAULT NULL,
  `end_time` varchar(50) DEFAULT NULL,
  `is_closed` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_horaire`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Listage des données de la table zoo.horaires : ~7 rows (environ)
INSERT INTO `horaires` (`id_horaire`, `day_week`, `start_time`, `end_time`, `is_closed`) VALUES
	(1, 'Lundi', '', '', 1),
	(2, 'Mardi', '', '', 1),
	(3, 'Mercredi', '10h', '19h', 0),
	(4, 'Jeudi', '10h', '19h', 0),
	(5, 'Vendredi', '10h', '19h', 0),
	(6, 'Samedi', '10h', '19h', 0),
	(7, 'Dimanche', '11h', '20h', 0);

-- Listage de la structure de la table zoo. locations
CREATE TABLE IF NOT EXISTS `locations` (
  `id_location` int(11) NOT NULL AUTO_INCREMENT,
  `NAME` varchar(50) NOT NULL,
  PRIMARY KEY (`id_location`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Listage des données de la table zoo.locations : ~6 rows (environ)
INSERT INTO `locations` (`id_location`, `NAME`) VALUES
	(1, 'Europe'),
	(2, 'Asie'),
	(3, 'Amérique'),
	(4, 'Afrique'),
	(5, 'Antarctique'),
	(6, 'Océanie');

-- Listage de la structure de la table zoo. roles
CREATE TABLE IF NOT EXISTS `roles` (
  `id_role` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_role`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Listage des données de la table zoo.roles : ~3 rows (environ)
INSERT INTO `roles` (`id_role`, `name`) VALUES
	(1, 'administrateur'),
	(2, 'veterinaire'),
	(3, 'employe');

-- Listage de la structure de la table zoo. services
CREATE TABLE IF NOT EXISTS `services` (
  `id_service` int(11) NOT NULL AUTO_INCREMENT,
  `main_title` varchar(255) NOT NULL,
  `second_title` varchar(255) DEFAULT NULL,
  `img_root` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `third_title` varchar(255) DEFAULT NULL,
  `second_content` text DEFAULT NULL,
  `NAME` varchar(255) NOT NULL,
  `link_class` varchar(255) DEFAULT NULL,
  `link_url` varchar(255) DEFAULT NULL,
  `img_root_link` varchar(255) DEFAULT NULL,
  `btn_class` varchar(255) DEFAULT NULL,
  `btn_url` varchar(255) DEFAULT NULL,
  `btn_title` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_service`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Listage des données de la table zoo.services : ~3 rows (environ)
INSERT INTO `services` (`id_service`, `main_title`, `second_title`, `img_root`, `content`, `third_title`, `second_content`, `NAME`, `link_class`, `link_url`, `img_root_link`, `btn_class`, `btn_url`, `btn_title`) VALUES
	(1, 'Petit tour en train', 'Tarifs pour 45min', '../img/services/train1.jpg', '            -> Adulte: 8€\r\n            <br />\r\n            -> Enfant de 4 à 12ans: 5€\r\n            <br />\r\n            -> Enfant de - 4ans: Gratuit\r\n            <br />\r\n            -> Place réservé pour personne à mobilité reduite', 'Durée :', 'Le train roulera de 11h à 17h\r\n            La promenade dure +/- 45min.\r\n            Le départ se fera à coté de l\'accueil principal.\r\n            Elle démarrera a toutes les heures pleines de 11h à 18h du mercredi au dimanche.\r\n            En fonction des conditions climatique, il est possible que le petit train reste au chaud. L\'accueil vous\r\n            préviendra lors de votre arrivé.', 'train', NULL, NULL, NULL, NULL, NULL, NULL),
	(2, 'Visite des habitats', '', '../img/services/guide.jpg', 'Rendez-vous avec notre guide Arcadia tous les jours de la semaine de 10h30 à 12h et de 14h à\r\n          16h.\r\n          Vous aurez la chance d\'accéder à notre volière où vivent des centaines de différentes sortent\r\n          d\'oiseaux.\r\n          Vous découvrirez sous un autre angle les animaux australiens comme le kangourous, ainsi que\r\n          quelques animaux africains comme les samïris, la\r\n          girafe ou les gorilles. <b>Activité gratuite !</b>', '', 'Il est <b>strictement interdit </b> de donner de la nourriture aux animaux pendant la visite. La nourriture\r\n          est soigneusement préparée et pesée par nos soigneurs. Une quantité trop élévé de nourriture non autorisé\r\n          peut blesser l\'animal, même pire dans certain cas. Merci d\'écouter attentivement les consignes de sécurité\r\n          du guide durant la visite.', 'habitat', NULL, NULL, NULL, NULL, NULL, NULL),
	(3, 'Restaurant', '', '../img/services/restaurant.jpg', '          Notre magnifique restaurant avec 200 places intérieur et 50 places extérieur avec vue sur notre lac, vous\r\n          accompagne de 11h à 15h tous les jours de la semaine.', '', '          Nous vous proposons une cuisine 0 déchet et où nous favorisons les produits locaux. Des assiettes saine,\r\n          riche et savoureuse préparé par nos chefs\r\n          Le restaurant ressemble à notre physionomie: Mettre tout en notre pouvoir pour contribuer à un planète plus\r\n          verte pour le biens de nos animaux.', 'resto', 'col-6 col-md-12 col-xl-6 d-flex align-items-center justify-content-center p-4', './terre.php', '../img/accueil/ecologie.jpg', 'col-6 col-md-12 col-xl-6 d-flex align-items-center justify-content-center p-4', '../img/services/carte_restaurant.pdf', 'Découvrez la carte du restaurant');

-- Listage de la structure de la table zoo. states
CREATE TABLE IF NOT EXISTS `states` (
  `id_animal` int(11) NOT NULL,
  `state` text DEFAULT NULL,
  `detail` text DEFAULT NULL,
  `id_vete` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_animal`),
  KEY `id_vete` (`id_vete`),
  CONSTRAINT `fk_animals_id` FOREIGN KEY (`id_animal`) REFERENCES `animals` (`id_animal`) ON DELETE CASCADE,
  CONSTRAINT `states_ibfk_2` FOREIGN KEY (`id_vete`) REFERENCES `users` (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Listage des données de la table zoo.states : ~21 rows (environ)
INSERT INTO `states` (`id_animal`, `state`, `detail`, `id_vete`) VALUES
	(1, 'Animal en très bonne santé, adore la compagnie', 'Super bois!', 11),
	(2, 'Animal un peu lourd, donner plus d\'eau et des fruits', 'Couper les ongles', 11),
	(3, 'Poids lourd', 'Faire un régime strict', 11),
	(4, 'Poids lourd', 'Faire un régime strict', 11),
	(5, 'Poids lourd', 'Faire un régime strict', 11),
	(6, 'Poids lourd', 'Faire un régime strict', 11),
	(7, 'Poids lourd', 'Faire un régime strict', 11),
	(8, 'Poids lourd', 'Faire un régime strict', 11),
	(9, 'Poids lourd', 'Faire un régime strict', 11),
	(10, 'Poids lourd', 'Faire un régime strict', 11),
	(11, 'Poids lourd', 'Faire un régime strict', 11),
	(12, 'Poids lourd', 'Faire un régime strict', 11),
	(13, 'Bon', 'Surveillez jambe gauche', 11),
	(36, 'Merveilleux animal coloré, quelques espèces encore sur terre. A conserver précieusement', '', 11),
	(43, 'Vérifier ses jambes avant risque d\'infection', 'animal de plus de 30ans', 11),
	(75, 'Animal un peu sale à nettoyer', 'Pelage fort boueux, à nettoyer au savon', 11),
	(85, 'Super animal, très bien apprivoisé', 'Sage sur son bois', 11),
	(86, 'Très grande en taille, attention peut etre parfois dangereuse', 'Rester méfiant', 11),
	(87, 'ok', 'ok', 11),
	(88, 'Très belle animal, agréable et très joviale', '', 11),
	(89, 'Très bon animal, très doux ', 'Pas mal de perte de plumes à faire attention', 11);

-- Listage de la structure de la table zoo. status_home
CREATE TABLE IF NOT EXISTS `status_home` (
  `id_home` int(11) NOT NULL,
  `opinion_state` text DEFAULT NULL,
  `improvement` text DEFAULT NULL,
  `id_veto` int(11) DEFAULT NULL,
  KEY `fk_id_home_status_home` (`id_home`),
  KEY `fk_id_veto_status_home` (`id_veto`),
  CONSTRAINT `fk_id_home_status_home` FOREIGN KEY (`id_home`) REFERENCES `homes` (`id_home`) ON DELETE CASCADE,
  CONSTRAINT `fk_id_veto_status_home` FOREIGN KEY (`id_veto`) REFERENCES `users` (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Listage des données de la table zoo.status_home : ~3 rows (environ)
INSERT INTO `status_home` (`id_home`, `opinion_state`, `improvement`, `id_veto`) VALUES
	(2, 'Filtrer l\'eau plus régulièrement.', 'Prévoir un planning mensuel du filtrage', 11),
	(4, 'rectif', 'rectifaction', 11),
	(1, 'Magnifique endroit pour s\'y balader. Plusieurs variétés d\'arbres. ', 'Aménager un chemin route plus "safe"', 11);

-- Listage de la structure de la table zoo. users
CREATE TABLE IF NOT EXISTS `users` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(100) DEFAULT NULL,
  `id_role` int(11) NOT NULL,
  `birthday` date NOT NULL,
  `hire` date NOT NULL,
  PRIMARY KEY (`id_user`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  KEY `id_role` (`id_role`),
  CONSTRAINT `users_ibfk_1` FOREIGN KEY (`id_role`) REFERENCES `roles` (`id_role`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Listage des données de la table zoo.users : ~7 rows (environ)
INSERT INTO `users` (`id_user`, `name`, `first_name`, `username`, `email`, `password`, `id_role`, `birthday`, `hire`) VALUES
	(10, 'Aldo', 'Jose', 'jose@arcadia.com', 'aldojose@gmail.com', '$2y$10$VecH0xgq.MFlQtTM9tbP4OE.RdgzTWZeNE9FAhJ7V.KYcdLtuAuZq', 1, '1980-05-09', '2000-11-14'),
	(11, 'Knoden', 'Lise', 'lise@arcadia.com', 'knodenlise@gmail.com', '$2y$10$0SeyccXi/tAuzn2VilCKz.nEZ8rs1QOf340fxaeB/Z3WmQPMYTBNi', 2, '1996-07-11', '2021-09-13'),
	(12, 'Paula', 'Emma', 'emma@arcadia.com', 'paulaemma@gmail.com', '$2y$10$rjnR9DjShS6KdGlS.qc9.uEJF9bjMIKJbsaclf.xHxCtsEZ2opS1G', 3, '1999-02-10', '2024-01-02'),
	(38, 'Majerus', 'Pierre', 'pierre@arcadia.com', 'pierre.majerus@outlook.be', '$2y$10$FTm7AAHiQMHDIj8EpAeWsud11yGQ8boinfOkp0CZyNDhdG788dzGi', 3, '1995-04-03', '2015-06-01'),
	(40, 'Gillet', 'Annelise', 'annelise@arcadia.com', 'annelise@gmail.com', '$2y$10$XgJSBRtg7wMog7bqwVKUturE9ixQTJLmJUptAUUemKajdHsULMxHu', 2, '1996-03-09', '2023-12-26'),
	(41, 'Koeune', 'Antoine', 'antoine@arcadia.com', 'antoine@gmail.com', '$2y$10$60gL9giconY4hbukMenFP.MDh6stjJkSrax514maLdTHCxWy/EQD6', 3, '1994-03-22', '2024-04-17'),
	(42, 'Detaille', 'Kevin', 'kevin@arcadia.com', 'kev0304@gmail.com', '$2y$10$qhXCeVMozD0raH/DIOEJMerkc9.Dpk1e/9VUacI6bTPo6nGRNAq/W', 2, '1987-08-12', '2011-09-05');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
