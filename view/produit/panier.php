<?php
	
	if (isset($_SESSION) && isset($_SESSION['panier'])) {
		echo '<p>';
		foreach ($panier as $lignepanier) {
			foreach ($lignepanier as $produit => $qté) {
				echo " $produit $qté";
			}
			echo "<br>";
		}
		echo "Prix Panier {$_SESSION['prixpanier']} 
				<a href='index.php?action=viderpanier&controller=produit'>Vider Panier</a></p>";
	}else{
		echo "panier vide";
	}



?>