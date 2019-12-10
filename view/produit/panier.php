<?php
	var_dump($_SESSION['panier']);
	if (isset($_SESSION) && isset($_SESSION['panier'])) {
		echo '<p>';
		foreach ($panier as $lignepanier) {
			foreach ($lignepanier as $produit => $qté) {
				echo " $produit $qté";
			}
			echo "<br>";
		}
		echo "Montant total du panier : {$_SESSION['prixpanier']} € <br> 

				<a class='waves-effect waves-light btn grey darken-1 '  href='index.php?action=viderpanier&controller=produit'><i class='material-icons left'>remove_shopping_cart</i>Vider Panier</a>
				<a class='waves-effect waves-light btn grey darken-1' href='index.php?action=created&controller=commande'><i class='material-icons left'>add_shopping_cart</i>Passer Commande</a>
				</p>";
	}else{
		echo "Panier vide";
	}



?>