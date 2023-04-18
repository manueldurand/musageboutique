-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mer. 29 mars 2023 à 09:26
-- Version du serveur : 10.4.25-MariaDB
-- Version de PHP : 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `lafleur`
--

-- --------------------------------------------------------

--
-- Structure de la table `lafleur_categories`
--

CREATE TABLE `lafleur_categories` (
  `id_categorie` bigint(20) UNSIGNED NOT NULL,
  `libelle` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `lafleur_clients`
--

CREATE TABLE `lafleur_clients` (
  `id` bigint(20) NOT NULL,
  `nom` varchar(45) NOT NULL,
  `prenom` varchar(45) NOT NULL,
  `pseudo` varchar(45) NOT NULL,
  `mdp` varchar(64) NOT NULL,
  `email` varchar(100) NOT NULL,
  `adresse` text NOT NULL,
  `complement_adresse` text DEFAULT NULL,
  `cp` varchar(5) NOT NULL,
  `ville` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `lafleur_clients`
--

INSERT INTO `lafleur_clients` (`id`, `nom`, `prenom`, `pseudo`, `mdp`, `email`, `adresse`, `complement_adresse`, `cp`, `ville`) VALUES
(1, 'Durand', 'Manuel', 'manumuz', '$2y$10$t.eOFQlosbPb7Nj8jkxEW.bIhgth3BDjNqVFZwJC2oE7LFrB4ig9q', 'manumuz@mailo.com', '78 zeiugi', '', '45123', 'Montpellier');

-- --------------------------------------------------------

--
-- Structure de la table `lafleur_couleurs`
--

CREATE TABLE `lafleur_couleurs` (
  `id_couleur` bigint(20) UNSIGNED NOT NULL,
  `nom_couleur` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `lafleur_couleurs`
--

INSERT INTO `lafleur_couleurs` (`id_couleur`, `nom_couleur`) VALUES
(1, 'bleu'),
(2, 'rouge'),
(3, 'orange'),
(4, 'blanc'),
(5, 'jaune');

-- --------------------------------------------------------

--
-- Structure de la table `lafleur_failed_jobs`
--

CREATE TABLE `lafleur_failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `lafleur_password_reset_tokens`
--

CREATE TABLE `lafleur_password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `lafleur_personal_access_tokens`
--

CREATE TABLE `lafleur_personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `lafleur_produits`
--

CREATE TABLE `lafleur_produits` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nom_produit` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `couleur_id` bigint(20) UNSIGNED NOT NULL DEFAULT 1,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` enum('unité','bouquet','gerbe') COLLATE utf8mb4_unicode_ci NOT NULL,
  `prix` decimal(5,2) NOT NULL DEFAULT 9.99,
  `stock` bigint(20) NOT NULL DEFAULT 0,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'default.png',
  `mise à jour` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `lafleur_produits`
--

INSERT INTO `lafleur_produits` (`id`, `nom_produit`, `couleur_id`, `description`, `type`, `prix`, `stock`, `image`, `mise à jour`) VALUES
(1, 'sunt officiis', 4, 'et incidunt culpa labore aspernatur et est reprehenderit qui eum vitae repudiandae nostrum aperiam reiciendis', 'unité', '9.99', 100, 'default.png', NULL),
(2, 'ad non', 1, 'eos ut temporibus mollitia est dolor nihil laboriosam modi magni ea deleniti ea autem doloremque', 'unité', '9.99', 100, 'default.png', NULL),
(3, 'fuga adipisci', 2, 'libero dolorem quo accusamus possimus quod aperiam ducimus quia sit eaque expedita dolor at voluptas', 'unité', '9.99', 100, 'default.png', NULL),
(4, 'provident perferendis', 1, 'quam accusamus ratione necessitatibus dolorem eius dolor omnis animi voluptas deserunt et est doloribus explicabo', 'unité', '9.99', 100, 'default.png', NULL),
(5, 'possimus consequatur', 3, 'provident perspiciatis omnis voluptatem dolores tempore quibusdam et quos ea et quis consectetur adipisci magnam', 'unité', '9.99', 100, 'default.png', NULL),
(6, 'iusto culpa', 1, 'molestias qui magnam nihil numquam quis magni aut rerum et corporis provident reiciendis ut commodi', 'unité', '9.99', 100, 'default.png', NULL),
(7, 'sit possimus', 2, 'harum corporis voluptatibus quas necessitatibus aut et voluptatem eum ut totam exercitationem quo non ea', 'unité', '9.99', 100, 'default.png', NULL),
(8, 'cumque consequatur', 1, 'ratione nesciunt eos accusantium fuga ab minima omnis blanditiis quo nulla aperiam consequatur est ratione', 'unité', '9.99', 100, 'default.png', NULL),
(9, 'voluptates officia', 1, 'debitis atque labore et accusantium consequatur qui vel vel necessitatibus eos quia est dolores totam', 'unité', '9.99', 100, 'default.png', NULL),
(10, 'laborum saepe', 1, 'dicta veniam aut fugit corporis molestiae architecto amet et esse et debitis cumque dolor alias', 'unité', '6.99', 100, 'default.png', NULL),
(11, 'rose', 1, 'ffjffjj\r\n\r\nqoihsoih sqoih \r\n\r\nEZ Oize f zio f  ZE Fougzzmpaip era\r\n\r\nze fpIUZGE OUHZ ËOFUHQ SDVQ ZIUFH ÜZBMVQKHSGMDF Q QV MQUHSDMQH SDOUVH ZEJFBkqhsgdmfiuq mkrng qmk jsddmkjbq:krjhmiudf  q ùoigjs dfgkjwhodrgh qmwviuhr gqd', 'unité', '4.99', 3, 'une_rose_rose.png', NULL),
(12, 'lys', 4, 'issu des profondeurs de la grotte', 'bouquet', '29.99', 20, 'cmp_bouquet_lys.png', NULL),
(13, 'Orchidée rose du Kenya', 5, 'Lorenz  ezire z eorhzoi \r\nJIzie hzoihqo  aoiejrgohe gh e\r\n\r\naeorihoaieh rgioheonmzeohrgo A eorigzoiehrg moeigh^zortkndeeihgjeighri  eoghrih mzorijbpdçngptùhtnç retz\'n gçzeritnz g', '', '59.99', 30, 'orchidee_rose.jpg', '2023-03-25 20:33:55');

-- --------------------------------------------------------

--
-- Structure de la table `lafleur_produits_categories`
--

CREATE TABLE `lafleur_produits_categories` (
  `produit_id` bigint(20) UNSIGNED NOT NULL,
  `categorie_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `lafleur_users`
--

CREATE TABLE `lafleur_users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `lafleur_users`
--

INSERT INTO `lafleur_users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Lois Altenwerth', 'kendrick.lehner@example.com', '2023-02-17 21:48:52', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'fU5POC0WC0', '2023-02-17 21:48:52', '2023-02-17 21:48:52'),
(2, 'Hyman Barton DDS', 'schimmel.izabella@example.com', '2023-02-17 21:48:52', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'vu679cDwdL', '2023-02-17 21:48:52', '2023-02-17 21:48:52'),
(3, 'Dagmar Mann', 'zhomenick@example.net', '2023-02-17 21:48:52', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'mlCSUoN2w1', '2023-02-17 21:48:52', '2023-02-17 21:48:52'),
(4, 'Tabitha King', 'zschneider@example.com', '2023-02-17 21:48:52', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'SGH1rlcXos', '2023-02-17 21:48:52', '2023-02-17 21:48:52'),
(5, 'Mr. Jarrett Gottlieb', 'emie.breitenberg@example.net', '2023-02-17 21:48:52', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'yMjJ0MDMqU', '2023-02-17 21:48:52', '2023-02-17 21:48:52'),
(6, 'Mrs. Effie Lakin', 'guiseppe.trantow@example.org', '2023-02-17 21:48:52', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'v9SAzXknnk', '2023-02-17 21:48:52', '2023-02-17 21:48:52'),
(7, 'Clotilde Sawayn', 'sauer.destinee@example.com', '2023-02-17 21:48:52', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '3gplomoxFo', '2023-02-17 21:48:52', '2023-02-17 21:48:52'),
(8, 'Danielle Bahringer', 'fweimann@example.com', '2023-02-17 21:48:52', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '0nLRJrcfDc', '2023-02-17 21:48:52', '2023-02-17 21:48:52'),
(9, 'Arlie Strosin V', 'boehm.kane@example.net', '2023-02-17 21:48:52', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '353wOXI3or', '2023-02-17 21:48:52', '2023-02-17 21:48:52'),
(10, 'Miss Janis Thiel', 'lizeth77@example.com', '2023-02-17 21:48:52', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'kDRJDHAAEr', '2023-02-17 21:48:52', '2023-02-17 21:48:52'),
(11, 'Test User', 'test@example.com', '2023-02-17 21:48:52', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'mK4Y2ecwoU', '2023-02-17 21:48:52', '2023-02-17 21:48:52'),
(12, 'coco', 'coco@gmail.com', NULL, '$2y$10$r2SmHUuwRtn1G7D8ygwyBeo.8eNQKcD.KnaJOG1AUxcflpQf.sOXO', NULL, '2023-02-17 21:49:26', '2023-02-17 21:49:26'),
(13, 'coco', 'coco@mailo.com', NULL, '$2y$10$iRDILhf5amINEgtONR8uA.GXaE7p3kjKCrNCrJCSTAaigUCEL4oka', NULL, '2023-02-23 13:55:36', '2023-02-23 13:55:36');

-- --------------------------------------------------------

--
-- Structure de la table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_02_13_060623_create_lafleur_couleurs_table', 1),
(6, '2023_02_14_054223_create_lafleur_categories_table', 1),
(7, '2023_02_14_152425_create_lafleur_produits_table', 1),
(8, '2023_02_15_061116_create_lafleur_produits_categories_table', 1);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `lafleur_categories`
--
ALTER TABLE `lafleur_categories`
  ADD PRIMARY KEY (`id_categorie`);

--
-- Index pour la table `lafleur_clients`
--
ALTER TABLE `lafleur_clients`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `lafleur_couleurs`
--
ALTER TABLE `lafleur_couleurs`
  ADD PRIMARY KEY (`id_couleur`);

--
-- Index pour la table `lafleur_failed_jobs`
--
ALTER TABLE `lafleur_failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `lafleur_failed_jobs_uuid_unique` (`uuid`);

--
-- Index pour la table `lafleur_password_reset_tokens`
--
ALTER TABLE `lafleur_password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Index pour la table `lafleur_personal_access_tokens`
--
ALTER TABLE `lafleur_personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `lafleur_personal_access_tokens_token_unique` (`token`),
  ADD KEY `lafleur_personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Index pour la table `lafleur_produits`
--
ALTER TABLE `lafleur_produits`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lafleur_produits_couleur_id_foreign` (`couleur_id`);

--
-- Index pour la table `lafleur_produits_categories`
--
ALTER TABLE `lafleur_produits_categories`
  ADD PRIMARY KEY (`produit_id`,`categorie_id`),
  ADD KEY `lafleur_produits_categories_categorie_id_foreign` (`categorie_id`);

--
-- Index pour la table `lafleur_users`
--
ALTER TABLE `lafleur_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `lafleur_users_email_unique` (`email`);

--
-- Index pour la table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `lafleur_categories`
--
ALTER TABLE `lafleur_categories`
  MODIFY `id_categorie` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `lafleur_clients`
--
ALTER TABLE `lafleur_clients`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `lafleur_couleurs`
--
ALTER TABLE `lafleur_couleurs`
  MODIFY `id_couleur` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `lafleur_failed_jobs`
--
ALTER TABLE `lafleur_failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `lafleur_personal_access_tokens`
--
ALTER TABLE `lafleur_personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `lafleur_produits`
--
ALTER TABLE `lafleur_produits`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT pour la table `lafleur_users`
--
ALTER TABLE `lafleur_users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT pour la table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `lafleur_produits`
--
ALTER TABLE `lafleur_produits`
  ADD CONSTRAINT `lafleur_produits_couleur_id_foreign` FOREIGN KEY (`couleur_id`) REFERENCES `lafleur_couleurs` (`id_couleur`);

--
-- Contraintes pour la table `lafleur_produits_categories`
--
ALTER TABLE `lafleur_produits_categories`
  ADD CONSTRAINT `lafleur_produits_categories_categorie_id_foreign` FOREIGN KEY (`categorie_id`) REFERENCES `lafleur_categories` (`id_categorie`),
  ADD CONSTRAINT `lafleur_produits_categories_produit_id_foreign` FOREIGN KEY (`produit_id`) REFERENCES `lafleur_produits` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
