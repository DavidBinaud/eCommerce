<?php
	echo "<p class='ValidNotice'>un email a été envoyé à votre adresse mail, veuillez reinitialiser votre mot de passe via le lien de ce mail</p>";
	require(File::build_path(array('view','utilisateur','connect.php')));
?>