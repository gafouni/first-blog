-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mer. 10 août 2022 à 08:08
-- Version du serveur :  10.4.16-MariaDB
-- Version de PHP : 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `firstblog`
--

-- --------------------------------------------------------

--
-- Structure de la table `comment`
--

CREATE TABLE `comment` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `content` text NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `active` tinyint(1) NOT NULL,
  `id_post` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `comment`
--

INSERT INTO `comment` (`id`, `date`, `content`, `name`, `email`, `active`, `id_post`) VALUES
(1, '2022-03-08', 'Perso, je prefererai toujours Safari.', 'Safari for life', 'sfl@blog.com', 1, 1),
(2, '2022-03-12', 'Merci pour toutes ces precisions sur le mode developpeur des androids, c\'est tres instructif.', 'Marco', 'marco@blog.com', 1, 2),
(6, '2022-07-13', 'Merci pour cet article', 'Superhero', 'sph@blog.com', 1, 2),
(9, '2022-08-03', 'J\'utilise déjà ces deux outils, ils sont très performants', 'Naruto', 'naruto@blog.com', 1, 3),
(10, '2022-08-03', 'La qualité du code est primordiale !!', 'Cleancode', 'cleancode@blog.com', 1, 3),
(11, '2022-08-06', 'Merci pour cet article, il est très utile', 'Gafouni', 'gafou@blog.com', 1, 3);

-- --------------------------------------------------------

--
-- Structure de la table `message`
--

CREATE TABLE `message` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `date` datetime NOT NULL,
  `subject` varchar(255) NOT NULL,
  `content` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `message`
--

INSERT INTO `message` (`id`, `name`, `email`, `date`, `subject`, `content`) VALUES
(1, 'Elodie Janvier', 'elo@blog.com', '2022-03-21 08:44:36', 'Votre CV', 'Je n\'arrive pas a consulter votre cv.'),
(2, 'Bruno Hubot', 'bh@blog.com', '2022-03-06 08:46:17', 'Appel telephonique', 'Bonjour,\r\nJe voudrais un rendez-vous pour un appel telephonique avec vous s\'il vous plait, merci par avance'),
(4, 'Vanessa Martin', 'vm@blog.com', '2022-07-21 10:06:42', 'Devenir membre', 'Comment fait on pour devenir membre ?'),
(5, 'Rose Sabine', 'rs@blog.com', '2022-08-08 10:35:27', 'Nouvel article', 'Bonjour, comment faire pour vous proposer un article ?');

-- --------------------------------------------------------

--
-- Structure de la table `post`
--

CREATE TABLE `post` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `author` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `active` varchar(1) NOT NULL,
  `published` date NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `post`
--

INSERT INTO `post` (`id`, `title`, `date`, `author`, `content`, `active`, `published`, `id_user`) VALUES
(1, 'Chrome devient le navigateur web le plus rapide devant Safari ', '2022-03-08', 'Arthur Aballéa pour le BDM', 'D’après le compteur de vitesse Speedometer, développé par Apple, Google Chrome a dépassé Safari en termes de rapidité.\r\nChrome 99 a obtenu le plus haut score de rapidité dans l\'indicateur de vitesse d\'Apple. © prima91 - stock.adobe.com\r\nEngagés dans une compétition permanente, les navigateurs web mettent en place de nombreuses optimisations pour être les plus rapides possibles. Grâce à plusieurs modifications du code, mais également de la méthode de compilation, Google Chrome est devenu le navigateur web le plus rapide, détrônant Safari.\r\nInitialement détenu par Safari avec un score de 277 (sur un MacBook Pro M1 Max), le record de rapidité a été largement battu par Chrome, qui franchit une barre symbolique en atteignant un score de 300, grâce à sa version M99. Selon Google, le navigateur web aurait réussi à obtenir ce score grâce à plusieurs optimisations du compilateur.\r\nD’après les mesures, la vitesse de Chrome est supérieure à celle de Safari d’environ 7 %, et les performances graphiques sont supérieures d’environ 15 % lorsque ThinLTO est combiné avec des « optimisations graphiques du décodeur pass-through et de la rastérisation OOP ».\r\n', '1', '2022-05-22', 1),
(2, 'Android : comment activer des options cachées via le mode développeur ', '2022-03-09', 'Arthur Aballéa pour le BDM', 'Découvrez comment activer et désactiver le mode développeur sur votre appareil Android, pour afficher un menu d’options cachées.\r\nQu’est-ce que le mode développeur sur Android ?\r\nAssez peu connu du grand public, le mode développeur permet aux utilisateurs Android d’accéder à un menu de fonctionnalités cachées. Comme son nom l’indique, il est principalement destiné aux développeurs et aux amateurs de nouvelles technologies. Il n’est pas activé par défaut, mais reste accessible à tous depuis les paramètres.\r\nComment activer le mode développeur sur Android ?\r\nSimple à activer, mais suffisamment bien caché pour ne pas l’être par erreur, le mode développeur se trouve dans les paramètres de votre smartphone Android. La procédure varie légèrement selon les marques.\r\nSamsung et Xiaomi\r\nPour les Samsung Galaxy, Galaxy Note et les Xiaomi, voici la procédure pour accéder au mode développeur :\r\n•	Rendez vous dans Paramètres,\r\n•	Sélectionnez l’onglet À propos du téléphone,\r\n•	Cliquez sur Informations sur le logiciel,\r\n•	Tapotez 7 fois d’affilée sur l’onglet Numéro de version (Samsung) ou Version MIUI (Xiaomi), qui devrait afficher le message suivant après 3 clics : « Il vous reste 4 étapes avant de devenir développeur »,\r\n•	Validez la procédure en saisissant votre code de déverrouillage quand le téléphone vous le demande.\r\nLorsque le message « Le mode développeur a été activé »  s’affiche, vous avez désormais accès aux paramètres dans l’onglet Options de développement, situé en bas des paramètres généraux.\r\n', '1', '2022-03-30', 3),
(3, 'Deux outils pour tester la qualité et les performances de votre site web', '2022-01-17', 'Foreachcode.com (Extrait d’article)', 'W3C Validator\r\n\r\nLe W3C est un organisme de standardisation à but non lucratif fondé en 1994, il est en charge d\'uniformiser comment les navigateurs web interprètent les technologies du web, et ce afin d\'éviter d\'avoir à créer un site web par navigateur. Cet organisme a développé un outil de test (W3C Validator) très utile pour vérifier que le code de son site web ne soit pas ou ne va pas devenir obsolète. Les « Errors » vont provoquer des problèmes de lecture et de compréhension des navigateurs. Cela peut impacter le visuel du site et son référencement. Les « Warnings » sont des morceaux de code qui vont dysfonctionner dans les prochains mois lorsque les navigateurs arrêteront de maintenir ces éléments. Si vous trouvez une «Fatal error », c’est le pire scénario, il y a une erreur assez problématique dans votre code qui empêche une bonne lecture de celui-ci.\r\n\r\nGTmetrix\r\n\r\nGTmetrix est un outil qui permet de tester votre site web sur un certain nombre de critères, tels que le temps de chargement, l’optimisation de vos pages, l’utilisation des bonnes pratiques de développement, le nombre de requêtes effectuées au serveur ou encore le temps avant l’affichage d’un contenu lisible. Pour avoir une bonne expérience utilisateur, votre site web ou application devrait mettre moins de 1,2 secondes pour s’afficher. Si ce n’est pas le cas, cela peut être due à des pages trop lourdes ou encore un serveur qui n’est pas assez puissant. Vous recevrez une note, plus elle est proche de A, mieux c’est pour l’optimisation de votre site web. Si votre score est mauvais, cela induit un site lent avec une expérience utilisateur moins bonne et cela induit forcément un référencement qui sera plus difficile à mettre en place. Sachez que si votre site est long à charger sur mobile, il perdra en référencement car les moteurs de recherche sont plus exigeants sur mobile (MobileFirst) que sur PC.\r\n', '1', '2022-04-03', 1),
(19, 'Jointure SQL', '2021-06-20', 'AA academie', 'Les jointures en SQL permettent d’associer plusieurs tables dans une même requête. Cela permet d\'exploiter la puissance des bases de données relationnelles pour obtenir des résultats qui combinent les données de plusieurs tables en même temps de manière efficace. Dans ce chapitre, nous aborderons deux types de jointures différents avec les commandes SQL suivantes : INNER JOIN et LEFT JOIN.', '1', '2022-08-02', 10),
(20, 'GitHub Copilot est disponible pour tous les développeurs', '2022-06-22', 'Arthur Aballéa pour le BDM', 'Dévoilé en juin 2021, GitHub Copilot est un outil basé sur l’IA qui permet de suggérer des lignes de code et des fonctions pour faciliter le développement. Il est alimenté par Codex, le nouveau système d’IA proposé par OpenAI. Auparavant disponible uniquement dans Visual Studio, et réservé à une poignée d’utilisateurs, il est désormais accessible à tous les développeurs.', '1', '2022-08-02', 15),
(21, 'La SNCF expérimente la vidéo intelligente', '2022-06-29', 'Aurélie Chandeze pour LMI', 'Sur le salon Vivatech, qui s\'est tenu Porte de Versailles du 15 au 18 juin 2022, la SNCF accueillait sur son stand la société XXII, un acteur spécialisé dans l\'analyse par ordinateur de flux vidéo, une technologie également connue sous le nom de vidéo intelligence. Le groupe, à travers sa direction de la sûreté, a mené plusieurs expérimentations autour de ces technologies, pour évaluer comment celles-ci peuvent répondre à différents cas d\'usage, notamment dans le domaine de la sûreté des voyageurs. ', '1', '2022-08-02', 15),
(22, 'Comment réussir la création de son site WordPress ?', '2021-05-07', 'Sakhavat Seyidmammadov De Webalia ', 'Découvrez comment créer ou recréer un site WordPress en X étapes indispensables pour offrir à vos visiteurs un site clair, où l’expérience utilisateur est optimisée et où se reflète, page après page, votre sérieux et votre professionnalisme.\r\n', '1', '2022-08-02', 15),
(23, 'Développeurs : des apprenants aux professionnels, mêmes outils ?', '2021-06-23', 'Clément Bohic pour Silicon', 'Dans quelle mesure les développeurs de métier se servent-ils des mêmes outils que ceux qui apprennent à coder ? Éléments de réponse à partir du sondage annuel de Stack Overflow.\r\nJavaScript, HTML, CSS : un trio toujours référent', '1', '2022-08-03', 5),
(24, 'Visual Studio Code : une version web made in Microsoft', '2021-10-25', 'Clément Bohic pour Silicon', 'Après github.dev en août, Microsoft ouvre vscode.dev. Comment se présente cette version web de l’éditeur Visual Studio Code ?\r\n\r\n« Visual Studio Code (Preview). N’importe où, n’importe quand, entièrement dans votre navigateur. » Depuis quelques jours, ce message s’affiche lorsqu’on se rend sur vscode.dev. Et avec lui, effectivement, une version web de l’éditeur. Sans back-end, toutefois. Donc sans possibilité de compiler, d’exécuter et de déboguer des applications. Pour le moment, en tout cas*.', '1', '2022-08-03', 5),
(25, 'Comment sécuriser votre navigation sur Internet ?', '2021-06-02', ' TEAM LESLEUDIS ', 'À l’heure où la cyber-criminalité est en hausse, nos données n’ont jamais été autant exposées. Découvrez les bonnes pratiques à mettre en place pour préserver votre vie privée et vous protéger des publicités intrusives.\r\nActiver le pare-feu (firewall)\r\nUtiliser un moteur de recherche sécurisé\r\nUtiliser un VPN', '1', '2022-08-03', 5),
(26, 'Comment apprendre le développement web sans expérience en informatique', '2022-08-03', 'Simon Gabin', 'C\'est une des questions qui revient fréquemment, pour y répondre, il est important de commencer par tester le métier en faisant une immersion de quelques jours. Plusieurs entreprises proposent ce genre de prestations.', '0', '2022-08-03', 13),
(27, 'La TO-DO List, outil indispensable pour réussir sa formation', '2022-07-29', 'Simon Gabin', 'Réussir sa formation demande une organisation rigoureuse, pour ne pas être submerge par la liste souvent longue des taches a effectuer. La TO-DO List doit être le compagnon fidèle du quotidien de tout étudiant. Elle doit impérativement être mise a jour a la fin de chaque journée de travail, pour être efficace.\r\n', '0', '2022-08-03', 13),
(28, 'WhatsApp pourrait enfin permettre de modifier ses messages', '2022-06-01', 'Alexandra Patard pour le BDM', 'Alors qu’un même type de bouton est actuellement testé du côté de Twitter, WhatsApp pourrait ainsi satisfaire ses plus de 2 milliards d’utilisateurs dans le monde en l’intégrant au sein d’une future mise à jour de l’app sur Android, iOS et desktop.\r\nReste à savoir dans quelle mesure il sera possible d’éditer son texte, et surtout dans quelle limite de temps, afin de ne pas « manipuler » son destinataire en modifiant son message après sa lecture.', '1', '2022-08-03', 10),
(29, 'Comment supprimer ou désactiver un compte LinkedIn', '2022-07-27', 'Héloïse Famié-Galtier ', 'La fermeture de votre compte LinkedIn entraîne la suppression définitive de votre profil et de votre accès à toutes vos informations sur le réseau social.\r\n\r\nPour supprimer votre compte LinkedIn :\r\n\r\nCliquez sur votre image de profil, en haut à droite de la page d’accueil de LinkedIn,\r\nDans le menu déroulant, sélectionnez Préférences et confidentialités,\r\nDans la section Préférences du compte (colonne latérale droite), scrollez jusqu’à Gestion du compte,\r\nSélectionnez Fermer le compte,\r\nChoisissez une raison pour la suppression de votre compte, puis cliquez sur Suivant,\r\nEntrez votre mot de passe, puis cliquez sur Fermer le compte.', '1', '2022-08-03', 10),
(30, '3 formations pour apprendre la cybersécurité', '2022-07-20', 'Audrey Lamy', 'Manager en infrastructures et cybersécurité des systèmes d’information avec CESI École de Formation des Managers\r\nDurée : 42 jours\r\nType d’enseignement : En centre • En entreprise\r\n\r\nMaster Cybersécurité avec Webitech\r\nDurée : 2 ans\r\nType d’enseignement : En alternance • En centre\r\n\r\nMBA Management de la cybersécurité avec Institut Léonard de Vinci\r\nDurée : 399 jours\r\nType d’enseignement : En alternance • En centre\r\n', '0', '2022-08-03', 10),
(31, 'L\'importance des compétences relationnelles en entreprise', '2022-06-06', 'Audrey Lamy', 'Pour évoluer dans l\'entreprise le savoir être est tout aussi important que le savoir faire. Les compétences relationnelles ci dessous sont essentielles pour le travail en équipe:\r\nLe leadership permet de motiver les gens a atteindre leurs objectifs\r\nLa communication écrite ou la capacité a écrire des documents professionnels\r\nLa collaboration, indispensable pour le travail collectif, en équipe\r\nLe mentorat permet le partage des connaissances et des compétences\r\nLa résolution des conflits', '1', '2022-08-03', 10),
(32, 'Qu’est-ce que le format d\'image WebP ?', '2022-08-01', 'Audrey Lamy', 'Le format d\'image WebP a été développé par Google en 2010, l\'objectif étais de remplacer JPG, PNG et GIF.\r\nIl vise à offrir une compression avec ou sans perte, afin de réduire significativement le poids des fichiers image. Ainsi, une compression avec perte au format WebP donne une image 26 % plus légère qu’une image PNG, et entre 25 à 34 % pour un visuel au format JPG.  L’objectif de Google : rendre les pages web plus rapide. Le format WebP est notamment pris en charge de manière native par les navigateurs web Google Chrome, Safari, Firefox, Microsoft Edge ou encore Opera.', '0', '2022-08-03', 10),
(33, 'Pour un week end studieux a Paris', '2022-08-02', 'Audrey Lamy', 'Tous les vendredi, je vous donnerai la liste des évènements tech pour développeurs qui se tiennent a Paris, soyez au rendez-vous.', '0', '2022-08-03', 10),
(34, 'Un été a Marseille', '2022-08-07', 'Eric Fassy', 'Salut a tous, et si on codais depuis la cite phocéenne, Marseille la belle !', '0', '2022-08-08', 5);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `first_name`, `last_name`, `email`, `password`, `status`) VALUES
(1, 'Jacques', 'Deschamps', 'jd@blog.com', '$2y$10$wN89nTq.ulOkrXD3TGRHTeDWON60z6iVOozP6INK1aSjcF7aClbde', NULL),
(3, 'Sylvie', 'Noel', 'sn@blog.com', '$2y$10$tE3Fu3y1kdeEgS03/gqWW./LQkRRLZTpxNzMjGwXLWVBJCPe0LTJe', NULL),
(5, 'Eric', 'Fassy', 'ef@blog.com', '$2y$10$6fOE1dAL3hBPcKhehv5KJefUkGWJk05DQAIu1tgFlwA6jW90My5Z.', NULL),
(6, 'Jeanne', 'Moro', 'jm@blog.com', '$2y$10$xvhG0.dPTOb9rw/P4nR7geuOJRAPOTjFBDBPpI17S5eJMttU5KKvK', NULL),
(7, 'Robert', 'Pineau', 'rp@blog.com', '$2y$10$GDdMIjUl3bDiJ7n2uO/Eyule38/eJeK7gqolv6QtLpJ5lsnj2KPPO', NULL),
(8, 'Nathalie', 'Colart', 'nc@blog.com', '$2y$10$YPZNU0734CdDZNpG1KkvO.MhbmyKWfV94uCbNDuiJ/0DGgYN4ESaG', NULL),
(9, 'Michel', 'Blanc', 'mb@blog.com', '$2y$10$/5/6vmmOZf/JwixMjRYH/u2WfatQJ3r6HU3zys/YAXlF3I7aowDF.', NULL),
(10, 'Audrey', 'Lamy', 'alamy@blog.com', '$2y$10$D4V1nruYYUZErt.1D515tulFM2eoUC.vuM5hn3LUPiuP.dowHc.Eq', 'ROLE_ADMIN'),
(11, 'Jean', 'Do', 'jdo@blog.com', '$2y$10$DkeeYvebffAZouhE/8LnMemLc1YOuXlMUqY1aZRvQ6dPE7D.RIF5a', NULL),
(12, 'Audrey', 'Lamy', 'alamy@blog.com', '$2y$10$JCpAGBOfVSfVRo1zDQTJmONDLv3f.y6E57rxa95.lJwHhyZswSRfm', NULL),
(13, 'Simon', 'Gabin', 'sgabin@blog.com', '$2y$10$x1ry/1MjnjU9yxXdwI1ouucNWLJsLZAfVnBASxkftvLRyWBpKkwF2', NULL),
(14, 'Sylvie', 'Noel', 'sn@blog.com', '$2y$10$fE0za7JCYisz3VOBl/W8h.tNrj8WFW/yDESUdpQSwlZUPdahPE4QO', NULL),
(15, 'Jean', 'Billot', 'jb@blog.com', '$2y$10$5T3GsCGe5Nzy0uFa2EII6.GfUW8EuvQ88QscMUOabMsQjqf08wicW', NULL),
(16, 'Jonas', 'Robois', 'jr@blog.com', '$2y$10$bibFC6lS7NmTvglg2MaJse0s1kJcbB8L7PLyvJ2gEkPmVNLhv4zji', NULL),
(17, 'Trevis', 'Leroi', 'tl@blog.com', '$2y$10$a/khHMxEdwm0leaedvjof.Qtps3igAzbcxH0DFo01nqGCTtsb0Ma6', NULL),
(18, 'Marie', 'Asso', 'ma@blog.com', '$2y$10$bl5N0q4FR5uQlPUn4vMGheAmpK88ODaVnR9antViU//iAUtqm6m8i', NULL),
(19, 'Martin', 'Leblanc', 'ml@blog.com', '$2y$10$IQY5BQTFrN91RFO1YQciMeQFiS8QnS86L.ea0Pl3DgZr7PDa.HjSG', NULL);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_post` (`id_post`);

--
-- Index pour la table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `message`
--
ALTER TABLE `message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `post`
--
ALTER TABLE `post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`id_post`) REFERENCES `post` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `post_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
