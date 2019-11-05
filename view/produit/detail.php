<?php
	$pid = htmlspecialchars($p->get("id"));
	$pidURL = rawurlencode($p->get("id"));
	$pnom = htmlspecialchars($p->get("nom"));
	$pdescription = htmlspecialchars($p->get("description"));
	$pprix = htmlspecialchars($p->get("prix"));
	$pnationalite = htmlspecialchars($p->get("nationalite"));

	if ($path != false) {
		echo "<p>";
		echo "<img src='$path' alt='img-Char'>";
		echo "(<a href=index.php?action=imgdelete&controller=produit&id=$pidURL>Supprimer image</a>)";
		echo "</p>";
	}
	echo "<p> Le Produit d'id {$pid}, nommé $pnom vendu au prix de $pprix € et de nationalite $pnationalite est décris par: <br>$pdescription  
		(<a href=index.php?action=update&controller=produit&id=$pidURL>MAJ</a>)
		</p>";
		//unlink($path);
	if ($path == false) {
		echo "<p>
		(<a href=index.php?action=imgupload&controller=produit&id=$pidURL>Ajout d'image</a>)
		</p>";
	}

?>