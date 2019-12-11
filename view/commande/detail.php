<?php
	echo "<div> <h5>La Commande d'id {$cid} réalisée par $cidClient, de montant $cprix € commandée le $cdateDeCommande contient:</h5></div>
	<div class='row'>";

	foreach ($tab_produitCommande as $produit) {
		echo"
		<div class='col center s12'>
		    <div class='card horizontal center'>
		      	<div class='card-image'>
		        	<img src='" . $produit['pathImgProduit'] . "' alt='ImageduChar'>
		      	</div>
		      	<div class='card-content'>
		        	<p><b>" . htmlspecialchars($produit['quantite']) . "</b> ". htmlspecialchars($produit['nom']) . " à " . htmlspecialchars($produit['prix']) ." €/unité</p>
		      	</div>
		    </div>
		</div>";
	}

	echo "</div>";

?>