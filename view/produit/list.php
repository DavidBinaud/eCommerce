<div class='row'>
	<div class="search-container">
		<form method='<?php echo Conf::getDebug()?'GET':'POST';?>' action="index.php">
			<input type="search" placeholder="Terme de recherche" name="search" style="width:90%;">
			<input type='hidden' name='action' value='search'>
			<input type='hidden' name='controller' value='produit'>
			<button type="submit" class='waves-effect waves-light btn grey darken-1'><i class="material-icons">search</i></button>
		</form>
	</div>
	<?php
	if(Session::is_admin()){
		echo "<div><a href=index.php?action=create&controller=produit class='waves-effect waves-light btn grey darken-1 sspaced'><i class='material-icons left'>add_shopping_cart</i>Creer un Produit</a></div>";
	}

	foreach ($tab_p as $p) {
		$pid = htmlspecialchars($p->get("id"));
		$pidURL = rawurlencode($p->get("id"));
		$pnom = htmlspecialchars($p->get("nom"));
		$nationalite = htmlspecialchars($p->get("nationalite"));
		$type = htmlspecialchars($p->get("type"));
		$path = htmlspecialchars($p->get("pathImgProduit"));
		

		echo "<div class='col s12 m6'>
				<div class='card medium'>
					<div class='card-image'>
						<a href='index.php?controller=produit&action=read&id=$pidURL'><img src='{$path}' alt='$pnom'></a>
						<span class='card-title'>$pnom</span>
					</div>
					<div class='card-action'>
						<a href='index.php?controller=produit&action=read&id=$pidURL'>Plus de détails </a>
						<a href=index.php?action=addTopanier&controller=produit&id=$pidURL>Ajouter au Panier</a>";
		if(Session::is_admin()){
			echo "		<a href=index.php?controller=produit&action=delete&id=$pidURL>Supprimer</a>";
		}
		echo "		</div>
				</div>
			</div>
		";
	}
	echo "</div>";

	
	
	?>