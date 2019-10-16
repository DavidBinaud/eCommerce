<?php
	//require_once './ControllerVoiture.php';
	require_once (File::build_path(array("controller","ControllerProduit.php")));
	require_once (File::build_path(array("controller","ControllerClient.php")));
	require_once (File::build_path(array("controller","ControllerCommande.php")));
	// On recupère l'action passée dans l'URL


	//Verifie qu'une action est passée dans l'url ; Si aucune action on fait l'action de base readALL
	if(isset($_GET['action']) && isset($_GET['controller'])){
		$action = $_GET['action'];
		$controller = $_GET['controller'];
		$controller_class = 'Controller' . ucfirst($controller);


		if(class_exists($controller_class)){
			//on vérifie que la classe existe


			//Permet de recuperer un array contenant les noms des methodes de la classe contenue dans $controller_class
			$ControllerClassMethods = get_class_methods ($controller_class);

			//Verifie que l'action passée en paramètre est bien une action existante dans l'array des noms de méthodes ; si n'existe pas on fait l'action error du ControllerProduit
			if(!in_array($action, $ControllerClassMethods)){
				//Si la méthode n'existe pas
				$controller_class= 'ControllerProduit';
				$action = 'error';
			}
		}
		else{
			$controller_class= 'ControllerProduit';
				$action = 'error';
		}
	}
	else{
		$controller_class='ControllerProduit';
		$action = 'readAll';
	}
	$controller_class::$action();
?>