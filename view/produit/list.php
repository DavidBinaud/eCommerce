<?php
	foreach ($tab_p as $p) {
		$pid = htmlspecialchars($p->get("id"));
		$pidURL = rawurlencode($p->get("id"));
		$pnom = htmlspecialchars($p->get("nom"));
		$pimg = htmlspecialchars($p->get("pathImgProduit"));
		$nationalite = htmlspecialchars($p->get("nationalite"));
		$type = htmlspecialchars($p->get("type"));
		

		echo "<p> $type de nationnalité $nationalite, le
		<a href=index.php?controller=produit&action=read&id=$pidURL>{$pnom}</a>
		 ";
		if(Session::is_admin()){
			echo "(<a href=index.php?controller=produit&action=delete&id=$pidURL>Supprimer</a>)";
		}
		echo "(<a href=index.php?action=addpanier&controller=produit&id=$pidURL >Ajouter au Panier</a>)</p>";
	}

	if(Session::is_admin()){
		echo "<a href=index.php?action=create&controller=produit>Creer un Produit</a>";
	}
	
?>