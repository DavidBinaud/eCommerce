<?php
	foreach ($tab_c as $c) {
		$cid = htmlspecialchars($c->get("id"));
		

		echo "<p> id={$cid}</p>";
	}

	echo "<a href=index.php?action=create&controller=commande>Creer une Commande</a>";
?>