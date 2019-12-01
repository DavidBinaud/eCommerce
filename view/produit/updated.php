<?php

	$id = htmlspecialchars(myGet('id'));
	echo "<p class='ValidNotice'>Le Produit d'id " . $id . " a bien été mise à jour.</p>";
	require File::build_path(array("view",static::$object,"list.php"));

?>