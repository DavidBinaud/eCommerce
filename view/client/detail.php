<?php
	$cid = htmlspecialchars($c->get("id"));
	$cidURL = rawurlencode($c->get("id"));
	$cnom = htmlspecialchars($c->get("nom"));
	$cprenom = htmlspecialchars($c->get("prenom"));
	$cville = htmlspecialchars($c->get("ville"));
	$cpays = htmlspecialchars($c->get("pays"));
	$cadresse = htmlspecialchars($c->get("adresse"));
	$cdateDeNaissance = htmlspecialchars($c->get("dateDeNaissance"));

	
	echo "<p> Client d'id $cid, de nom $cnom de prénom $cprenom née le $cdateDeNaissance vit à $cville en $cpays à l'adresse $cadresse 
	(<a href=index.php?action=update&controller=client&id=$cidURL>MAJ</a>)
	</p>";


?>