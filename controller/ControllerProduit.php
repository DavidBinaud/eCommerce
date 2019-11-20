<?php

	require_once (File::build_path(array("model","ModelProduit.php")));

	class ControllerProduit{
		protected static $object = 'produit';

		public static function error(){
			$view='error'; $pagetitle='ErreurProduit'; $errorType = 'Erreur Générale';
			require (File::build_path(array("view","view.php")));
		}



		public static function readAll(){
			$tab_p = ModelProduit::selectAll(); 

			$view='list'; $pagetitle='Liste des Produits';
			require (File::build_path(array("view","view.php")));
		}



		public static function read(){
			if(!is_null(myGet('id'))){
				$p = ModelProduit::select(myGet('id'));
				if($p == false){
					
					$view='error'; $pagetitle='ErreurProduit'; $errorType = "Read d'un Produit: id fourni non existant";
				}
				else{
					$path = $p->get('pathImgProduit');
					$view='detail'; $pagetitle='Detail Produit';
				}
			}else{
				$view='error'; $pagetitle='ErreurProduit'; $errorType = "Read d'un Produit: Pas d'id fourni";
			}
			require (File::build_path(array("view","view.php")));
		}



		public static function delete(){
			if(Session::is_admin()){
				if(!is_null(myGet('id'))){
					$p = ModelProduit::select(myGet('id'));
					if($p == false){
						$view='error'; $pagetitle='ErreurProduit'; $errorType = "Delete d'un Produit: id fourni non existant";
					}else{
						ModelProduit::delete(myGet('id'));
						$tab_p = ModelProduit::selectAll();

						$view='delete'; $pagetitle='Suppresion Produit';
					}
				}else{
					$view='error'; $pagetitle='ErreurProduit'; $errorType = "Delete d'un Produit: Pas d'id fourni";
				}
			}else{
				$view='error'; $pagetitle='ErreurProduit'; $errorType = "Delete d'un Produit: Acces Restreint";
			}
			require (File::build_path(array("view","view.php")));
		}



		public static function create(){
			if(Session::is_admin()){
	    		$pId = "\"\"";
	    		$pNom = "\"\"";
	    		$pDescription = "\"\"";
	    		$pPrix = "\"\"";
	    		$pNationalite = "\"\"";
	    		$pAction = "create";
			
				$view='update'; $pagetitle='Creation Produit';
			}else{
				$view='error'; $pagetitle='ErreurProduit'; $errorType = "Create d'un Produit: Acces Restreint";
			}
			require (File::build_path(array("view","view.php")));
		}



		public static function created(){
			if(Session::is_admin()){
				if (!is_null(myGet('id')) && !is_null(myGet('nom')) && !is_null(myGet('description')) && !is_null(myGet('prix')) && !is_null(myGet('nationalite'))){

					$data = array(
						"id" => myGet('id'),
						"nom" => myGet('nom'),
						"description" => myGet('description'),
						"prix" => myGet('prix'),
						"nationalite" => myGet('nationalite')
					);

					if(!is_null(myGet('pathImgProduit'))){
						$data["pathImgProduit"] = myGet('pathImgProduit');
					}else{
						$data["pathImgProduit"] = "src/placeholder.jpg";
					}
					$p = new ModelProduit($data);
					var_dump($p->get_object_vars());	
					if(ModelProduit::save($p) == false){
						$view='error'; $pagetitle='Erreur de Création'; $errorType = 'Created Produit: id fourni déjà existant';
						
					}else{
						$tab_p = ModelProduit::selectAll();
						$view='created'; $pagetitle='Création Reussie';
					}
				}else{
					$view='error'; $pagetitle='ErreurProduit'; $errorType = "Create d'un Produit: Problème de paramètres";
				}
			}else{
				$view='error'; $pagetitle='ErreurProduit'; $errorType = "Create d'un Produit: Acces Restreint";
			}
			require (File::build_path(array("view","view.php")));
		}

	


		public static function update(){
			if(Session::is_admin()){
				if (!is_null(myGet('id'))){
					$p = ModelProduit::select(myGet('id'));

					if($p == false){
						$view='error'; $pagetitle='Erreur MAJ'; $errorType = 'update Produit: id fourni non existant';
					}
					else{

	    				$pId = htmlspecialchars($p->get('id'));
	    				$pNom =htmlspecialchars($p->get('nom'));
	    				$pDescription = htmlspecialchars($p->get('description'));
	    				$pPrix = htmlspecialchars($p->get('prix'));
	    				$pNationalite = htmlspecialchars($p->get('nationalite'));
	    				$pathImgProduit = $p->get('pathImgProduit');
	    				$pAction = "update";

						$view='update'; $pagetitle='Mise A Jour';
					}
				}
				else{
					$view='error'; $pagetitle='Erreur MAJ'; $errorType = 'update Produit: Problème de paramètres';
				}
			}else{
				$view='error'; $pagetitle='Erreur MAJ'; $errorType = 'update Produit: Acces Restreint';
			}
			require (File::build_path(array("view","view.php")));
		}



		public static function updated(){
			if(Session::is_admin()){
				if (!is_null(myGet('id')) && !is_null(myGet('nom')) && !is_null(myGet('description')) && !is_null(myGet('prix')) && !is_null(myGet('nationalite'))){
					$data = array(
						"id" => myGet('id'),
						"nom" => myGet('nom'),
						"description" => myGet('description'),
						"prix" => myGet('prix'),
						"nationalite" => myGet('nationalite'),
						"pathImgProduit" => myGet('pathImgProduit'),
					);
					if (ModelProduit::select($_GET['id']) != false) {
						if(ModelProduit::update($data)){
							$tab_p = ModelProduit::selectAll();
							$view='updated'; $pagetitle='Mise A Jour';
						}else{
							$view='error'; $pagetitle='Erreur MAJ'; $errorType = 'updated Produit: Probleme rencontré lors de la maj';
						}
					}else{
						$view='error'; $pagetitle='Erreur MAJ'; $errorType = 'updated Produit: id Produit non existant';
					}
				}
				else{
					$view='error'; $pagetitle='Erreur MAJ'; $errorType = 'updated Produit: Problème de paramètres';
				}
			}else{
				$view='error'; $pagetitle='Erreur MAJ'; $errorType = 'updated Produit: Acces Restreint';
			}
			require (File::build_path(array("view","view.php")));
		}


		public static function imgupload(){
			if(Session::is_admin()){
				if (!is_null(myGet('id'))){
					$p = ModelProduit::select(myGet('id'));

					if($p == false){
						$view='error'; $pagetitle='Erreur MAJ'; $errorType = 'imgupload Produit: id fourni non existant';
						
					}
					else{
						$pId = htmlspecialchars($p->get('id'));
						$view='imgupload'; $pagetitle='Upload Img Produit';
					}

				}else{
					$view='error'; $pagetitle='Erreur MAJ'; $errorType = 'imgupload Produit: Problème de paramètres';
				}
			}else{
					$view='error'; $pagetitle='Erreur MAJ'; $errorType = 'imgupload Produit: Acces Restreint';
			}
			require (File::build_path(array("view","view.php")));
		}



		public static function imguploaded(){
			if(Session::is_admin()){
				if (!is_null(myGet('id'))){
					$p = ModelProduit::select(myGet('id'));
					if($p == false){
						$view='error'; $pagetitle='Erreur MAJ'; $errorType = 'imguploaded Produit: id fourni non existant';
						
					}
					else{
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

					}

				}else{
					$view='error'; $pagetitle='Erreur MAJ'; $errorType = "addedimg Produit: Problème de paramètre d'id";
				}
			}else{
				$view='error'; $pagetitle='Erreur MAJ'; $errorType = "addedimg Produit: Acces Restreint";
			}
			require (File::build_path(array("view","view.php")));
		}



		public static function imgdelete(){
			if(Session::is_admin()){
				if (!is_null(myGet('id'))){
					$p = ModelProduit::select(myGet('id'));

					if($p == false){
						$view='error'; $pagetitle='Erreur MAJ'; $errorType = 'imgdelete Produit: id fourni non existant';
						
					}
					else{
						$pic = $p->get('pathImgProduit');
						if ($pic != NULL) {
							$p->set('pathImgProduit',NULL);
							ModelProduit::update($p->get_object_vars());
							unlink($pic);
							$path=false;
							$view='imgdelete'; $pagetitle='Upload Img Produit';
						}
						else{
							$view='error'; $pagetitle='Erreur MAJ'; $errorType = "imgdelete Produit:Le produit n'a pas d'image";
						}
					}

				}else{
					$view='error'; $pagetitle='Erreur MAJ'; $errorType = 'imgdelete Produit: Problème de paramètres';
				}
			}else{
				$view='error'; $pagetitle='Erreur MAJ'; $errorType = 'imgdelete Produit: Acces Restreint';
			}
			require (File::build_path(array("view","view.php")));
		}





		public static function addpanier(){
			if(!is_null(myGet('id'))){
				$p = ModelProduit::select(myGet('id'));
				if ($p == true) {
					$id = $p->get('id');
					$path = $p->get('pathImgProduit');
					if(isset($_SESSION) && isset($_SESSION['panier'])){
						$panier = $_SESSION['panier'];
						
						// foreach ($panier as $lignepanier) {
						// 	if($lignepanier['immatriculation'] == $immat){
						// 		$lignepanier['qté']++;
						// 	}
						// }

						$index = array_search($id, array_column($panier, 'id'));

						//on doit faire une comparaison stricte dans le cas ou l'index 0 serait celui trouvé car 0 != false renvoie false
						if($index !== false){
							$_SESSION['panier'][$index]['quantité'] = $_SESSION['panier'][$index]['quantité'] + 1;
						}else{
							$_SESSION['panier'][] = array(
													'id' => $p->get('id'),
													'prix' => $p->get('prix'),
													'quantité' => 1);
						}
					}else{
						$_SESSION['panier'][] = array(
													'id' => $p->get('id'),
													'prix' => $p->get('prix'),
													'quantité' => 1);
					}
					
					$view='addedpanier'; $pagetitle='Ajouté au panier';
				}else{
					$view='error'; $pagetitle='Erreur';$errorType = 'add panier, id produit inexistant';
				}
			}else{
				$view='error'; $pagetitle='Erreur';$errorType = 'add panier, probleme parametre';
			}
			require (File::build_path(array("view","view.php")));
		}





		public static function getpanier(){

			if(isset($_SESSION) && isset($_SESSION['panier'])){
				$panier = $_SESSION['panier'];
			}
			$view='panier'; $pagetitle='panier';
			// else{
			// 	$view='error'; $pagetitle='Error'; $errorType = "Pas de session";
			// }
			require (File::build_path(array("view","view.php")));
		}



		public static function viderpanier(){
			if (isset($_SESSION['panier'])) {
				unset($_SESSION['panier']);
			}
			
			
			$view='panier'; $pagetitle='panier';
			// else{
			// 	$view='error'; $pagetitle='Error'; $errorType = "Pas de session";
			// }
			require (File::build_path(array("view","view.php")));
		}



	}



?>