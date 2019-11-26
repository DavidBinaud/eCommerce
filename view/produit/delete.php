<?php
    $pid = htmlspecialchars($_GET['id']);
    echo '<p> Le produit d\'id ' . $pid . " a bien été supprimé.</p>";
    require File::build_path(array("view",static::$object,"list.php"));
?>
