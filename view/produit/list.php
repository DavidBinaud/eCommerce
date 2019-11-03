<?php
	foreach ($tab_t as $c) {
		$tid = htmlspecialchars($c->get("id"));
		$tidURL = rawurlencode($c->get("id"));
		$tnom = htmlspecialchars($c->get("nom"));

		echo "<p> Produit d'id
		<a href=index.php?controller=produit&action=read&id=$tidURL>{$tid}</a>
		 et de nom $tnom</p>";
	}

	echo "<a href=index.php?action=create&controller=produit>Creer un Produit</a>";
?>