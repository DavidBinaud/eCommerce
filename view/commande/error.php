<?php
	if(isset($errorType)){
		echo "<p class='ErrorNotice'>Erreur: $errorType</p>";
	}else{
		echo "<p class='ErrorNotice'>Erreur Inconnue</p>";
	}

	if($hasRedirect){
		require(File::build_path(array("view","$object","$redirect.php")));
	}
?>