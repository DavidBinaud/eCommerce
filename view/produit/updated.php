<?php

	$id = htmlspecialchars($_GET['id']);
	echo "Le Produit d'id " . $id . " a bien été mise à jour.";
	require File::build_path(array("view",static::$object,"list.php"));

?>