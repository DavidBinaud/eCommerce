<?php
	echo "<p class='ValidNotice'>L'Utilisateur de login " . $login . " a bien été mise à jour.</p>";
	require File::build_path(array("view",static::$object,"detail.php"));

?>