-- --------------------------------------------------------
-- Hôte:                         127.0.0.1
-- Version du serveur:           8.0.30 - MySQL Community Server - GPL
-- SE du serveur:                Win64
-- HeidiSQL Version:             12.1.0.6537
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
INSERT IGNORE INTO `categorie` (`id`, `label`) VALUES
	(1, 'Développement'),
	(2, 'Bureautique');

-- Listage des données de la table tailwind.doctrine_migration_versions : ~0 rows (environ)
INSERT IGNORE INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
	('DoctrineMigrations\\Version20230406203620', '2023-04-06 20:36:28', 199);

-- Listage des données de la table tailwind.messenger_messages : ~0 rows (environ)

-- Listage des données de la table tailwind.module : ~6 rows (environ)
INSERT IGNORE INTO `module` (`id`, `categorie_id`, `label`) VALUES
	(1, 1, 'PHP'),
	(2, 1, 'HTML'),
	(3, 1, 'JavaScript'),
	(4, 1, 'Symfony'),
	(5, 2, 'Word'),
	(6, 2, 'Excel'),
	(7, 2, 'PowerPoint');

-- Listage des données de la table tailwind.programme : ~0 rows (environ)

-- Listage des données de la table tailwind.session : ~2 rows (environ)
INSERT IGNORE INTO `session` (`id`, `nb_place`, `date_debut`, `date_fin`) VALUES
	(1, 10, '2023-04-08 19:08:07', '2023-04-20 19:08:12'),
	(2, 20, '2023-04-11 19:08:22', '2023-04-21 19:08:35');

-- Listage des données de la table tailwind.stagiaire : ~8 rows (environ)
INSERT IGNORE INTO `stagiaire` (`id`, `nom`, `prenom`, `date_naissance`, `mail`, `sexe`, `ville`, `tel`) VALUES
	(1, 'GRISCHKO', 'Kevin', '1998-12-26 00:00:00', 'grischko.kevin@gmail.com', 'Homme', 'MULHOUSE', '0783452375'),
	(2, 'CAMILO', 'Mathieu', '1998-12-26 00:00:00', 'grischko.kevin@gmail.com', 'Homme', 'MULHOUSE', '0783452375'),
	(3, 'Ricard', 'Michel ', '1961-11-30 00:00:00', 'MichelRicard@armyspy.com', 'Homme', 'LA COURNEUVE', '01.96.95.19.79'),
	(4, 'Devost', 'Oliver ', '1987-08-24 00:00:00', 'OliverDevost@rhyta.com', 'Homme', 'SAINT-POL-SUR-MER', '03.71.35.16.86'),
	(5, 'Soucy', 'Carole', '1987-01-06 00:00:00', 'CaroleSoucy@armyspy.com', 'Femme', 'SAINT-MARTIN-D\'HÈRES', '04.76.07.06.28'),
	(6, 'Arsenault', 'Vincent', '1987-07-25 00:00:00', 'VincentArsenault@armyspy.com', 'Homme', 'NICE', '04.99.98.38.69'),
	(7, 'Dubeau', 'Eloise', '1998-09-21 00:00:00', 'EloiseDubeau@armyspy.com', 'Femme', 'FRÉJUS', '04.33.20.00.86');

-- Listage des données de la table tailwind.stagiaire_session : ~0 rows (environ)
INSERT IGNORE INTO `stagiaire_session` (`stagiaire_id`, `session_id`) VALUES
	(1, 1),
	(3, 1);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
