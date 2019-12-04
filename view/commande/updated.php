<?php

	$id = htmlspecialchars(myGet('id'));
	echo "<p class='ValidNotice'>La Commande d'id " . $id . " a bien été mise à jour.</p>";
	require File::build_path(array("view",static::$object,"list.php"));

?>