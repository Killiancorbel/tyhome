-- phpMyAdmin SQL Dump
-- version 4.7.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Mar 25, 2018 at 02:51 PM
-- Server version: 5.6.35
-- PHP Version: 7.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `tyhome`
--

-- --------------------------------------------------------

--
-- Table structure for table `article`
--

CREATE TABLE `article` (
  `id` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `article`
--

INSERT INTO `article` (`id`, `date`, `title`, `content`, `image`) VALUES
(1, '2018-02-07 16:38:10', 'Test', 'Bonjour, ceci est un test', 'https://d284x0ytlho6sy.cloudfront.net/images/400/AB88337_6.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `forename` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `numeroTVA` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `company` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `user_id`, `name`, `forename`, `numeroTVA`, `company`) VALUES
(1, 1, 'Costa', 'Adrien', NULL, 'Axeon'),
(2, 2, 'Corbel', 'Killian', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `content`
--

CREATE TABLE `content` (
  `id` int(11) NOT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `code` longtext COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `content`
--

INSERT INTO `content` (`id`, `type`, `code`) VALUES
(1, 'homepage', 'TyHome est un logiciel de réalité virtuelle à destination des professionnels de l\'aménagement intérieur qui permet leurs clients  de visualiser en réalité virtuelle grâce au port du casque HTC VIVE l\'espace qu\'ils souhaitent aménager.  Le client peut se déplacer dans l\'espace. Via le menu de visualisation d\'objet, le client peut interagir avec les meubles de la scène : choisir ses meubles, déplacer, ouvrir, activer, changer les textures et les couleurs, avoir accès au descriptif de chaque meuble. Un vrai service client et un vrai plus pour activer les ventes. ');

-- --------------------------------------------------------

--
-- Table structure for table `content_video`
--

CREATE TABLE `content_video` (
  `content_id` int(11) NOT NULL,
  `video_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `content_video`
--

INSERT INTO `content_video` (`content_id`, `video_id`) VALUES
(1, 1),
(1, 2),
(1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `documentation`
--

CREATE TABLE `documentation` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `link` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `documentation`
--

INSERT INTO `documentation` (`id`, `name`, `link`) VALUES
(1, '150 mots', '150.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci NOT NULL,
  `price` decimal(6,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `image`, `name`, `description`, `price`) VALUES
(1, 'https://d284x0ytlho6sy.cloudfront.net/images/400/AB88337_6.jpg', 'Pack TyHome + HTC', 'Ce pack comprends une licence TyHome et un HTC Vive', '500.00'),
(2, 'https://www.overclockers.co.uk/media/image/thumbnail/VR005OR_169286_800x800.jpg', 'Pack TyHome + Oculus Rift', 'Ce pack comprends une licence TyHome et un Oculus Rift', '450.00');

-- --------------------------------------------------------

--
-- Table structure for table `software`
--

CREATE TABLE `software` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `link` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `software`
--

INSERT INTO `software` (`id`, `name`, `link`) VALUES
(1, 'PPT Delivery', 'ppt_delivery.pptx');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `salt` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `roles` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `salt`, `roles`) VALUES
(1, 'adrien.costa@gmail.com', 'azerty', '', 'a:1:{i:0;s:9:\"ROLE_USER\";}'),
(2, 'killian.corbel@gmail.com', 'azerty', '', 'a:1:{i:0;s:10:\"ROLE_ADMIN\";}');

-- --------------------------------------------------------

--
-- Table structure for table `video`
--

CREATE TABLE `video` (
  `id` int(11) NOT NULL,
  `source` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `video`
--

INSERT INTO `video` (`id`, `source`, `type`, `description`) VALUES
(1, 'https://www.youtube.com/embed/qGH83SJWoEA?rel=0', 'youtube', 'Trailer tyhome'),
(2, 'https://www.youtube.com/embed/7tkzHSC6jwQ?rel=0', 'youtube', 'trailer Oculus'),
(3, 'https://www.youtube.com/embed/i1r76omNeI8?rel=0', 'youtube', 'trailer HTC Vive');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_C82E74A76ED395` (`user_id`);

--
-- Indexes for table `content`
--
ALTER TABLE `content`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `content_video`
--
ALTER TABLE `content_video`
  ADD PRIMARY KEY (`content_id`,`video_id`),
  ADD KEY `IDX_97048EFE84A0A3ED` (`content_id`),
  ADD KEY `IDX_97048EFE29C1004E` (`video_id`);

--
-- Indexes for table `documentation`
--
ALTER TABLE `documentation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `software`
--
ALTER TABLE `software`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_8D93D649F85E0677` (`username`);

--
-- Indexes for table `video`
--
ALTER TABLE `video`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_7CC7DA2C5F8A7F73` (`source`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `article`
--
ALTER TABLE `article`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `content`
--
ALTER TABLE `content`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `documentation`
--
ALTER TABLE `documentation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `software`
--
ALTER TABLE `software`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `video`
--
ALTER TABLE `video`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `clients`
--
ALTER TABLE `clients`
  ADD CONSTRAINT `FK_C82E74A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `content_video`
--
ALTER TABLE `content_video`
  ADD CONSTRAINT `FK_97048EFE29C1004E` FOREIGN KEY (`video_id`) REFERENCES `video` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_97048EFE84A0A3ED` FOREIGN KEY (`content_id`) REFERENCES `content` (`id`) ON DELETE CASCADE;
