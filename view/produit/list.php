<?php
	foreach ($tab_t as $c) {
		$tid = htmlspecialchars($c->get("id"));
		$tnom = htmlspecialchars($c->get("nom"));
		$tdescription = htmlspecialchars($c->get("description"));
		$tprix = htmlspecialchars($c->get("prix"));
		$tnationalite = htmlspecialchars($c->get("nationalite"));

		echo "<p> id={$tid} nom=$tnom description=$tdescription prix=$tprix nationalite=$tnationalite </p>";
	}

	echo "<a href=index.php?action=create&controller=produit>Creer un Produit</a>";
?>