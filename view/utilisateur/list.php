<?php
	foreach ($tab_u as $u) {
		$ulogin = htmlspecialchars($u->get("login"));
		$uloginURL = rawurlencode($u->get("login"));
		$unom = htmlspecialchars($u->get("nom"));
		$uprenom = htmlspecialchars($u->get("prenom"));
		

		echo "<p> Utilisateur de login 
		<a href=index.php?action=read&controller=Utilisateur&login=$uloginURL>{$ulogin}</a> 
		de nom $unom et prenom $uprenom
		(<a href=index.php?controller=Utilisateur&action=delete&login=$uloginURL>Supprimer</a>)
		</p>";
	}
	
	echo "<a href=index.php?action=create&controller=Utilisateur>Creer un Client</a>";

?>