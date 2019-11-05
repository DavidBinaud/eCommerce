
-- --------------------------------------------------------

--
-- Structure de la table `ecom_produit`
--

DROP TABLE IF EXISTS `ecom_produit`;
CREATE TABLE IF NOT EXISTS `ecom_produit` (
  `id` int(11) NOT NULL,
  `nom` varchar(40) NOT NULL,
  `description` varchar(300) NOT NULL,
  `prix` float NOT NULL,
  `nationalite` varchar(25) NOT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `ecom_produit`
--

INSERT INTO `ecom_produit` (`id`, `nom`, `description`, `prix`, `nationalite`) VALUES
(1, 'CROMWELL', 'gdqfg', 130, '???'),
(2, 'M4-SHERMAN', 'lel,vb,nnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnn', 15000, 'USA'),
(3, 'Panzerkampfwagen V', ' c\'est un char de combat moyen utilisé par l\'armée allemande pendant la Seconde Guerre mondiale', 150000, 'Allemande');
