<?php

	require_once (File::build_path(array("model","ModelProduit.php")));

	class ControllerProduit{
		protected static $object = 'produit';

		// $parametres doit être un array
		// function error([string $errorType[,string $redirect[,array $parametres]]])..
		public static function error($errorType = NULL,$redirect = NULL,$parametres = NULL){

			//pour chaque element dans $parametre on va créer une variable nommé avec le nom de la clé et contenant comme valeur la valeur associée à cette clé
			if(!is_null($parametres) && is_array($parametres)){
				foreach ($parametres as $key => $value) {
					${$key} = $value;
				}
			}
			$hasRedirect = !is_null($redirect); // Used to check in error view if a redirection exists

			$view='error'; $pagetitle='Produit';;
			require (File::build_path(array("view","view.php")));
			die();
		}



		public static function readAll(){
			$tab_p = ModelProduit::selectAll(); 

			$view='list'; $pagetitle='Liste des Produits';
			require (File::build_path(array("view","view.php")));
		}



		public static function read(){
			if(is_null(myGet('id')))self::error("Read d'un Produit: Pas d'id fourni");

			$p = ModelProduit::select(myGet('id'));

			if($p == false)self::error("Read d'un Produit: id fourni non existant");


			$path = $p->get('pathImgProduit');
			$view='detail'; $pagetitle='Detail Produit';	
			require (File::build_path(array("view","view.php")));
		}





		public static function delete(){
			if(!Session::is_admin())self::error("Delete d'un Produit: Acces Restreint<i class='material-icons left'>lock</i>");

			if(is_null(myGet('id')))self::error("Delete d'un Produit: Pas d'id fourni");

			$p = ModelProduit::select(myGet('id'));
			if($p == false)self::error("Delete d'un Produit: id fourni non existant");


			ModelProduit::delete(myGet('id'));
			$tab_p = ModelProduit::selectAll();

			$view='delete'; $pagetitle='Suppresion Produit';
			require (File::build_path(array("view","view.php")));
		}



		public static function create(){
			if(!Session::is_admin())self::error("Create d'un Produit: Acces Restreint<i class='material-icons left'>lock</i>");

			$pId = "\"\"";
			$pNom = "\"\"";
			$pDescription = "\"\"";
			$pPrix = "\"\"";
			$pNationalite = "\"\"";
			$pathImgProduit = "\"\"";
			$pAction = "create";
			
			$view='update'; $pagetitle='Creation Produit';
			require (File::build_path(array("view","view.php")));
		}



		public static function created(){
			if(!Session::is_admin())self::error("Created d'un Produit: Acces Restreint<i class='material-icons left'>lock</i>");
			
			if (is_null(myGet('nom')) || is_null(myGet('description')) || is_null(myGet('prix')) || is_null(myGet('nationalite')))self::error("Create d'un Produit: Problème de paramètres");

			$data = array(
				"id" => "",
				"nom" => myGet('nom'),
				"description" => myGet('description'),
				"prix" => myGet('prix'),
				"nationalite" => myGet('nationalite'),
				"pathImgProduit" => myGet('pathImgProduit')
			);

			if(is_null(myGet('pathImgProduit'))){
				$data["pathImgProduit"] = "";
			}
			
			$p = new ModelProduit($data);

			if(ModelProduit::save($p) == false)self::error('Created Produit: id fourni déjà existant');
			
			
			$tab_p = ModelProduit::selectAll();

			$view='created'; $pagetitle='Création Reussie';
			require (File::build_path(array("view","view.php")));
		}

	


		public static function update(){
			if(!Session::is_admin())self::error("update Produit: Acces Restreint<i class='material-icons left'>lock</i>");
			
			if (is_null(myGet('id')))self::error('update Produit: Problème de paramètres');
			

			$p = ModelProduit::select(myGet('id'));
			if($p == false)self::error('update Produit: id fourni non existant');


			$pId = htmlspecialchars($p->get('id'));
			$pNom =htmlspecialchars($p->get('nom'));
			$pDescription = htmlspecialchars($p->get('description'));
			$pPrix = htmlspecialchars($p->get('prix'));
			$pNationalite = htmlspecialchars($p->get('nationalite'));
			$pathImgProduit = $p->get('pathImgProduit');
			$pAction = "update";

			$view='update'; $pagetitle='Mise A Jour';
			require (File::build_path(array("view","view.php")));
		}



		public static function updated(){
			if(!Session::is_admin())
				self::error("updated Produit: Acces Restreint<i class='material-icons left'>lock</i>");
			
			if (is_null(myGet('id')) || is_null(myGet('nom')) || is_null(myGet('description')) || is_null(myGet('prix')) || is_null(myGet('nationalite')))self::error('updated Produit: Problème de paramètres');
			
			if (ModelProduit::select(myGet('id')) == false)
				self::error('updated Produit: id Produit non existant');

			$data = array(
				"id" => myGet('id'),
				"nom" => myGet('nom'),
				"description" => myGet('description'),
				"prix" => myGet('prix'),
				"nationalite" => myGet('nationalite'),
				"pathImgProduit" => myGet('pathImgProduit'),
			);
			
			
			if(!ModelProduit::update($data))self::error('updated Produit: Probleme rencontré lors de la maj');
			
			$tab_p = ModelProduit::selectAll();


			$view='updated'; $pagetitle='Mise A Jour';
			require (File::build_path(array("view","view.php")));
		}


		public static function imgupload(){
			if(!Session::is_admin())self::error("imgupload Produit: Acces Restreint<i class='material-icons left'>lock</i>");


			if (is_null(myGet('id')))self::error('imgupload Produit: Problème de paramètres');
			
			$p = ModelProduit::select(myGet('id'));
			if($p == false)self::error('imgupload Produit: id fourni non existant');

			$pId = htmlspecialchars($p->get('id'));

			$view='imgupload'; $pagetitle='Upload Img Produit';
			require (File::build_path(array("view","view.php")));
		}



		public static function imguploaded(){
			if(!Session::is_admin())self::error("addedimg Produit: Acces Restreint<i class='material-icons left'>lock</i>");
			
			if (is_null(myGet('id')))self::error("addedimg Produit: Problème de paramètre d'id");
			

			$p = ModelProduit::select(myGet('id'));
			if($p == false)self::error('imguploaded Produit: id fourni non existant');





			if (!empty($_FILES['nom-du-fichier']) && is_uploaded_file($_FILES['nom-du-fichier']['tmp_name'])) {
				$name = $_FILES['nom-du-fichier']['name'];
				$pic_path =  File::build_path(array("src",$name));

				$allowed_ext = array("jpg", "jpeg", "png");
				$explode = explode('.',$_FILES['nom-du-fichier']['name']);
				if (!in_array(end($explode), $allowed_ext)) {
					 	$view='error'; $pagetitle='Erreur MAJ'; $errorType = 'addedimg Produit: Mauvais type de fichier';
				}else{



					if (!move_uploaded_file($_FILES['nom-du-fichier']['tmp_name'], $pic_path)) {
					  	$view='error'; $pagetitle='Erreur MAJ'; $errorType = 'imguploaded Produit: La Copie a échouée';
					}else{
						$p->set("pathImgProduit","src/$name");
						
						if(ModelProduit::update($p->get_object_vars()) == true){
							$pId = htmlspecialchars($p->get('id'));
							$path = $p->get('pathImgProduit');
							$view='imguploaded'; $pagetitle='Uploaded Img Produit';
		
							}else{
								$view='error'; $pagetitle='Erreur MAJ'; $errorType = 'addedimg Produit: ce produit a déjà une image';
							}

					}



				}

			}else{
				$view='error'; $pagetitle='Erreur MAJ'; $errorType = 'addedimg Produit: Problème de paramètre fichier';
			}

					


			require (File::build_path(array("view","view.php")));
		}



		public static function imgdelete(){
			if(!Session::is_admin())self::error("imgdelete Produit: Acces Restreint<i class='material-icons left'>lock</i>");

			if (is_null(myGet('id')))self::error('imgdelete Produit: Problème de paramètres');

			$p = ModelProduit::select(myGet('id'));
			if($p == false)self::error('imgdelete Produit: id fourni non existant');

			$pic = $p->get('pathImgProduit');
			if ($pic == NULL)self::error("imgdelete Produit:Le produit n'a pas d'image");

			$p->set('pathImgProduit',NULL);
			ModelProduit::update($p->get_object_vars());
			unlink($pic);
			$path=false;
			
			$view='imgdelete'; $pagetitle='Upload Img Produit';
			require (File::build_path(array("view","view.php")));
		}





		public static function addpanier(){
			if(is_null(myGet('id')))self::error('add panier, probleme parametre');
			
			$p = ModelProduit::select(myGet('id'));
			if ($p == false)self::error('add panier, id produit inexistant');


			$id = $p->get('id');
			$path = $p->get('pathImgProduit');


			if(isset($_SESSION) && isset($_SESSION['panier'])){
				$panier = $_SESSION['panier'];

				//on cherche l'id Produit dans le panier
				$index = array_search($id, array_column($panier, 'id'));
				//on doit faire une comparaison stricte dans le cas ou l'index 0 serait celui trouvé car 0 != false renvoie false
				if($index !== false){
					$_SESSION['panier'][$index]['quantité'] = $_SESSION['panier'][$index]['quantité'] + 1;
				}else{
					$_SESSION['panier'][] = array('id' => $p->get('id'), 'prix' => $p->get('prix'), 'quantité' => 1);
				}
			}else{
				$_SESSION['panier'][] = array('id' => $p->get('id'), 'prix' => $p->get('prix'), 'quantité' => 1);
			}
					
			$view='addedpanier'; $pagetitle='Ajouté au panier';
			require (File::build_path(array("view","view.php")));
		}





		public static function getpanier(){

			if(isset($_SESSION) && isset($_SESSION['panier'])){
				$panier = $_SESSION['panier'];
			}

			$view='panier'; $pagetitle='panier';
			require (File::build_path(array("view","view.php")));
		}



		public static function viderpanier(){
			if (isset($_SESSION['panier'])) {
				unset($_SESSION['panier']);
			}
			
			
			$view='panier'; $pagetitle='panier';
			require (File::build_path(array("view","view.php")));
		}



	}



?>