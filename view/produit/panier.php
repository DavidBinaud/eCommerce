<?php
	if ($panier_is_empty) {
		echo "Panier vide";
	}else{
		echo '<p>';
		foreach ($panier['produits'] as $lignepanier) {
			foreach ($lignepanier as $produit => $qté) {
				echo " $produit $qté";
			}
			echo "<br>";
		}
		echo "Montant total du panier : {$_SESSION['prixTotal']} € <br> 

				<a class='waves-effect waves-light btn grey darken-1 '  href='index.php?action=viderpanier&controller=produit'><i class='material-icons left'>remove_shopping_cart</i>Vider Panier</a>
				<a class='waves-effect waves-light btn grey darken-1' href='index.php?action=created&controller=commande'><i class='material-icons left'>add_shopping_cart</i>Passer Commande</a>
				</p>";
	}



?>