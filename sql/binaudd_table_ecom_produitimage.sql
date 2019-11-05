
-- --------------------------------------------------------

--
-- Structure de la table `ecom_produitimage`
--

DROP TABLE IF EXISTS `ecom_produitimage`;
CREATE TABLE IF NOT EXISTS `ecom_produitimage` (
  `idProduit` int(11) NOT NULL,
  `pathImgProduit` varchar(500) NOT NULL,
  UNIQUE KEY `idProduit` (`idProduit`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `ecom_produitimage`
--

INSERT INTO `ecom_produitimage` (`idProduit`, `pathImgProduit`) VALUES
(1, 'src/Cromwell.jpg'),
(2, 'src/M4-SHERMAN.jpg'),
(3, 'src/Panzerkampfwagen-V.jpg');
