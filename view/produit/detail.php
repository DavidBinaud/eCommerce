<?php
	$pid = htmlspecialchars($p->get("id"));
	$pidURL = rawurlencode($p->get("id"));
	$pnom = htmlspecialchars($p->get("nom"));
	$pdescription = htmlspecialchars($p->get("description"));
	$pprix = htmlspecialchars($p->get("prix"));
	$pnationalite = htmlspecialchars($p->get("nationalite"));
	$ptype = htmlspecialchars($p->get("type"));

	if ($path != false) {
		echo "<p>";
		echo "<img class='tank' src='$path' alt='img-Char'>";
		
		echo "</p>";
	}
	echo "<p> Le $ptype de nationalité $pnationalite <b> $pnom </b> est vendu au prix de $pprix €.<br> Description: <br>$pdescription";

	if(Session::is_admin()){	
		echo "(<a href=index.php?action=update&controller=produit&id=$pidURL>MAJ</a>)
		</p>";
	}
		//unlink($path);
	if ($path == false) {
		if(Session::is_admin()){
			echo "<p>
			(<a href=index.php?action=imgupload&controller=produit&id=$pidURL>Ajout d'image</a>)
			</p>";
		}
	}

?>