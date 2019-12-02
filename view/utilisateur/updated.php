<?php

	$login = htmlspecialchars(myGet('login'));
	echo "L'Utilisateur de login " . $login . " a bien été mise à jour.";
	require File::build_path(array("view",static::$object,"connect.php"));

?>