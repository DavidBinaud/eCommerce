
-- --------------------------------------------------------

--
-- Structure de la table `ecom_lignecommande`
--

DROP TABLE IF EXISTS `ecom_lignecommande`;
CREATE TABLE IF NOT EXISTS `ecom_lignecommande` (
  `idCommande` int(11) NOT NULL,
  `idProduit` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
