<?php
echo "<div class='row'>";
	foreach ($tab_p as $p) {
		$pid = htmlspecialchars($p->get("id"));
		$pidURL = rawurlencode($p->get("id"));
		$pnom = htmlspecialchars($p->get("nom"));
		$nationalite = htmlspecialchars($p->get("nationalite"));
		$type = htmlspecialchars($p->get("type"));
		$path = htmlspecialchars($p->get("pathImgProduit"));
		

		echo "			
		    <div class='col s12 m6'>
		      <div class='card'>
		        <div class='card-image'>
		          <img src='{$path}' alt='$pnom'>
		          <span class='card-title'>$pnom</span>
		        </div>
		        <div class='card-action'>
		          <a href='index.php?controller=produit&action=read&id=$pidURL'>Plus de détails :</a>
		          <a href=index.php?action=addpanier&controller=produit&id=$pidURL >Ajouter au Panier</a>";
		          if(Session::is_admin()){
						echo "<a href=index.php?controller=produit&action=delete&id=$pidURL>Supprimer</a>";
					}
		        echo "</div>
		      </div>
		    </div>
		  ";
	}
	echo "</div>";

	if(Session::is_admin()){
		echo "<a href=index.php?action=create&controller=produit>Creer un Produit</a>";
	}
	
?>