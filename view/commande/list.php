<?php
	echo "<div class='row'><h3>Liste des Commandes</h3>";
	foreach ($tab_c as $c) {
		$cid = htmlspecialchars($c->get("id"));
		$cidURL = rawurlencode($c->get("id"));
		$cPrix = htmlspecialchars($c->get("prixTotal"));
		$cDate = Date::formate(htmlspecialchars($c->get("dateDeCommande")));
		$cLogin = htmlspecialchars($c->get("loginClient"));

		echo "<div class='col s12'>Commande référencée: 
		<a href='index.php?action=read&controller=commande&id=$cidURL'>{$cid}</a>
		d'un montant de $cPrix € commandée le $cDate";
		if(Session::is_admin()){
			echo " par $cLogin <a href='index.php?action=delete&controller=commande&id=$cidURL' class='waves-effect waves-light btn grey darken-1 sspaced right'>Supprimer</a>
				<a href='index.php?action=update&controller=commande&id=$cidURL' class='waves-effect waves-light btn grey darken-1 sspaced right'>Modifier</a>";
		}
		echo "</div>";
	}
	echo "</div>";
?>