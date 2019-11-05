
--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `ecom_produitimage`
--
ALTER TABLE `ecom_produitimage`
  ADD CONSTRAINT `ecom_produitimage_ibfk_1` FOREIGN KEY (`idProduit`) REFERENCES `ecom_produit` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
