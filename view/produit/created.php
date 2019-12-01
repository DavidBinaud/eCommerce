<?php
	echo "<p class='ValidNotice'>Le produit a bien été créé !</p>";
	require File::build_path(array("view",static::$object,"list.php"));
?>