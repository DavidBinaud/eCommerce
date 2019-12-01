<?php
	echo "<p class='ValidNotice'>Produit ajouté au panier</p>";
	require File::build_path(array("view",static::$object,"detail.php"));

?>