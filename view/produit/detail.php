<?php
	$pid = htmlspecialchars($p->get("id"));
	$pnom = htmlspecialchars($p->get("nom"));
	$pdescription = htmlspecialchars($p->get("description"));
	$pprix = htmlspecialchars($p->get("prix"));
	$pnationalite = htmlspecialchars($p->get("nationalite"));

	echo "<p> Le Produit d'id {$pid}, nommé $pnom vendu au prix de $pprix € et de nationalite $pnationalite est décris par: <br>$pdescription  </p>";


?>