<?php
    $pid = htmlspecialchars(myGet('id'));
    echo "<p class='ValidNotice'> La commande d'id " . $pid . " a bien été supprimé.</p>";
    require File::build_path(array("view",static::$object,"list.php"));
?>
