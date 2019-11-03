<?php
	foreach ($tab_p as $p) {
		$pid = htmlspecialchars($p->get("id"));
		$pidURL = rawurlencode($p->get("id"));
		$pnom = htmlspecialchars($p->get("nom"));

		echo "<p> Produit d'id
		<a href=index.php?controller=produit&action=read&id=$pidURL>{$pid}</a>
		 et de nom $pnom 
		(<a href=index.php?controller=produit&action=delete&id=$pidURL>Supprimer</a>)
		 </p>";
	}

	echo "<a href=index.php?action=create&controller=produit>Creer un Produit</a>";
?>