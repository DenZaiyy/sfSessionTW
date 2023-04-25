-- --------------------------------------------------------
-- Hôte:                         127.0.0.1
-- Version du serveur:           8.0.32 - MySQL Community Server - GPL
-- SE du serveur:                macos13
-- HeidiSQL Version:             12.4.0.6659
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Listage des données de la table tailwind.categorie : ~2 rows (environ)
DELETE FROM `categorie`;
INSERT INTO `categorie` (`id`, `label`, `image`) VALUES
	(1, 'Développement', '/uploads/devenir-developpeur-web-mobile-6447dfab85880.jpg'),
	(2, 'Bureautique', '/uploads/formation-bureautique-nice-06-6447dfa5a6d82.jpg'),
	(5, 'Cybersécurité', '/uploads/cybersecurite-6447e131da4fd.jpg');

-- Listage des données de la table tailwind.messenger_messages : ~0 rows (environ)
DELETE FROM `messenger_messages`;

-- Listage des données de la table tailwind.module : ~7 rows (environ)
DELETE FROM `module`;
INSERT INTO `module` (`id`, `categorie_id`, `label`) VALUES
	(1, 1, 'PHP'),
	(2, 1, 'HTML'),
	(3, 1, 'JavaScript'),
	(4, 1, 'Symfony'),
	(5, 2, 'Word'),
	(6, 2, 'Excel'),
	(7, 2, 'PowerPoint'),
	(10, 5, 'Algorithme'),
	(14, 5, 'test');

-- Listage des données de la table tailwind.programme : ~2 rows (environ)
DELETE FROM `programme`;
INSERT INTO `programme` (`id`, `session_id`, `module_id`, `duree`) VALUES
	(1, 3, 1, 30),
	(2, 3, 2, 5),
	(3, 3, 4, 20);

-- Listage des données de la table tailwind.reset_password_request : ~0 rows (environ)
DELETE FROM `reset_password_request`;

-- Listage des données de la table tailwind.session : ~2 rows (environ)
DELETE FROM `session`;
INSERT INTO `session` (`id`, `nb_place`, `date_debut`, `date_fin`, `label`) VALUES
	(1, 10, '2023-04-08 19:08:07', '2023-04-20 19:08:12', 'Initiation a Excel et Word'),
	(2, 5, '2023-04-11 00:00:00', '2023-04-21 00:00:00', 'Initiation à la Bureautique'),
	(3, 2, '2023-04-17 00:00:00', '2023-06-09 00:00:00', 'Initiation au Développement Web');

-- Listage des données de la table tailwind.stagiaire : ~14 rows (environ)
DELETE FROM `stagiaire`;
INSERT INTO `stagiaire` (`id`, `nom`, `prenom`, `date_naissance`, `mail`, `sexe`, `ville`, `tel`) VALUES
	(1, 'GRISCHKO', 'Kevin', '1998-12-26 00:00:00', 'grischko.kevin@gmail.com', 'Homme', 'MULHOUSE', '0783452375'),
	(2, 'CAMILO', 'Mathieu', '1998-12-26 00:00:00', 'grischko.kevin@gmail.com', 'Homme', 'MULHOUSE', '0783452375'),
	(3, 'Ricard', 'Michel ', '1961-11-30 00:00:00', 'MichelRicard@armyspy.com', 'Homme', 'LA COURNEUVE', '01.96.95.19.79'),
	(4, 'Devost', 'Oliver ', '1987-08-24 00:00:00', 'OliverDevost@rhyta.com', 'Homme', 'SAINT-POL-SUR-MER', '03.71.35.16.86'),
	(5, 'Soucy', 'Carole', '1987-01-06 00:00:00', 'CaroleSoucy@armyspy.com', 'Femme', 'SAINT-MARTIN-D\'HÈRES', '04.76.07.06.28'),
	(6, 'Arsenault', 'Vincent', '1987-07-25 00:00:00', 'VincentArsenault@armyspy.com', 'Homme', 'NICE', '04.99.98.38.69'),
	(8, 'Valiant', 'Martin', '1974-05-06 00:00:00', 'ValiantMartin@dayrep.com', 'Homme', 'MARSEILLE', '04.38.36.08.54'),
	(9, 'Rocheleau', 'Melusina', '1970-02-27 00:00:00', 'MelusinaRocheleau@rhyta.com', 'Femme', 'MARSEILLE', '04.21.44.51.43'),
	(10, 'Gareau', 'André', '1997-07-03 00:00:00', 'AndreGareau@armyspy.com', 'Homme', 'NANTES', '02.62.82.72.60'),
	(11, 'Pariseau', 'Aya', '1968-06-20 00:00:00', 'AyaPariseau@dayrep.com', 'Femme', 'VINCENNES', '01.84.97.00.44'),
	(12, 'Bélanger', 'Clothilde', '1956-10-26 00:00:00', 'ClothildeBelanger@teleworm.us', 'Femme', 'LA VARENNE-SAINT-HILAIRE', '01.94.85.74.43'),
	(13, 'Coudert', 'Marveille', '2000-11-04 00:00:00', 'MarveilleCoudert@rhyta.com', 'Femme', 'CHAUMONT', '03.93.57.85.37'),
	(14, 'Denis', 'Valentine', '1978-06-30 00:00:00', 'ValentineDenis@rhyta.com', 'Femme', 'VÉLIZY-VILLACOUBLAY', '01.45.96.77.21'),
	(15, 'Durepos', 'Guillaume', '1959-10-23 00:00:00', 'GuillaumeDurepos@dayrep.com', 'Homme', 'FORT-DE-FRANCE', '05.44.82.65.30'),
	(16, 'GRUENWALD', 'Richard', '1990-11-11 00:00:00', 'gruenwald.richard@stagiaire.com', 'Homme', 'Mulhouse', '0606060606');

-- Listage des données de la table tailwind.stagiaire_session : ~9 rows (environ)
DELETE FROM `stagiaire_session`;
INSERT INTO `stagiaire_session` (`stagiaire_id`, `session_id`) VALUES
	(1, 1),
	(1, 3),
	(2, 2),
	(3, 1),
	(3, 3),
	(8, 2),
	(9, 2);

-- Listage des données de la table tailwind.user : ~0 rows (environ)
DELETE FROM `user`;
INSERT INTO `user` (`id`, `username`, `roles`, `password`, `email`, `avatar`) VALUES
	(1, 'denz', '["ROLE_ADMIN"]', '$2y$13$rNN4fEqsTzOXDn/UFjXp/.ZyYBBsIRuErSYLD/Lpjlvk2WXDJQfma', 'admin@gmail.com', 'MicrosoftTeams-image-6447753df23e9.jpg');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
