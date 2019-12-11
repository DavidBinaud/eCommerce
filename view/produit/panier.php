<?php
	if ($panier_is_empty) {
		echo "Panier vide";
	}else{
		echo "<p>Montant total du panier : {$_SESSION['panier']['prixTotal']} € </p>";
		foreach ($tab_produitPanier as $produit) {
			echo"
			<div class='col center s12'>
			    <div class='card horizontal center'>
			      	<div class='card-image'>
			        	<img src='". $produit['pathImgProduit'] ."' alt='ImageDuChar'>
			      	</div>
			      	<div class='card-content'>
			        	<p><b>" . htmlspecialchars($produit['quantité']) .'</b> ' . htmlspecialchars($produit['nom']) . ' à ' . htmlspecialchars($produit['prix']) ." €/unité</p>
			      	</div>
			    </div>
			</div>";
		}
		echo "<div><a class='waves-effect waves-light btn grey darken-1 '  href='index.php?action=viderpanier&controller=produit'><i class='material-icons left'>remove_shopping_cart</i>Vider Panier</a>
				<a class='waves-effect waves-light btn grey darken-1' href='index.php?action=created&controller=commande'><i class='material-icons left'>add_shopping_cart</i>Passer Commande</a>
				</div>";
	}



?>