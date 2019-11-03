<?php
	foreach ($tab_c as $c) {
		$cid = htmlspecialchars($c->get("id"));
		$cidURL = rawurlencode($c->get("id"));
		$cnom = htmlspecialchars($c->get("nom"));
		$cprenom = htmlspecialchars($c->get("prenom"));
		

		echo "<p> Client d'id 
		<a href=index.php?action=read&controller=client&id=$cidURL>{$cid}</a> 
		de nom $cnom et prenom $cprenom</p>";
	}

	echo "<a href=index.php?action=create&controller=client>Creer un Client</a>";
?>