<?php
	foreach ($tab_c as $c) {
		$cid = htmlspecialchars($c->get("id"));
		$cnom = htmlspecialchars($c->get("nom"));
		$cprenom = htmlspecialchars($c->get("prenom"));
		$cville = htmlspecialchars($c->get("ville"));
		$cadresse = htmlspecialchars($c->get("adresse"));
		$cpays = htmlspecialchars($c->get("pays"));
		$cdateDeNaissance = htmlspecialchars($c->get("dateDeNaissance"));

		echo "<p> id={$cid} nom=$cnom prenom=$cprenom adresse=$cadresse ville=$cville pays=$cpays date de naissance=$cdateDeNaissance</p>";
	}

	echo "<a href=index.php?action=create&controller=client>Creer un Client</a>";
?>