
-- --------------------------------------------------------

--
-- Structure de la table `ecom_client`
--

DROP TABLE IF EXISTS `ecom_client`;
CREATE TABLE IF NOT EXISTS `ecom_client` (
  `id` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `ville` varchar(70) NOT NULL,
  `pays` varchar(70) NOT NULL,
  `adresse` varchar(150) NOT NULL,
  `dateDeNaissance` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `ecom_client`
--

INSERT INTO `ecom_client` (`id`, `nom`, `prenom`, `ville`, `pays`, `adresse`, `dateDeNaissance`) VALUES
(1, 'Binaud', 'David', 'Teyran', 'France', '98 rue des tanks', '1995-05-22'),
(2, 'Sarlin', 'Corentin', 'Cournon', 'France', '12 rue de la galinette', '2000-05-16');
