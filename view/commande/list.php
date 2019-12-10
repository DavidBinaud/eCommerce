<?php
	foreach ($tab_c as $c) {
		$cid = htmlspecialchars($c->get("id"));
		$cidURL = rawurlencode($c->get("id"));
		

		echo "<p>Commande d'id 
		<a href=index.php?action=read&controller=commande&id=$cidURL>{$cid}</a>
		<a href='index.php?action=delete&controller=commande&id=$cidURL'>Supprimer</a>
		<a href='index.php?action=update&controller=commande&id=$cidURL'>Modifier</a>
		</p>";
	}

	//echo "<a href=index.php?action=create&controller=commande>Creer une Commande</a>";
?>