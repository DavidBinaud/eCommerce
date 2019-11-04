<?php
    $cid = htmlspecialchars($_GET['id']);
    echo '<p> Le client d\'id ' . $cid . " a bien été supprimée.</p>";
    require File::build_path(array("view",static::$object,"list.php"));
?>
