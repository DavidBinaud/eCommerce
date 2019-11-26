<?php
	if(isset($errorType)){
		echo "Erreur: $errorType";
	}else{
		echo "erreur inconnue";
	}

	if(isset($redirect)){
		require (File::build_path(array("view","utilisateur","$redirect.php")));
	}
?>
