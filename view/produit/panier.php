<?php
	
	if (isset($_SESSION) && isset($_SESSION['panier'])) {
		echo '<p>';
		foreach ($panier as $lignepanier) {
			foreach ($lignepanier as $produit => $qté) {
				echo " $produit $qté";
			}
			echo "<br>";
		}
		echo "Montant total du panier : {$_SESSION['prixpanier']} € <br> 

				<div class='waves-effect waves-light btn grey darken-1 '  href='index.php?action=viderpanier&controller=produit'>Vider Panier</div></p>";
	}else{
		echo "Panier vide";
	}



?>