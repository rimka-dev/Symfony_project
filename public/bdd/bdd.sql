-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Jun 25, 2021 at 02:52 PM
-- Server version: 5.7.32
-- PHP Version: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `bdd_retrocoloc`
--

-- --------------------------------------------------------

--
-- Table structure for table `annonces`
--

CREATE TABLE `annonces` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `type_logement` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prix` int(11) NOT NULL,
  `nbr_chambre` int(11) NOT NULL,
  `spf_chambre` double NOT NULL,
  `chambre_meub` tinyint(1) NOT NULL,
  `nbr_sdb` int(11) NOT NULL,
  `superficie` double NOT NULL,
  `nbr_colocataire` smallint(6) NOT NULL,
  `img1` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `img2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `img3` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `img4` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `animaux` tinyint(1) NOT NULL,
  `animaux_chat` tinyint(1) NOT NULL,
  `animaux_chien` tinyint(1) DEFAULT NULL,
  `animaux_rongeur` tinyint(1) DEFAULT NULL,
  `animaux_autres` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pays` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `region` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ville` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `adresse` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `comp_adresse` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code_postal` int(11) NOT NULL,
  `date_creation` datetime NOT NULL,
  `pref_genre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fumeur` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `annonces`
--

INSERT INTO `annonces` (`id`, `user_id`, `type_logement`, `prix`, `nbr_chambre`, `spf_chambre`, `chambre_meub`, `nbr_sdb`, `superficie`, `nbr_colocataire`, `img1`, `img2`, `img3`, `img4`, `animaux`, `animaux_chat`, `animaux_chien`, `animaux_rongeur`, `animaux_autres`, `pays`, `region`, `ville`, `adresse`, `comp_adresse`, `code_postal`, `date_creation`, `pref_genre`, `description`, `fumeur`) VALUES
(1, 16, 'Maison', 350, 1, 23.2, 0, 2, 56, 1, '13333cc67e82565952e750cdaa8456e4.jpg', NULL, NULL, NULL, 1, 1, 0, 0, NULL, 'France', 'PACA', 'Nice', 'rue jean medecin', NULL, 6200, '2021-06-20 16:15:19', 'Une femme', 'hgghkghkghk', 1),
(2, 16, 'Appartement', 400, 3, 150, 0, 3, 15, 2, '1e754dd881d89963cf5e2d07978740fe.jpg', NULL, NULL, NULL, 1, 0, 1, 0, NULL, 'France', 'ile de france', 'Paris', 'rue toto', NULL, 75006, '2021-06-20 16:16:14', 'Ca m\'est égal', 'dfgdfg', 0),
(10, 25, 'Appartement', 300, 1, 10, 0, 1, 50, 1, 'ea5509714c7a564fe29eea86b4871954.jpg', 'aa191e570bad1b794fc1367cc51f6657.jpg', NULL, NULL, 1, 1, 1, 0, NULL, 'IDF', 'Paris', 'Paris', '100 rue des mouettes', NULL, 75001, '2021-06-22 14:55:21', 'Ca m\'est égal', 'blablahjktoto', 1),
(11, 16, 'Maison', 256, 2, 12, 0, 1, 85, 1, '96d84503acf72251043a042a54169c7a.jpg', NULL, NULL, NULL, 1, 1, 0, 0, NULL, 'France', 'PACA', 'Nice', 'rue jean medecin', 'gfhjghyj', 6230, '2021-06-18 08:59:06', 'Une femme', 'toto tititdfghfdgh', 0),
(12, 16, 'Appartement', 445, 1, 11, 0, 1, 53, 1, '6e23bacd2154e965b1a1990ded722ce5.jpg', '74b05c72acbcd56607cd44ff0fd6f1d1.jpg', '5af47fe29d5c4b645821f85f2e717c1b.jpg', 'c2262241247e28592153c0f4a7c37949.jpg', 0, 1, 0, 0, NULL, 'France', 'ile de france', 'Paris', 'Rue de Paris', 'B', 75010, '2021-06-22 14:25:30', 'Une femme', 'Belle appartement sur paris', 1),
(13, 16, 'Maison', 360, 2, 11, 0, 2, 80, 2, 'a8bd47e12344b493b0fac2c3462e4069.png', NULL, NULL, NULL, 1, 0, 1, 0, NULL, 'France', 'Basse-Normandie', 'Caen', 'Rue des acacias', NULL, 14000, '2021-06-24 08:03:22', 'Ca m\'est égal', 'salut de normandie', 0),
(14, 16, 'Appartement', 325, 1, 10, 0, 1, 54, 1, '381c2cb50f5dac2253b38f2e3411958f.png', NULL, NULL, NULL, 0, 1, 0, 0, NULL, 'France', 'Nord-Pas-de-Calais', 'Lyon', 'rue du paradis', NULL, 6200, '2021-06-24 08:05:37', 'Une femme', 'salut de lyon', 0);

-- --------------------------------------------------------

--
-- Table structure for table `contact_user`
--

CREATE TABLE `contact_user` (
  `id` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `receveur_id` int(11) DEFAULT NULL,
  `date` datetime NOT NULL,
  `sujet` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `message` longtext COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20210611134016', '2021-06-11 13:41:12', 556),
('DoctrineMigrations\\Version20210611140108', '2021-06-11 14:01:30', 87),
('DoctrineMigrations\\Version20210615121624', '2021-06-15 12:17:59', 127);

-- --------------------------------------------------------

--
-- Table structure for table `equipements`
--

CREATE TABLE `equipements` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `equipements`
--

INSERT INTO `equipements` (`id`, `nom`) VALUES
(1, 'Jardin'),
(2, 'Balcon/terrasse'),
(3, 'Climatisation'),
(4, 'Wifi'),
(6, 'Acces PMR'),
(7, 'Salle de bain privative'),
(8, 'Garage'),
(9, 'Parking'),
(10, 'Ascenseur');

-- --------------------------------------------------------

--
-- Table structure for table `equipements_annonces`
--

CREATE TABLE `equipements_annonces` (
  `equipements_id` int(11) NOT NULL,
  `annonces_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `equipements_annonces`
--

INSERT INTO `equipements_annonces` (`equipements_id`, `annonces_id`) VALUES
(1, 10),
(1, 11),
(1, 13),
(2, 1),
(2, 2),
(2, 10),
(2, 12),
(2, 13),
(2, 14),
(3, 1),
(3, 2),
(3, 10),
(3, 11),
(3, 12),
(3, 14),
(4, 1),
(4, 12),
(4, 13),
(6, 10),
(6, 13),
(7, 2),
(7, 13),
(8, 14),
(9, 14);

-- --------------------------------------------------------

--
-- Table structure for table `loisirs`
--

CREATE TABLE `loisirs` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `loisirs`
--

INSERT INTO `loisirs` (`id`, `nom`) VALUES
(1, 'Sport'),
(2, 'Cuisine'),
(5, 'Jeux de société'),
(6, 'Art créatif'),
(7, 'Jardinage'),
(8, 'Randonnées/balades'),
(9, 'Sorties culturelles');

-- --------------------------------------------------------

--
-- Table structure for table `loisirs_annonces`
--

CREATE TABLE `loisirs_annonces` (
  `loisirs_id` int(11) NOT NULL,
  `annonces_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `loisirs_annonces`
--

INSERT INTO `loisirs_annonces` (`loisirs_id`, `annonces_id`) VALUES
(1, 12),
(2, 1),
(2, 2),
(2, 11),
(2, 13),
(2, 14),
(5, 12),
(5, 14),
(6, 2),
(6, 12),
(6, 13),
(7, 2),
(7, 12),
(7, 13),
(8, 10),
(8, 13);

-- --------------------------------------------------------

--
-- Table structure for table `temoignage`
--

CREATE TABLE `temoignage` (
  `id` int(11) NOT NULL,
  `temoin_id` int(11) NOT NULL,
  `hebergeur_id` int(11) DEFAULT NULL,
  `date` datetime NOT NULL,
  `temoignage` longtext COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` json NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `age` smallint(6) NOT NULL,
  `img_avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pays` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `region` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ville` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `adresse_user` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code_postal` int(11) DEFAULT NULL,
  `is_verified` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `email`, `roles`, `password`, `nom`, `prenom`, `age`, `img_avatar`, `pays`, `region`, `ville`, `adresse_user`, `code_postal`, `is_verified`) VALUES
(15, 'momo23@gmail.com', '[]', '$argon2id$v=19$m=65536,t=4,p=1$Rt2CKJRAJJ2XRhDb0DEE9g$eQKL8hT2bSDnvpdLB7/wAfonSymBhn+3wLdR/DqVzMs', 'tototiti', 'Momo', 28, 'Avatar_user_default.png', NULL, NULL, NULL, NULL, NULL, 0),
(16, 'takkakarim1@gmail.com', '[]', '$2y$13$Da8l1kRrYxxIBW2O2jmXaOtWDsXmCsy9xfP6jjnn1rSgRaGKHmoai', 'user', 'user', 30, 'Avatar_user_default.png', NULL, NULL, NULL, NULL, NULL, 0),
(17, 'yulia001@gmail.com', '[]', '$2y$13$fClUGGIbOhGQ8ORsDh5HMeKVhZTHBFGAYHg3.jTiaj/JKZmipo0FO', 'YULIA', 'Yulia', 38, 'Avatar_user_default.png', NULL, NULL, NULL, NULL, NULL, 0),
(18, 'toto76@yopmail.com', '[]', '$2y$13$eRFQbn2kQKJIZ0bKQf0e7.PxsIb.ubfwXUMaWOB3qf026LazKHOIy', 'toto', 'toto', 30, '5c9539bb77726658401720e478afe6bc.', NULL, NULL, NULL, NULL, NULL, 0),
(21, 'toto78@yopmail.com', '[]', '$argon2id$v=19$m=65536,t=4,p=1$rp9lTpcAc3GdRvpVRea5og$3Ya8NtbsdDQ3Xk2w+p9EEJLVeSzcYhg3+oL2pDj9cX8', 'toto', 'toto', 30, '7b4afdf439c66e20be525c547814fecc.', NULL, NULL, NULL, NULL, NULL, 0),
(22, 'salut@salut.com', '[]', '$2y$13$xQzaGON0IHR0lUeEME6vEOmr4ocQzsREtb4Wgxkrt4kLREIWkbnQO', 'Salut', 'Salut', 21, '60cf7ff3498eb9275e6a36c4dd184325.jpg', NULL, NULL, NULL, NULL, NULL, 0),
(23, 'adminhack@admin.com', '[]', '$2y$13$UsKqtmmE0Q7WI3T4SF4T2.lHT6rReheaukoI7aAkDJhuyD1bX.5Eu', 'Admintest', 'adminhack', 24, '7c6751626333b0c97e274d5c5f507158.jpg', NULL, NULL, NULL, NULL, NULL, 0),
(24, 'lefourbefab@yahoo.fr', '[]', '$2y$13$j0pm.qRrb5FDitUPYQWf3u7jYSLL1C4iT5pEckWriXrfsExr2tSSm', 'reddignton', 'predati', 442, 'f9f78858727c2b0bfcf9c6a1bf5ad5ad.jpg', NULL, NULL, NULL, NULL, NULL, 0),
(25, 'k.takka01@gmail.com', '[]', '$2y$13$fZZjZhJTHxDPKzBcr3gIj.d0tqTe6P9W0WtQD5FzMGp/j1Id.kcwq', 'TAKKA', 'Karim', 36, 'd6dc2093d9bf7a3557fc571eeccb2a1d.webp', NULL, NULL, NULL, NULL, NULL, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `annonces`
--
ALTER TABLE `annonces`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_CB988C6FA76ED395` (`user_id`);

--
-- Indexes for table `contact_user`
--
ALTER TABLE `contact_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_A56C54B6F624B39D` (`sender_id`),
  ADD KEY `IDX_A56C54B6B967E626` (`receveur_id`);

--
-- Indexes for table `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `equipements`
--
ALTER TABLE `equipements`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `equipements_annonces`
--
ALTER TABLE `equipements_annonces`
  ADD PRIMARY KEY (`equipements_id`,`annonces_id`),
  ADD KEY `IDX_8C251F8E852CCFF5` (`equipements_id`),
  ADD KEY `IDX_8C251F8E4C2885D7` (`annonces_id`);

--
-- Indexes for table `loisirs`
--
ALTER TABLE `loisirs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `loisirs_annonces`
--
ALTER TABLE `loisirs_annonces`
  ADD PRIMARY KEY (`loisirs_id`,`annonces_id`),
  ADD KEY `IDX_4C41ADD6F5CC4DB6` (`loisirs_id`),
  ADD KEY `IDX_4C41ADD64C2885D7` (`annonces_id`);

--
-- Indexes for table `temoignage`
--
ALTER TABLE `temoignage`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_BDADBC461655312C` (`temoin_id`),
  ADD KEY `IDX_BDADBC4626B797A0` (`hebergeur_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `annonces`
--
ALTER TABLE `annonces`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `contact_user`
--
ALTER TABLE `contact_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `equipements`
--
ALTER TABLE `equipements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `loisirs`
--
ALTER TABLE `loisirs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `temoignage`
--
ALTER TABLE `temoignage`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `annonces`
--
ALTER TABLE `annonces`
  ADD CONSTRAINT `FK_CB988C6FA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `contact_user`
--
ALTER TABLE `contact_user`
  ADD CONSTRAINT `FK_A56C54B6B967E626` FOREIGN KEY (`receveur_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `FK_A56C54B6F624B39D` FOREIGN KEY (`sender_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `equipements_annonces`
--
ALTER TABLE `equipements_annonces`
  ADD CONSTRAINT `FK_8C251F8E4C2885D7` FOREIGN KEY (`annonces_id`) REFERENCES `annonces` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_8C251F8E852CCFF5` FOREIGN KEY (`equipements_id`) REFERENCES `equipements` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `loisirs_annonces`
--
ALTER TABLE `loisirs_annonces`
  ADD CONSTRAINT `FK_4C41ADD64C2885D7` FOREIGN KEY (`annonces_id`) REFERENCES `annonces` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_4C41ADD6F5CC4DB6` FOREIGN KEY (`loisirs_id`) REFERENCES `loisirs` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `temoignage`
--
ALTER TABLE `temoignage`
  ADD CONSTRAINT `FK_BDADBC461655312C` FOREIGN KEY (`temoin_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `FK_BDADBC4626B797A0` FOREIGN KEY (`hebergeur_id`) REFERENCES `user` (`id`);
