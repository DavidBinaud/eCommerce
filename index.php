<?php
	// session_set_cookie_params(30*60,"/~binaudd");
	// pour faire en sorte que nos cookies sessions ne s'appliquent que sur notre site perso
	session_set_cookie_params(1800);
	session_start();
	
	//On charge la librairie de création de chemin relatif
	$DS = DIRECTORY_SEPARATOR;
	$ROOT_FOLDER = __DIR__;
	require_once "{$ROOT_FOLDER}{$DS}lib{$DS}File.php";

	//On charge la librairie de Session
	require_once (File::build_path(array("lib","Session.php")));

	//On reset le panier si la derniere activité remonte a plus de 30 minutes
	Session::time_reset_panier(1800);

	Session::check_last_activity(1800);

	require_once (File::build_path(array("model","modelPanier.php")));

	modelPanier::updatePanier();


	//On charge le routeur qui renvois vers le controller voulu
	require_once (File::build_path(array("controller","routeur.php")));
?>