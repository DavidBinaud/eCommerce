<?php
	echo 'un email a été envoyé à votre adresse mail, veuillez reinitialiser votre mot de passe via le lien de ce mail';
	require(File::build_path(array('view','utilisateur','connect.php')));
?>