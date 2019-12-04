<?php
	$cid = htmlspecialchars($c->get("id"));
	$cidURL = rawurlencode($c->get("id"));
	$cprix = htmlspecialchars($c->get("prixTotal"));
	$cdateDeCommande = htmlspecialchars($c->get("dateDeCommande"));
	$cidClient = htmlspecialchars($c->get("loginClient"));
	$cidClientURL = rawurlencode($c->get("loginClient"));
	
	echo "<p> La Commande d'id {$cid}, de montant $cprix € commandée le $cdateDeCommande par le client d'id 
		<a href=index.php?action=read&controller=client&login=$cidClientURL>{$cidClient}</a>
	</p>";


?>