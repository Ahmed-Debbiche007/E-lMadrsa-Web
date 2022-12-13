# ************************************************************
# Antares - SQL Client
# Version 0.7.0
# 
# https://antares-sql.app/
# https://github.com/antares-sql/antares
# 
# Host: 127.0.0.1 ((Ubuntu) 8.0.31)
# Database: springfever
# Generation time: 2022-12-08T09:10:58+01:00
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
SET NAMES utf8mb4;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table attestation
# ------------------------------------------------------------

DROP TABLE IF EXISTS `attestation`;

CREATE TABLE `attestation` (
  `idAttestation` int NOT NULL AUTO_INCREMENT,
  `idparticipation` int NOT NULL,
  `date_Acq` date NOT NULL,
  PRIMARY KEY (`idAttestation`),
  KEY `Attestation_fk0` (`idparticipation`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

LOCK TABLES `attestation` WRITE;
/*!40000 ALTER TABLE `attestation` DISABLE KEYS */;

INSERT INTO `attestation` (`idAttestation`, `idparticipation`, `date_Acq`) VALUES
	(2, 11, "2022-05-01");

/*!40000 ALTER TABLE `attestation` ENABLE KEYS */;
UNLOCK TABLES;



# Dump of table badge
# ------------------------------------------------------------

DROP TABLE IF EXISTS `badge`;

CREATE TABLE `badge` (
  `id` int NOT NULL AUTO_INCREMENT,
  `badgetype` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `badgeimage` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `badge` WRITE;
/*!40000 ALTER TABLE `badge` DISABLE KEYS */;

INSERT INTO `badge` (`id`, `badgetype`, `badgeimage`) VALUES
	(1, "Gold", "ssss"),
	(2, "Silver", "ssss"),
	(3, "Bronze", "sqsqs");

/*!40000 ALTER TABLE `badge` ENABLE KEYS */;
UNLOCK TABLES;



# Dump of table badge_user
# ------------------------------------------------------------

DROP TABLE IF EXISTS `badge_user`;

CREATE TABLE `badge_user` (
  `badge_id` int NOT NULL,
  `user_id` int NOT NULL,
  PRIMARY KEY (`badge_id`,`user_id`),
  KEY `IDX_299D3A50F7A2C2FC` (`badge_id`),
  KEY `IDX_299D3A50A76ED395` (`user_id`),
  CONSTRAINT `FK_299D3A50A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_299D3A50F7A2C2FC` FOREIGN KEY (`badge_id`) REFERENCES `badge` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `badge_user` WRITE;
/*!40000 ALTER TABLE `badge_user` DISABLE KEYS */;

INSERT INTO `badge_user` (`badge_id`, `user_id`) VALUES
	(1, 1),
	(2, 1),
	(3, 1);

/*!40000 ALTER TABLE `badge_user` ENABLE KEYS */;
UNLOCK TABLES;



# Dump of table categorie
# ------------------------------------------------------------

DROP TABLE IF EXISTS `categorie`;

CREATE TABLE `categorie` (
  `idCategorie` bigint NOT NULL AUTO_INCREMENT,
  `nomCategorie` varchar(20) NOT NULL,
  PRIMARY KEY (`idCategorie`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

LOCK TABLES `categorie` WRITE;
/*!40000 ALTER TABLE `categorie` DISABLE KEYS */;

INSERT INTO `categorie` (`idCategorie`, `nomCategorie`) VALUES
	(1, "categorie 1 "),
	(2, "categorie 2"),
	(4, "categorie 4"),
	(5, "codage"),
	(6, "categorie langues");

/*!40000 ALTER TABLE `categorie` ENABLE KEYS */;
UNLOCK TABLES;



# Dump of table categorie_ev
# ------------------------------------------------------------

DROP TABLE IF EXISTS `categorie_ev`;

CREATE TABLE `categorie_ev` (
  `id` int NOT NULL AUTO_INCREMENT,
  `type_evenement` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `categorie_ev` WRITE;
/*!40000 ALTER TABLE `categorie_ev` DISABLE KEYS */;

INSERT INTO `categorie_ev` (`id`, `type_evenement`) VALUES
	(1, "Conférance"),
	(2, "Party");

/*!40000 ALTER TABLE `categorie_ev` ENABLE KEYS */;
UNLOCK TABLES;



# Dump of table category
# ------------------------------------------------------------

DROP TABLE IF EXISTS `category`;

CREATE TABLE `category` (
  `categoryID` bigint NOT NULL AUTO_INCREMENT,
  `categoryNAME` varchar(255) NOT NULL,
  `categoryIMAGE` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`categoryID`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

LOCK TABLES `category` WRITE;
/*!40000 ALTER TABLE `category` DISABLE KEYS */;

INSERT INTO `category` (`categoryID`, `categoryNAME`, `categoryIMAGE`) VALUES
	(27, "Python", "python-6391957669ab3.png"),
	(28, "physics", "physics-63919596302c3.jpg"),
	(29, "java", "java-639195b5686ab.jpg");

/*!40000 ALTER TABLE `category` ENABLE KEYS */;
UNLOCK TABLES;



# Dump of table chatsessions
# ------------------------------------------------------------

DROP TABLE IF EXISTS `chatsessions`;

CREATE TABLE `chatsessions` (
  `idsession` int NOT NULL AUTO_INCREMENT,
  `idtutorshipsession` int NOT NULL,
  PRIMARY KEY (`idsession`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;





# Dump of table comment
# ------------------------------------------------------------

DROP TABLE IF EXISTS `comment`;

CREATE TABLE `comment` (
  `commentID` bigint NOT NULL AUTO_INCREMENT,
  `commentCONTENT` varchar(255) NOT NULL,
  `userID` int NOT NULL,
  `postID` bigint NOT NULL,
  `commentVOTE` int NOT NULL,
  `commentDATE` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`commentID`),
  KEY `postfk` (`postID`),
  KEY `userfk` (`userID`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

LOCK TABLES `comment` WRITE;
/*!40000 ALTER TABLE `comment` DISABLE KEYS */;

INSERT INTO `comment` (`commentID`, `commentCONTENT`, `userID`, `postID`, `commentVOTE`) VALUES
	(20, "I can help you bro just delete system32 and your problems will be solved ", 3, 58, 0),
	(21, "no sadly you need to install python premium to do that ", 3, 58, 0);

/*!40000 ALTER TABLE `comment` ENABLE KEYS */;
UNLOCK TABLES;



# Dump of table competences
# ------------------------------------------------------------

DROP TABLE IF EXISTS `competences`;

CREATE TABLE `competences` (
  `idCompetence` bigint NOT NULL AUTO_INCREMENT,
  `nomCompetence` varchar(255) NOT NULL,
  PRIMARY KEY (`idCompetence`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

LOCK TABLES `competences` WRITE;
/*!40000 ALTER TABLE `competences` DISABLE KEYS */;

INSERT INTO `competences` (`idCompetence`, `nomCompetence`) VALUES
	(1, "compétence 1"),
	(2, "python"),
	(3, "java");

/*!40000 ALTER TABLE `competences` ENABLE KEYS */;
UNLOCK TABLES;



# Dump of table daily_result
# ------------------------------------------------------------

DROP TABLE IF EXISTS `daily_result`;

CREATE TABLE `daily_result` (
  `id` int NOT NULL AUTO_INCREMENT,
  `date` datetime NOT NULL,
  `value` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;





# Dump of table doctrine_migration_versions
# ------------------------------------------------------------

DROP TABLE IF EXISTS `doctrine_migration_versions`;

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8mb3_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

LOCK TABLES `doctrine_migration_versions` WRITE;
/*!40000 ALTER TABLE `doctrine_migration_versions` DISABLE KEYS */;

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
	("DoctrineMigrations\\Version20221207223723", "2022-12-07 23:50:50", 1351);

/*!40000 ALTER TABLE `doctrine_migration_versions` ENABLE KEYS */;
UNLOCK TABLES;



# Dump of table evenement
# ------------------------------------------------------------

DROP TABLE IF EXISTS `evenement`;

CREATE TABLE `evenement` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_cate_id` int NOT NULL,
  `id_user_id` int NOT NULL,
  `nom_evenement` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` datetime NOT NULL,
  `etat_evenement` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_B26681EA3ADA195` (`id_cate_id`),
  KEY `IDX_B26681E79F37AE5` (`id_user_id`),
  CONSTRAINT `FK_B26681E79F37AE5` FOREIGN KEY (`id_user_id`) REFERENCES `user` (`id`),
  CONSTRAINT `FK_B26681EA3ADA195` FOREIGN KEY (`id_cate_id`) REFERENCES `categorie_ev` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `evenement` WRITE;
/*!40000 ALTER TABLE `evenement` DISABLE KEYS */;

INSERT INTO `evenement` (`id`, `id_cate_id`, `id_user_id`, `nom_evenement`, `description`, `image`, `date`, `etat_evenement`) VALUES
	(2, 1, 1, "React summittttttttt", "react summit with facebook developers", "/tmp/php08lUor", "2023-01-01 13:04:00", "en cours"),
	(3, 1, 1, "React summittttttttt", "react summit with facebook developers", "/tmp/phpIozieP", "2023-01-01 13:04:00", "en cours"),
	(4, 1, 1, "React", "React SUmmit", "Emploi-639190e4a440e.png", "2023-01-01 18:00:00", "en cours");

/*!40000 ALTER TABLE `evenement` ENABLE KEYS */;
UNLOCK TABLES;



# Dump of table examen
# ------------------------------------------------------------

DROP TABLE IF EXISTS `examen`;

CREATE TABLE `examen` (
  `idExamen` bigint NOT NULL AUTO_INCREMENT,
  `nomExamen` varchar(255) NOT NULL,
  `pourcentage` double NOT NULL,
  `DureeExamen` int NOT NULL,
  `formationId` bigint DEFAULT NULL,
  `idcategorie` bigint DEFAULT NULL,
  PRIMARY KEY (`idExamen`),
  KEY `Examen_fk1` (`idcategorie`),
  KEY `Examen_fk0` (`formationId`)
) ENGINE=MyISAM AUTO_INCREMENT=48 DEFAULT CHARSET=latin1;

LOCK TABLES `examen` WRITE;
/*!40000 ALTER TABLE `examen` DISABLE KEYS */;

INSERT INTO `examen` (`idExamen`, `nomExamen`, `pourcentage`, `DureeExamen`, `formationId`, `idcategorie`) VALUES
	(8, "EXAMEN JAVA 8", 70, 10, 1, 2),
	(31, "examen 1 ", 60, 12, 3, 1),
	(20, "Examen HTML", 70, 10, 2, 2),
	(25, "exam python ", 50, 120, 3, 1),
	(26, "JS", 75, 23, 8, 5),
	(44, "frensh", 80, 120, 10, 6),
	(28, "examen math", 12, 12, 5, 5),
	(30, "EXAM FRANCAIS", 70, 32, 3, 1),
	(45, "exam 4", 12, 12, 1, 4);

/*!40000 ALTER TABLE `examen` ENABLE KEYS */;
UNLOCK TABLES;



# Dump of table formation
# ------------------------------------------------------------

DROP TABLE IF EXISTS `formation`;

CREATE TABLE `formation` (
  `idFormation` bigint NOT NULL AUTO_INCREMENT,
  `Sujet` varchar(255) NOT NULL,
  `Description` varchar(255) NOT NULL,
  `difficulte` varchar(255) DEFAULT NULL,
  `duree` int NOT NULL,
  `idPrerequis` bigint DEFAULT NULL,
  `idCompetence` bigint DEFAULT NULL,
  `idExamen` bigint DEFAULT NULL,
  `idCategorie` bigint DEFAULT NULL,
  PRIMARY KEY (`idFormation`),
  KEY `Formation_fk0` (`idPrerequis`),
  KEY `Formation_fk1` (`idCompetence`),
  KEY `Formation_fk2` (`idExamen`),
  KEY `Formation_fk3` (`idCategorie`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

LOCK TABLES `formation` WRITE;
/*!40000 ALTER TABLE `formation` DISABLE KEYS */;

INSERT INTO `formation` (`idFormation`, `Sujet`, `Description`, `difficulte`, `duree`, `idPrerequis`, `idCompetence`, `idExamen`, `idCategorie`) VALUES
	(3, "formation python", "code", "difficile", 2, 1, 1, 20, 2),
	(18, "Python", "Python Language", "difficile", 12, 2, 2, 25, 2),
	(15, "formationn", "description 5", "moyen", 12, 2, 2, 8, 2);

/*!40000 ALTER TABLE `formation` ENABLE KEYS */;
UNLOCK TABLES;



# Dump of table messages
# ------------------------------------------------------------

DROP TABLE IF EXISTS `messages`;

CREATE TABLE `messages` (
  `idmessage` int NOT NULL AUTO_INCREMENT,
  `idsession_id` int NOT NULL,
  `idsender` int NOT NULL,
  `body` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `statusdate` datetime NOT NULL,
  PRIMARY KEY (`idmessage`),
  KEY `IDX_DB021E96AC96F1E5` (`idsession_id`),
  CONSTRAINT `FK_DB021E96AC96F1E5` FOREIGN KEY (`idsession_id`) REFERENCES `tutorshipsessions` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;





# Dump of table participation
# ------------------------------------------------------------

DROP TABLE IF EXISTS `participation`;

CREATE TABLE `participation` (
  `idParticipation` bigint NOT NULL AUTO_INCREMENT,
  `idUser` bigint DEFAULT NULL,
  `idFormation` bigint DEFAULT NULL,
  `resultat` double DEFAULT NULL,
  `date_part` date DEFAULT NULL,
  PRIMARY KEY (`idParticipation`),
  KEY `Participation_fk0` (`idUser`),
  KEY `Participation_fk1` (`idFormation`)
) ENGINE=MyISAM AUTO_INCREMENT=40 DEFAULT CHARSET=latin1;

LOCK TABLES `participation` WRITE;
/*!40000 ALTER TABLE `participation` DISABLE KEYS */;

INSERT INTO `participation` (`idParticipation`, `idUser`, `idFormation`, `resultat`, `date_part`) VALUES
	(11, 1, 3, 100, "2022-11-27"),
	(10, 2, 15, 70, "2022-11-25"),
	(33, 6, 18, 80, "2022-12-15");

/*!40000 ALTER TABLE `participation` ENABLE KEYS */;
UNLOCK TABLES;



# Dump of table post
# ------------------------------------------------------------

DROP TABLE IF EXISTS `post`;

CREATE TABLE `post` (
  `postID` bigint NOT NULL AUTO_INCREMENT,
  `postTITLE` varchar(255) NOT NULL,
  `postCONTENT` text NOT NULL,
  `userID` int DEFAULT NULL,
  `categoryID` bigint DEFAULT NULL,
  `postVOTE` int NOT NULL,
  `postNBCOM` int NOT NULL,
  `postDATE` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`postID`),
  KEY `fkuser` (`userID`),
  KEY `catfk` (`categoryID`)
) ENGINE=InnoDB AUTO_INCREMENT=61 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

LOCK TABLES `post` WRITE;
/*!40000 ALTER TABLE `post` DISABLE KEYS */;

INSERT INTO `post` (`postID`, `postTITLE`, `postCONTENT`, `userID`, `categoryID`, `postVOTE`, `postNBCOM`) VALUES
	(46, "metier is done", "<p><img alt=\"\" src=\"https://www.google.com/url?sa=i&amp;url=https%3A%2F%2Fwww.wikihow.com%2FGet-the-URL-for-Pictures&amp;psig=AOvVaw31k5QP83vOb4Un7AOtsVwe&amp;ust=1669930306282000&amp;source=images&amp;cd=vfe&amp;ved=0CBAQjRxqFwoTCIir2Kft1vsCFQAAAAAdAAAAABAJ\" /><img alt=\"\" src=\"https://upload.wikimedia.org/wikipedia/commons/thumb/8/85/Smiley.svg/1024px-Smiley.svg.png\" style=\"height:1024px; width:1024px\" /></p>", 1, 28, -1, 0),
	(48, "this post is made by ya boi lil broomstick", "<p><img alt=\"\" src=\"https://symfony.com/images/opengraph/symfony.png\" style=\"height:300px; width:600px\" /></p>", 2, 28, 1, 0),
	(58, "can someone please post the solution to this Query that i have", "<p><span style=\"color:#f1c40f\">i am trying to solve the question using arrays</span> and i am getting stuck/error at the array initialization in the init function. I dont know what to do and need help.</p>\r\n\r\n<p>Here is my code. Feel free to work on it:</p>", 1, 27, -1, 3),
	(59, "Remove link from image using python", "<p><span style=\"color:#3498db\">There is an image embedded with an hyperlink in a docx, how do I remove the link from that image using python?</span></p>\r\n\r\n<p><span style=\"color:#3498db\">Can anyone help me with the code for this problem?</span></p>", 2, 27, 0, 0),
	(60, "how to package all parameters as one?", "<p><span style=\"color:#e74c3c\">I always import one function.py to do some special calculate,</span></p>\r\n\r\n<p><span style=\"color:#e74c3c\">one day I found this function.py have steps of read files, that means, every time I call this function, function.py will open several excel files.</span></p>\r\n\r\n<p><img alt=\"\" src=\"https://www.mssqltips.com/tipimages2/7169_define-call-python-functions.003.png\" style=\"height:142px; width:402px\" /></p>", 3, 27, 0, 0);

/*!40000 ALTER TABLE `post` ENABLE KEYS */;
UNLOCK TABLES;



# Dump of table prerequis
# ------------------------------------------------------------

DROP TABLE IF EXISTS `prerequis`;

CREATE TABLE `prerequis` (
  `idPrerequis` bigint NOT NULL AUTO_INCREMENT,
  `nomPrerequis` varchar(255) NOT NULL,
  PRIMARY KEY (`idPrerequis`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

LOCK TABLES `prerequis` WRITE;
/*!40000 ALTER TABLE `prerequis` DISABLE KEYS */;

INSERT INTO `prerequis` (`idPrerequis`, `nomPrerequis`) VALUES
	(1, "html"),
	(2, "POO");

/*!40000 ALTER TABLE `prerequis` ENABLE KEYS */;
UNLOCK TABLES;



# Dump of table question
# ------------------------------------------------------------

DROP TABLE IF EXISTS `question`;

CREATE TABLE `question` (
  `idQuestion` bigint NOT NULL AUTO_INCREMENT,
  `ennonce` varchar(500) NOT NULL,
  `option1` varchar(500) NOT NULL,
  `option2` varchar(500) NOT NULL,
  `option3` varchar(500) NOT NULL,
  `answer` varchar(500) NOT NULL,
  `idExamen` bigint DEFAULT NULL,
  PRIMARY KEY (`idQuestion`),
  KEY `Question_fk0` (`idExamen`)
) ENGINE=MyISAM AUTO_INCREMENT=52 DEFAULT CHARSET=latin1;

LOCK TABLES `question` WRITE;
/*!40000 ALTER TABLE `question` DISABLE KEYS */;

INSERT INTO `question` (`idQuestion`, `ennonce`, `option1`, `option2`, `option3`, `answer`, `idExamen`) VALUES
	(1, "q1", "OPTION 1", "OPTION 2", "OPTION  3", "OPTION  3", 1),
	(2, "q2", "OPTION 1", "OPTION 2", "OPTION  3", "OPTION 2", 1),
	(3, "q3", "OPTION 1", "OPTION 2", "OPTION  3", "OPTION  3", 1),
	(4, "how old are you ?", "option 1", "option 2", "option 3", "10", 3),
	(5, "question 1", "option 1", "option 2", "option 3", "o22", 4),
	(6, "question 222", "option 1", "option 2", "option 3", "t3", 4),
	(7, "question html 1", "option 1", "option 2", "option 3", "1", 5),
	(8, "QUESTION 2  HTML", "option 1", "option 2", "option 3", "2", 5),
	(9, "what java version doo we use  ? ", "8", "9", "10", "8", 6),
	(30, "gf", "hyt", "hyth", "hyt", "hyt", 5),
	(11, "java ", "8", "98", "10", "8", 7),
	(12, "java ", "8", "98", "10", "8", 7),
	(13, "java ", "8", "98", "10", "8", 7),
	(14, "Comment afficher le nom de la classe instanciée ?", "this.className()", "this.getName()", "this.Class()", "this.className()", 8),
	(15, "Quelle classe fondamentale ne nécessite pas l\'instruction \"import\" car celui-ci est fait automatiquement ?", "java.io", "java.lang", "java.main", "java.io", 8),
	(16, "Dans la ligne \"public class A implements B\", B est ", "une interfaceune ", "une classe", "une extension", "une interfaceune", 8),
	(22, "333", "option 1", "option 2", "option 3", "333", 9),
	(21, "2222", "option 1", "option 2", "option 3", "222", 9),
	(20, "11111", "option 1", "option 2", "option 3", "111", 9),
	(23, "", "option 1", "option 2", "option 3", "", 9),
	(24, "111", "option 1", "option 2", "option 3", "1", 10),
	(25, "22", "option 1", "option 2", "option 3", "22", 10),
	(26, "222", "option 1", "option 2", "option 3", "222", 10),
	(27, "111", "111", "11", "11", "11", 11),
	(28, "222", "1112222", "11222", "11222", "11222", 11),
	(29, "22233", "111222233", "11222333", "112223333", "11222333", 11),
	(31, "232", "option 1", "option 2", "option 3", "F", 19),
	(32, "REFER", "option 1", "option 2", "option 3", "DED", 19),
	(33, "DFF", "option 1", "option 2", "option 3", "FE", 19),
	(34, "Quelle organisation définit les standards Web?", "Apple Inc.", " IBM Corporation.", "World Wide Web Consortium", "World Wide Web Consortium", 20),
	(35, "HTML est considéré comme ______ ?", "Langage de programmation.", "Langage POO.", "Langage de balisage.", "Langage de balisage.", 20),
	(36, " HTML utilise des ______?", "Balises définis par l’utilisateur.", "Balises prédéfinis.", "Balises fixes définis par le langage.", "Balises fixes définis par le langage.", 20),
	(37, " HTML a été proposé pour la première fois l’année ___.", "1990", "1980", "2000", "1990", 20),
	(38, "L’environnement du base de données dans Oracle est appelé ___________ ?", "option 1", "option 2", "option 3", "Structure de donnée", 21),
	(39, "Quelle est la plus petite unité de stockage dans une base de données Oracle?", "option 1", "option 2", "option 3", "Bloc de données", 21),
	(40, "Une collection d’informations stockées dans une base de données à un moment donné est appelée ____________ ?", "option 1", "option 2", "option 3", "Instance du base de donnée", 21),
	(41, "AAAAA", "AA", "AA", "AA", "", 24),
	(42, "Python est un langage _______?", "interprété", "machine", "compilé", "interprété", 25),
	(43, "Laquelle des fonctions suivantes convertit un « string » en « float » en python?", "str(x)", "float(x)", "long(x [,base] )", "float(x)", 25),
	(44, "En python 3, que fait l’opérateur // ?", "Division entière", "Retourne le reste", "idem a ** b", "Division entière", 25),
	(45, "1–2", "-1", "0", "2", "-1", 28),
	(46, "Q1", "1", "2", "3", "1", 30),
	(47, "2", "11", "22", "333", "11", 30),
	(48, "question 1", "reponse 1", "reponse 2", "reponse \"", "reponse 1", 31),
	(49, "question 2", "option &d", "d", "dd", "d", 31),
	(50, "ref", "rg", "ryr", "", "rg", 31),
	(51, "srg", "gsg", "gsg", "s", "gsg", 31);

/*!40000 ALTER TABLE `question` ENABLE KEYS */;
UNLOCK TABLES;



# Dump of table reclamation
# ------------------------------------------------------------

DROP TABLE IF EXISTS `reclamation`;

CREATE TABLE `reclamation` (
  `idReclamation` bigint NOT NULL AUTO_INCREMENT,
  `sujet` varchar(150) NOT NULL,
  `description` varchar(500) NOT NULL,
  `dateRec` date DEFAULT NULL,
  `idUser` bigint DEFAULT NULL,
  PRIMARY KEY (`idReclamation`)
) ENGINE=MyISAM AUTO_INCREMENT=47 DEFAULT CHARSET=latin1;

LOCK TABLES `reclamation` WRITE;
/*!40000 ALTER TABLE `reclamation` DISABLE KEYS */;

INSERT INTO `reclamation` (`idReclamation`, `sujet`, `description`, `dateRec`, `idUser`) VALUES
	(13, "ma réclamation", "kdkkdkd", "2022-11-17", NULL),
	(42, "réclamation 1", "ddddd", "2022-11-24", 1),
	(41, "aggaga", "jjdjdjd", "2022-11-24", 2),
	(8, "site contient des beugs", "interface non convviale ", "2022-10-26", NULL),
	(9, "reclamation 1", "objet 1", "2022-10-27", NULL),
	(10, "fff", "fff", "2022-11-16", 1),
	(11, "sss", "sss", "2022-11-16", 2),
	(12, "ss", "ss", "2022-11-17", 2),
	(14, "d", "dd", "2022-11-17", NULL),
	(15, "s", "s", "2022-11-17", 1),
	(16, "s", "s", "2022-11-17", 1),
	(17, "s", "s", "2022-11-17", 1),
	(18, "ahmed", "gouiaa", "2022-11-17", NULL),
	(35, "ddd", "ddd", "2022-11-20", 1),
	(34, "eee", "eee", "2022-11-20", 1),
	(33, "zzz", "zzz", "2022-11-20", 1),
	(32, "gg", "gg", "2022-11-20", 1),
	(31, "ddd", "dd", "2022-11-20", 1),
	(30, "dfgfgfdg", "fdb", "2022-11-20", 1),
	(36, "ddd", "ddd", "2022-11-20", 1),
	(37, "ddd", "dd", "2022-11-20", 1),
	(38, "eeeeeeeeeee", "eeeeeeeeeeffff", "2022-11-20", 1),
	(39, "hello mr debbiche", "this mail is sent to inform you that your reclamation was sent successfully have a good day ! :D", "2022-11-20", 2),
	(40, "hello mr debbiche", "this mail is sent to inform you that your reclamation was sent successfully have a good day ! :D", "2022-11-20", 2),
	(43, "eee", "<p>ee</p>", "2022-11-24", 1),
	(44, "aggaga", "nnn", "2022-12-07", 4),
	(45, "sujet 1", "desc &", "2022-12-21", 4),
	(46, "aggaga", "nnn", "2022-12-07", 4);

/*!40000 ALTER TABLE `reclamation` ENABLE KEYS */;
UNLOCK TABLES;



# Dump of table recup
# ------------------------------------------------------------

DROP TABLE IF EXISTS `recup`;

CREATE TABLE `recup` (
  `id` int NOT NULL AUTO_INCREMENT,
  `iduser` int NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;





# Dump of table requests
# ------------------------------------------------------------

DROP TABLE IF EXISTS `requests`;

CREATE TABLE `requests` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_tutor_id` int DEFAULT NULL,
  `id_student_id` int NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `body` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_7B85D65170548864` (`id_tutor_id`),
  KEY `IDX_7B85D6516E1ECFCD` (`id_student_id`),
  CONSTRAINT `FK_7B85D6516E1ECFCD` FOREIGN KEY (`id_student_id`) REFERENCES `user` (`id`),
  CONSTRAINT `FK_7B85D65170548864` FOREIGN KEY (`id_tutor_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;





# Dump of table reservation
# ------------------------------------------------------------

DROP TABLE IF EXISTS `reservation`;

CREATE TABLE `reservation` (
  `id_reservation` int NOT NULL AUTO_INCREMENT,
  `date_reservation` date NOT NULL,
  `id_evenement` int NOT NULL,
  `id_utilisateur` int NOT NULL,
  PRIMARY KEY (`id_reservation`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `reservation` WRITE;
/*!40000 ALTER TABLE `reservation` DISABLE KEYS */;

INSERT INTO `reservation` (`id_reservation`, `date_reservation`, `id_evenement`, `id_utilisateur`) VALUES
	(1, "2022-12-08", 2, 5);

/*!40000 ALTER TABLE `reservation` ENABLE KEYS */;
UNLOCK TABLES;



# Dump of table token
# ------------------------------------------------------------

DROP TABLE IF EXISTS `token`;

CREATE TABLE `token` (
  `id` int NOT NULL AUTO_INCREMENT,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `refresh` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;





# Dump of table tutorshipsessions
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tutorshipsessions`;

CREATE TABLE `tutorshipsessions` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_student_id` int DEFAULT NULL,
  `id_tutor_id` int DEFAULT NULL,
  `id_request_id` int DEFAULT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` datetime NOT NULL,
  `body` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_6C7DB1BDE7F43872` (`id_request_id`),
  KEY `IDX_6C7DB1BD6E1ECFCD` (`id_student_id`),
  KEY `IDX_6C7DB1BD70548864` (`id_tutor_id`),
  CONSTRAINT `FK_6C7DB1BD6E1ECFCD` FOREIGN KEY (`id_student_id`) REFERENCES `user` (`id`),
  CONSTRAINT `FK_6C7DB1BD70548864` FOREIGN KEY (`id_tutor_id`) REFERENCES `user` (`id`),
  CONSTRAINT `FK_6C7DB1BDE7F43872` FOREIGN KEY (`id_request_id`) REFERENCES `requests` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;





# Dump of table user
# ------------------------------------------------------------

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` json NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'User',
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_naissance` date NOT NULL,
  `approved` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_8D93D649F85E0677` (`username`),
  UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;

INSERT INTO `user` (`id`, `nom`, `prenom`, `username`, `email`, `image`, `roles`, `role`, `password`, `date_naissance`, `approved`) VALUES
	(1, "admin", "admin", "admin", "admin@admin.com", "1.jpg", "[]", "Admin", "fec79a625cf074ea4e73bf6bb3bbada7f1ba98b2f7e18dbd02ec79cfb4317d82", "2022-12-07", 1),
	(2, "tutor", "tutor", "tutor", "tutor@admin.com", "2.jpg", "[]", "Tutor", "fec79a625cf074ea4e73bf6bb3bbada7f1ba98b2f7e18dbd02ec79cfb4317d82", "2022-12-07", 1),
	(3, "student", "student", "student", "student@admin.com", "3.jpg", "[]", "Student", "fec79a625cf074ea4e73bf6bb3bbada7f1ba98b2f7e18dbd02ec79cfb4317d82", "2022-12-07", 1),
	(6, "q", "q", "q", "q@q.q", "4.jpg", "[]", "User", "fec79a625cf074ea4e73bf6bb3bbada7f1ba98b2f7e18dbd02ec79cfb4317d82", "2023-07-21", 1);

/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;



# Dump of table vote
# ------------------------------------------------------------

DROP TABLE IF EXISTS `vote`;

CREATE TABLE `vote` (
  `voteID` bigint NOT NULL AUTO_INCREMENT,
  `userID` bigint NOT NULL,
  `postID` bigint NOT NULL,
  `votenb` int NOT NULL,
  PRIMARY KEY (`voteID`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

LOCK TABLES `vote` WRITE;
/*!40000 ALTER TABLE `vote` DISABLE KEYS */;

INSERT INTO `vote` (`voteID`, `userID`, `postID`, `votenb`) VALUES
	(6, 1, 8, -1),
	(7, 1, 7, -1),
	(8, 1, 9, 1),
	(9, 1, 18, -1),
	(10, 1, 17, 1),
	(11, 7, 20, 1),
	(12, 1, 21, -1),
	(13, 1, 24, -1),
	(14, 1, 23, 1),
	(15, 1, 25, -1),
	(16, 2, 58, 1),
	(17, 2, 61, 1),
	(18, 3, 58, -1),
	(19, 3, 60, -1),
	(20, 3, 62, 1),
	(21, 1, 58, -1);

/*!40000 ALTER TABLE `vote` ENABLE KEYS */;
UNLOCK TABLES;



# Dump of table votecomment
# ------------------------------------------------------------

DROP TABLE IF EXISTS `votecomment`;

CREATE TABLE `votecomment` (
  `votecommentID` bigint NOT NULL AUTO_INCREMENT,
  `userID` bigint NOT NULL,
  `commentID` bigint NOT NULL,
  `votenb` int NOT NULL,
  PRIMARY KEY (`votecommentID`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

LOCK TABLES `votecomment` WRITE;
/*!40000 ALTER TABLE `votecomment` DISABLE KEYS */;

INSERT INTO `votecomment` (`votecommentID`, `userID`, `commentID`, `votenb`) VALUES
	(7, 1, 3, 1),
	(8, 1, 6, -1),
	(9, 1, 9, -1),
	(10, 1, 11, 1),
	(11, 2, 19, -1),
	(12, 2, 20, 1);

/*!40000 ALTER TABLE `votecomment` ENABLE KEYS */;
UNLOCK TABLES;



# Dump of views
# ------------------------------------------------------------

# Creating temporary tables to overcome VIEW dependency errors


/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

# Dump completed on 2022-12-08T09:10:59+01:00
