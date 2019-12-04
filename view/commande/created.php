<?php
	echo "<p class='ValidNotice'>La commande a bien été créé !</p>";
	require File::build_path(array("view",static::$object,"list.php"));
?>