<?php
	$cid = htmlspecialchars($c->get("id"));
	$cidURL = rawurlencode($c->get("id"));
	$cprix = htmlspecialchars($c->get("prix"));
	$cdateDeCommande = htmlspecialchars($c->get("dateDeCommande"));
	$cidClient = htmlspecialchars($c->get("idClient"));
	$cidClientURL = rawurlencode($c->get("idClient"));
	echo "<p> La Commande d'id {$cid}, de montant $cprix € commandée le $cdateDeCommande par le client d'id 
		<a href=index.php?action=read&controller=client&id=$cidClientURL>{$cidClient}</a>
	</p>";


?>