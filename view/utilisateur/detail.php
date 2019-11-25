<?php
	$ulogin = htmlspecialchars($u->get("login"));
	$uloginURL = rawurlencode($u->get("login"));
	$uemail = htmlspecialchars($u->get("email"));
	$unom = htmlspecialchars($u->get("nom"));
	$uprenom = htmlspecialchars($u->get("prenom"));
	$uville = htmlspecialchars($u->get("ville"));
	$upays = htmlspecialchars($u->get("pays"));
	$uadresse = htmlspecialchars($u->get("adresse"));
	$udateDeNaissance = htmlspecialchars($u->get("dateDeNaissance"));

	
	echo "<p> Client de login $ulogin,d'email $uemail de nom $unom de prénom $uprenom né(e) le $udateDeNaissance vit à $uville en $upays à l'adresse $uadresse 
	(<a href=index.php?action=update&controller=utilisateur&login=$uloginURL>MAJ</a>)
	</p>";


?>