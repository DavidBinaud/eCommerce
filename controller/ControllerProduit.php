<?php

	require_once (File::build_path(array("model","ModelProduit.php")));
	require_once (File::build_path(array("model","ModelProduitImage.php")));

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
			if(isset($_GET['id'])){
				$p = ModelProduit::select($_GET['id']);
				if($p == false){
					
					$view='error'; $pagetitle='ErreurProduit'; $errorType = "Read d'un Produit: id fourni non existant";
				}
				else{
					$pic = ModelProduitImage::select($_GET['id']);
					if($pic != false){
						$path = $pic->get('pathImgProduit');
					}else{
						$path=false;
					}
					$view='detail'; $pagetitle='Detail Produit';
				}
			}else{
				$view='error'; $pagetitle='ErreurProduit'; $errorType = "Read d'un Produit: Pas d'id fourni";
			}
			require (File::build_path(array("view","view.php")));
		}



		public static function delete(){
			if(isset($_GET['id'])){
				$p = ModelProduit::select($_GET['id']);
				if($p == false){
					$view='error'; $pagetitle='ErreurProduit'; $errorType = "Delete d'un Produit: id fourni non existant";
				}else{
					ModelProduit::delete($_GET['id']);
					$tab_p = ModelProduit::selectAll();

					$view='delete'; $pagetitle='Suppresion Produit';
				}
			}else{
				$view='error'; $pagetitle='ErreurProduit'; $errorType = "Delete d'un Produit: Pas d'id fourni";
			}
			require (File::build_path(array("view","view.php")));
		}



		public static function create(){
    		$pId = "\"\"";
    		$pNom = "\"\"";
    		$pDescription = "\"\"";
    		$pPrix = "\"\"";
    		$pNationalite = "\"\"";
    		$pAction = "create";
		
			$view='update'; $pagetitle='Creation Produit';
			require (File::build_path(array("view","view.php")));
		}



		public static function created(){
			if (isset($_GET['id']) && isset($_GET['nom']) && isset($_GET['description']) && isset($_GET['prix']) && isset($_GET['nationalite'])){

				$p = new ModelProduit($_GET);
				if(ModelProduit::save($p) == false){
					$view='error'; $pagetitle='Erreur de Création'; $errorType = 'Created Produit: id fourni déjà existant';
					
				}else{
					$tab_p = ModelProduit::selectAll();
					$view='created'; $pagetitle='Création Reussie';
				}
			}else{
				$view='error'; $pagetitle='ErreurProduit'; $errorType = "Create d'un Produit: Problème de paramètres";
			}
			require (File::build_path(array("view","view.php")));
		}

	


		public static function update(){
			if (isset($_GET['id'])){
				$p = ModelProduit::select($_GET['id']);

				if($p == false){
					$view='error'; $pagetitle='Erreur MAJ'; $errorType = 'update Produit: id fourni non existant';
				}
				else{

    				$pId = htmlspecialchars($p->get('id'));
    				$pNom =htmlspecialchars($p->get('nom'));
    				$pDescription = htmlspecialchars($p->get('description'));
    				$pPrix = htmlspecialchars($p->get('prix'));
    				$pNationalite = htmlspecialchars($p->get('nationalite'));
    				$pAction = "update";

					$view='update'; $pagetitle='Mise A Jour';
				}
			}
			else{
				$view='error'; $pagetitle='Erreur MAJ'; $errorType = 'update Produit: Problème de paramètres';
			}
			require (File::build_path(array("view","view.php")));
		}



		public static function updated(){
			if (isset($_GET['id']) && isset($_GET['nom']) && isset($_GET['description']) && isset($_GET['prix']) && isset($_GET['nationalite'])){
				$data = array(
					"id" => $_GET['id'],
					"nom" => $_GET['nom'],
					"description" => $_GET['description'],
					"prix" => $_GET['prix'],
					"nationalite" => $_GET['nationalite']
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
			require (File::build_path(array("view","view.php")));
		}


		public static function imgupload(){
			if (isset($_GET['id'])){
				$p = ModelProduit::select($_GET['id']);

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
			require (File::build_path(array("view","view.php")));
		}



		public static function imguploaded(){
			if (isset($_POST['id'])){
				$p = ModelProduit::select($_POST['id']);
				if($p == false){
					$view='error'; $pagetitle='Erreur MAJ'; $errorType = 'imguploaded Produit: id fourni non existant';
					
				}
				else{
					if (!empty($_FILES['nom-du-fichier']) && is_uploaded_file($_FILES['nom-du-fichier']['tmp_name'])) {
						$name = $_FILES['nom-du-fichier']['name'];
						$pic_path =  File::build_path(array("src",$name));

						if (!move_uploaded_file($_FILES['nom-du-fichier']['tmp_name'], $pic_path)) {
						  	$view='error'; $pagetitle='Erreur MAJ'; $errorType = 'imguploaded Produit: La Copie a échouée';
						}else{
							$pic = new ModelProduitImage($_POST['id'],"src/$name");
							
							if(ModelProduitImage::save($pic) == true){
								$pId = htmlspecialchars($p->get('id'));
								$path = $pic->get('pathImgProduit');
								$view='imguploaded'; $pagetitle='Uploaded Img Produit';
			
							}else{
								$view='error'; $pagetitle='Erreur MAJ'; $errorType = 'addedimg Produit: ce produit a déjà une image';
							}

						}

					}else{
						$view='error'; $pagetitle='Erreur MAJ'; $errorType = 'addedimg Produit: Problème de paramètre fichier';
					}

				}

			}else{
				$view='error'; $pagetitle='Erreur MAJ'; $errorType = "addedimg Produit: Problème de paramètre d'id";
			}
			require (File::build_path(array("view","view.php")));
		}



		public static function imgdelete(){
			if (isset($_GET['id'])){
				$p = ModelProduit::select($_GET['id']);

				if($p == false){
					$view='error'; $pagetitle='Erreur MAJ'; $errorType = 'imgdelete Produit: id fourni non existant';
					
				}
				else{
					$pic = ModelProduitImage::select($p->get('id'));
					ModelProduitImage::delete($p->get('id'));
					unlink($pic->get('pathImgProduit'));
					$path=false;
					$view='imgdelete'; $pagetitle='Upload Img Produit';
				}

			}else{
				$view='error'; $pagetitle='Erreur MAJ'; $errorType = 'imgdelete Produit: Problème de paramètres';
			}
			require (File::build_path(array("view","view.php")));
		}



	}



?>