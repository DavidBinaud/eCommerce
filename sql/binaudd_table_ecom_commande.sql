
-- --------------------------------------------------------

--
-- Structure de la table `ecom_commande`
--

DROP TABLE IF EXISTS `ecom_commande`;
CREATE TABLE IF NOT EXISTS `ecom_commande` (
  `id` int(11) NOT NULL,
  `quantite` int(11) NOT NULL,
  `prix` float NOT NULL,
  `dateDeCommande` date NOT NULL,
  `idClient` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `ecom_commande`
--

INSERT INTO `ecom_commande` (`id`, `quantite`, `prix`, `dateDeCommande`, `idClient`) VALUES
(1, 1, 28000, '2019-10-16', 1),
(2, 10, 3130000, '2019-10-15', 2);
