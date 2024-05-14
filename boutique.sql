-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 03, 2024 at 09:58 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `boutique`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `parent_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `parent_id`) VALUES
(1, 'Chaise gaming', 1);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` int NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `mail` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `adresse` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `postal_code` varchar(5) COLLATE utf8mb4_general_ci NOT NULL,
  `city` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `phone` varchar(14) COLLATE utf8mb4_general_ci NOT NULL,
  `role` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(100) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `first_name`, `last_name`, `mail`, `adresse`, `postal_code`, `city`, `phone`, `role`, `password`) VALUES
(1, 'Prénomtest', 'NOMTEST', 'test@test.test', '01 route du test\r\n', '01234', 'VILLETEST', '0123456789', 'client', '123'),
(2, 'Admin', 'ISTRATEUR', 'admin@admin.admin', '404 route des admins', '77777', 'ADMINCITY', '9876543210', 'admin', '123');

-- --------------------------------------------------------

--
-- Table structure for table `image`
--

CREATE TABLE `image` (
  `id` int NOT NULL,
  `url` tinytext COLLATE utf8mb4_general_ci NOT NULL,
  `main` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `image`
--

INSERT INTO `image` (`id`, `url`, `main`) VALUES
(1, 'product_1_image_1.jpg', 0),
(2, 'product_1_image_2.jpg', 0),
(3, 'product_1_main_image.jpg', 1),
(4, 'product_2_image_1.jpg', 0),
(5, 'product_2_image_2.jpg', 0),
(6, 'product_2_image_3.jpg', 0),
(7, 'product_2_main_image.jpg', 1),
(8, 'product_3_main_image.jpg', 1),
(9, 'product_4_main_image.jpg', 1),
(10, 'product_5_main_image.jpg', 1),
(11, 'product_6_main_image.jpg', 1),
(12, 'product_7_main_image.jpg', 1),
(13, 'product_8_main_image.jpg', 1),
(14, 'product_9_main_image.jpg', 1),
(15, 'product_10_main_image.jpg', 1),
(16, 'product_3_image_1.jpg', 0),
(18, 'product_4_image_1.jpg', 0),
(19, 'product_5_image_1.jpg', 0),
(20, 'product_6_image_1.jpg', 0),
(21, 'product_7_image_1.jpg', 0),
(22, 'product_8_image_1.jpg', 0),
(23, 'product_9_image_1.jpg', 0),
(24, 'product_10_image_1.jpg', 0),
(25, 'product_3_image_2.jpg', 0),
(26, 'product_4_image_2.jpg', 0),
(27, 'product_5_image_2.jpg', 0),
(28, 'product_6_image_2.jpg', 0),
(29, 'product_7_image_2.jpg', 0),
(30, 'product_8_image_2.jpg', 0),
(31, 'product_9_image_2.jpg', 0),
(32, 'product_10_image_2.jpg', 0),
(33, 'product_3_image_3.jpg', 0),
(34, 'product_3_image_4.jpg', 0),
(35, 'product_4_image_3.jpg', 0),
(36, 'product_4_image_4.jpg', 0),
(37, 'product_5_image_3.jpg', 0),
(38, 'product_6_image_3.jpg', 0),
(39, 'product_6_image_4.jpg', 0),
(40, 'product_7_image_3.jpg', 0),
(41, 'product_8_image_3.jpg', 0),
(42, 'product_9_image_3.jpg', 0),
(43, 'product_10_image_3.jpg', 0);

-- --------------------------------------------------------

--
-- Table structure for table `image_product`
--

CREATE TABLE `image_product` (
  `product_id` int NOT NULL,
  `image_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `image_product`
--

INSERT INTO `image_product` (`product_id`, `image_id`) VALUES
(2, 1),
(2, 2),
(2, 3),
(3, 4),
(3, 5),
(3, 6),
(3, 7),
(4, 8),
(5, 9),
(6, 10),
(7, 11),
(8, 12),
(9, 13),
(10, 14),
(11, 15),
(4, 16),
(5, 18),
(6, 19),
(7, 20),
(8, 21),
(9, 22),
(10, 23),
(11, 24),
(4, 25);

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `id` int NOT NULL,
  `stripe_id` tinytext COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_cutomer`
--

CREATE TABLE `order_cutomer` (
  `order_id` int NOT NULL,
  `customer_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_product`
--

CREATE TABLE `order_product` (
  `order_id` int NOT NULL,
  `product_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `rate` float NOT NULL,
  `price` float NOT NULL,
  `quantity` int NOT NULL,
  `description` text COLLATE utf8mb4_general_ci NOT NULL,
  `color` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `material` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `brand` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `category_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `name`, `rate`, `price`, `quantity`, `description`, `color`, `material`, `brand`, `category_id`) VALUES
(2, 'Chaise de jeu ergonomique avec repose-pieds', 0, 249.99, 20, 'La chaise gaming  est dotée d\\\'un support lombaire amovible, qui peut protéger efficacement la colonne vertébrale et le cou. L\\\'oreiller lombaire avec fonction de massage produit plus de 20000 vibrations par heure pour soulager efficacement la fatigue pendant un travail ou un gaming. L\\\'oreiller lombaire a un câble USB pour se connecter à la prise de courant. L\\\'interrupteur sur le cordon vous permet d\\\'activer et de désactiver la fonction de massagePOSTURE CONFORTABLE - Il s\\\'agit d\\\'une véritable chaise gamer pour les passionnés de gamers! Ce chaise gaming massante offre un soutien total de la tête aux pieds. L\\\'angle du dossier peut être facilement ajusté de 90° à 135°. Le repose-pieds, l\\\'appui-tête et l\\\'oreiller lombaire vous permettent de vous allonger en attendant que votre fête soit enfin en ligne. Le dossier et les accoudoirs sont entièrement rembourrés de éponge pour fournir un soutien adéquat pour la colonne vertébrale et les coudes REMBOURRÉ - Le dossier et les accoudoirs sont en éponge entièrement élastique et ne se déforment pas, vous pouvez donc profiter longtemps de cette siege gaming. La selle est en éponge de 8 cm d\\\'épaisseur qui offre une densité d\\\'assise constante pour les longues sessions. Le cuir PU perforé avec un aspect fibre de carbone assure la respirabilité pour les joueurs à long terme. Nos chaise gaming massage avec motif en V de l\\\'appui-tête au soutien lombaire, symbolisant la victoire\'', 'Rouge', 'Cuir PU', 'ProGamer', 1),
(3, 'Chaise de gaming haute performance', 0, 199.99, 20, 'Confort similaire au canapé : le coussin d\\\'assise de cette chaise de jeu est composé de ressorts ensachés et de mousse moulée qui assurent la même élasticité et le même confort qu\\\'un canapé. Les ressorts répartissent mieux la pression sur le coussin d\\\'assise et rendent la conduite plus confortable et ergonomique.Tissu hautement respirant : le matériau de surface de la chaise de jeu est composé d\\\'un tissu en maille hautement respirant avec une bonne dissipation de la chaleur. Même en été chaud, vous ne vous sentirez pas étouffé lorsque vous êtes assis sur la chaise. En outre, ce tissu est plus élastique et le corps est soutenu lorsque vous êtes assis, ce qui permet un travail plus efficace.[Garantie de haute qualité] Nous avons amélioré la fixation du dossier de cette table de jeu et de cette chaise. Le dossier est fixé avec des plaques en acier et résiste aux chocs de plus de 300 livres. Les vis de fixation ont une forme triangulaire, ce qui améliore considérablement la stabilité du dossier.', 'Vert', 'Mesh respirant', 'ProGamer', 1),
(4, 'Chaise de jeu racing style avec support lombaire', 0, 179.99, 20, 'La chaise gaming  est dotée d\\\'un support lombaire amovible, qui peut protéger efficacement la colonne vertébrale et le cou. L\\\'oreiller lombaire avec fonction de massage produit plus de 20000 vibrations par heure pour soulager efficacement la fatigue pendant un travail ou un gaming. L\\\'oreiller lombaire a un câble USB pour se connecter à la prise de courant. L\\\'interrupteur sur le cordon vous permet d\\\'activer et de désactiver la fonction de massagePOSTURE CONFORTABLE - Il s\\\'agit d\\\'une véritable chaise gamer pour les passionnés de gamers! Ce chaise gaming massante offre un soutien total de la tête aux pieds. L\\\'angle du dossier peut être facilement ajusté de 90° à 135°. Le repose-pieds, l\\\'appui-tête et l\\\'oreiller lombaire vous permettent de vous allonger en attendant que votre fête soit enfin en ligne. Le dossier et les accoudoirs sont entièrement rembourrés de éponge pour fournir un soutien adéquat pour la colonne vertébrale et les coudes REMBOURRÉ - Le dossier et les accoudoirs sont en éponge entièrement élastique et ne se déforment pas, vous pouvez donc profiter longtemps de cette siège gaming. La selle est en éponge de 8 cm d\\\'épaisseur qui offre une densité d\\\'assise constante pour les longues sessions. Le cuir PU perforé avec un aspect fibre de carbone assure la respirabilité pour les joueurs à long terme. Nos chaise gaming massage avec motif en V de l\\\'appui-tête au soutien lombaire, symbolisant la victoire', 'Noir', 'Cuir PU', 'SpeedMaster', 1),
(5, 'Chaise de gaming XL pour les joueurs sérieux', 0, 299.99, 20, 'Confort similaire au canapé : le coussin d\\\'assise de cette chaise de jeu est composé de ressorts ensachés et de mousse moulée qui assurent la même élasticité et le même confort qu\\\'un canapé. Les ressorts répartissent mieux la pression sur le coussin d\\\'assise et rendent la conduite plus confortable et ergonomique.Tissu hautement respirant : le matériau de surface de la chaise de jeu est composé d\\\'un tissu en maille hautement respirant avec une bonne dissipation de la chaleur. Même en été chaud, vous ne vous sentirez pas étouffé lorsque vous êtes assis sur la chaise. En outre, ce tissu est plus élastique et le corps est soutenu lorsque vous êtes assis, ce qui permet un travail plus efficace.[Garantie de haute qualité] Nous avons amélioré la fixation du dossier de cette table de jeu et de cette chaise. Le dossier est fixé avec des plaques en acier et résiste aux chocs de plus de 300 livres. Les vis de fixation ont une forme triangulaire, ce qui améliore considérablement la stabilité du dossier.', 'Noir', 'Cuir PU', 'EliteGamer', 1),
(6, 'Chaise de bureau gaming professionnelle', 0, 229.99, 20, 'La chaise gaming  est dotée d\\\'un support lombaire amovible, qui peut protéger efficacement la colonne vertébrale et le cou. L\\\'oreiller lombaire avec fonction de massage produit plus de 20000 vibrations par heure pour soulager efficacement la fatigue pendant un travail ou un gaming. L\\\'oreiller lombaire a un câble USB pour se connecter à la prise de courant. L\\\'interrupteur sur le cordon vous permet d\\\'activer et de désactiver la fonction de massagePOSTURE CONFORTABLE - Il s\\\'agit d\\\'une véritable chaise gamer pour les passionnés de gamers! Ce chaise gaming massante offre un soutien total de la tête aux pieds. L\\\'angle du dossier peut être facilement ajusté de 90° à 135°. Le repose-pieds, l\\\'appui-tête et l\\\'oreiller lombaire vous permettent de vous allonger en attendant que votre fête soit enfin en ligne. Le dossier et les accoudoirs sont entièrement rembourrés de éponge pour fournir un soutien adéquat pour la colonne vertébrale et les coudes REMBOURRÉ - Le dossier et les accoudoirs sont en éponge entièrement élastique et ne se déforment pas, vous pouvez donc profiter longtemps de cette siège gaming. La selle est en éponge de 8 cm d\\\'épaisseur qui offre une densité d\\\'assise constante pour les longues sessions. Le cuir PU perforé avec un aspect fibre de carbone assure la respirabilité pour les joueurs à long terme. Nos chaise gaming massage avec motif en V de l\\\'appui-tête au soutien lombaire, symbolisant la victoire', 'Gris', 'Mesh respirant', 'MasterGamer', 1),
(7, 'Chaise de jeu convertible en lit', 0, 349.99, 20, 'Confort similaire au canapé : le coussin d\\\'assise de cette chaise de jeu est composé de ressorts ensachés et de mousse moulée qui assurent la même élasticité et le même confort qu\\\'un canapé. Les ressorts répartissent mieux la pression sur le coussin d\\\'assise et rendent la conduite plus confortable et ergonomique.Tissu hautement respirant : le matériau de surface de la chaise de jeu est composé d\\\'un tissu en maille hautement respirant avec une bonne dissipation de la chaleur. Même en été chaud, vous ne vous sentirez pas étouffé lorsque vous êtes assis sur la chaise. En outre, ce tissu est plus élastique et le corps est soutenu lorsque vous êtes assis, ce qui permet un travail plus efficace.[Garantie de haute qualité] Nous avons amélioré la fixation du dossier de cette table de jeu et de cette chaise. Le dossier est fixé avec des plaques en acier et résiste aux chocs de plus de 300 livres. Les vis de fixation ont une forme triangulaire, ce qui améliore considérablement la stabilité du dossier.', 'Gris', 'Tissu', 'DreamGamer', 1),
(8, 'Chaise de gaming rétro avec design vintage', 0, 189.99, 20, '【Plus professionnel】 Conçu pour les joueurs. Le dossier ergonomique peut fournir un bon soutien à la colonne vertébrale du joueur, ce qui peut réduire efficacement la pression sur votre dos et votre cou, vous permettant de vous sentir moins fatigué pendant les longues sessions de jeu.【Plus flexible】 Cette fauteuil gamer de jeu dispose d\\\'une hauteur réglable de 8 cm et d\\\'un angle d\\\'inclinaison de 90° à 135° afin que vous puissiez facilement trouver la position assise qui vous convient. L\\\'angle de pivotement de 360° vous permet de vous déplacer librement.【Des matériaux de meilleure qualité】 Le coussin, le dossier, le coussin lombaire et l\\\'appui-tête de la siege gamer de jeu sont tous fabriqués avec un rembourrage en mousse haute densité, et le cuir synthétique durable est facile à nettoyer et résistant à la déformation. Le ressort à gaz haut de gamme peut facilement supporter 120 kg.', 'Rouge', 'Vinyle', 'RetroGamer', 1),
(9, 'Chaise de gaming camouflage', 0, 209.99, 20, 'Confort similaire au canapé : le coussin d\\\'assise de cette chaise de jeu est composé de ressorts ensachés et de mousse moulée qui assurent la même élasticité et le même confort qu\\\'un canapé. Les ressorts répartissent mieux la pression sur le coussin d\\\'assise et rendent la conduite plus confortable et ergonomique.Tissu hautement respirant : le matériau de surface de la chaise de jeu est composé d\\\'un tissu en maille hautement respirant avec une bonne dissipation de la chaleur. Même en été chaud, vous ne vous sentirez pas étouffé lorsque vous êtes assis sur la chaise. En outre, ce tissu est plus élastique et le corps est soutenu lorsque vous êtes assis, ce qui permet un travail plus efficace.[Garantie de haute qualité] Nous avons amélioré la fixation du dossier de cette table de jeu et de cette chaise. Le dossier est fixé avec des plaques en acier et résiste aux chocs de plus de 300 livres. Les vis de fixation ont une forme triangulaire, ce qui améliore considérablement la stabilité du dossier.', 'Vert', 'Cuir PU', 'AdventureGame', 1),
(10, 'Chaise de jeu design futuriste', 0, 399.99, 20, 'La chaise gaming  est dotée d\\\'un support lombaire amovible, qui peut protéger efficacement la colonne vertébrale et le cou. L\\\'oreiller lombaire avec fonction de massage produit plus de 20000 vibrations par heure pour soulager efficacement la fatigue pendant un travail ou un gaming. L\\\'oreiller lombaire a un câble USB pour se connecter à la prise de courant. L\\\'interrupteur sur le cordon vous permet d\\\'activer et de désactiver la fonction de massagePOSTURE CONFORTABLE - Il s\\\'agit d\\\'une véritable chaise gamer pour les passionnés de gamers! Ce chaise gaming massante offre un soutien total de la tête aux pieds. L\\\'angle du dossier peut être facilement ajusté de 90° à 135°. Le repose-pieds, l\\\'appui-tête et l\\\'oreiller lombaire vous permettent de vous allonger en attendant que votre fête soit enfin en ligne. Le dossier et les accoudoirs sont entièrement rembourrés de éponge pour fournir un soutien adéquat pour la colonne vertébrale et les coudes REMBOURRÉ - Le dossier et les accoudoirs sont en éponge entièrement élastique et ne se déforment pas, vous pouvez donc profiter longtemps de cette siège gaming. La selle est en éponge de 8 cm d\\\'épaisseur qui offre une densité d\\\'assise constante pour les longues sessions. Le cuir PU perforé avec un aspect fibre de carbone assure la respirabilité pour les joueurs à long terme. Nos chaise gaming massage avec motif en V de l\\\'appui-tête au soutien lombaire, symbolisant la victoire', 'Noir', 'Cuir PU', 'FuturaGamer', 1),
(11, 'Chaise de gaming avec système de massage intégré', 0, 299.99, 20, '【Plus professionnel】 Conçu pour les joueurs. Le dossier ergonomique peut fournir un bon soutien à la colonne vertébrale du joueur, ce qui peut réduire efficacement la pression sur votre dos et votre cou, vous permettant de vous sentir moins fatigué pendant les longues sessions de jeu.【Plus flexible】 Cette fauteuil gamer de jeu dispose d\\\'une hauteur réglable de 8 cm et d\\\'un angle d\\\'inclinaison de 90° à 135° afin que vous puissiez facilement trouver la position assise qui vous convient. L\\\'angle de pivotement de 360° vous permet de vous déplacer librement.【Des matériaux de meilleure qualité】 Le coussin, le dossier, le coussin lombaire et l\\\'appui-tête de la siege gamer de jeu sont tous fabriqués avec un rembourrage en mousse haute densité, et le cuir synthétique durable est facile à nettoyer et résistant à la déformation. Le ressort à gaz haut de gamme peut facilement supporter 120 kg.', 'Noir', 'Cuir PU', 'RelaxGamer', 1);

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE `review` (
  `product_id` int NOT NULL,
  `customer_id` int NOT NULL,
  `text` text COLLATE utf8mb4_general_ci,
  `rating` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `review`
--

INSERT INTO `review` (`product_id`, `customer_id`, `text`, `rating`) VALUES
(2, 1, 'Au top !', 5),
(2, 2, 'Pas de roulettes motorisées... nul ! ', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`),
  ADD KEY `parent_id` (`parent_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `image`
--
ALTER TABLE `image`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `image_product`
--
ALTER TABLE `image_product`
  ADD PRIMARY KEY (`product_id`,`image_id`),
  ADD KEY `image_id` (`image_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `product_id_2` (`product_id`,`image_id`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_cutomer`
--
ALTER TABLE `order_cutomer`
  ADD PRIMARY KEY (`order_id`,`customer_id`),
  ADD UNIQUE KEY `order_id` (`order_id`,`customer_id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `order_product`
--
ALTER TABLE `order_product`
  ADD PRIMARY KEY (`order_id`,`product_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`product_id`,`customer_id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `product_id` (`product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `image`
--
ALTER TABLE `image`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `category`
--
ALTER TABLE `category`
  ADD CONSTRAINT `category_ibfk_1` FOREIGN KEY (`parent_id`) REFERENCES `category` (`id`);

--
-- Constraints for table `image_product`
--
ALTER TABLE `image_product`
  ADD CONSTRAINT `image_product_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`),
  ADD CONSTRAINT `image_product_ibfk_2` FOREIGN KEY (`image_id`) REFERENCES `image` (`id`);

--
-- Constraints for table `order_cutomer`
--
ALTER TABLE `order_cutomer`
  ADD CONSTRAINT `order_cutomer_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `order` (`id`),
  ADD CONSTRAINT `order_cutomer_ibfk_2` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`);

--
-- Constraints for table `order_product`
--
ALTER TABLE `order_product`
  ADD CONSTRAINT `order_product_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`),
  ADD CONSTRAINT `order_product_ibfk_2` FOREIGN KEY (`order_id`) REFERENCES `order` (`id`);

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`);

--
-- Constraints for table `review`
--
ALTER TABLE `review`
  ADD CONSTRAINT `review_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`),
  ADD CONSTRAINT `review_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
