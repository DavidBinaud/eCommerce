<?php

  class ModelPanier{
    
  	private static function InitPanier(){
  		$_SESSION['panier']['prixTotal'] = 0;
  		$_SESSION['panier']['quantiteTotal'] = 0;
  		$_SESSION['panier']['produits'] = array();
  	}


  	public static function getPanier(){
		if(!isset($_SESSION) || !isset($_SESSION['panier'])){
				self::InitPanier();
		}
		self::updatePanier();
		return $_SESSION['panier'];
	}

    private static function countProduct(){
			if (isset($_SESSION)  && isset($_SESSION['panier'])) {
				return array_sum(array_column($_SESSION['panier']['produits'], "quantité"));
			}else{
				return 0;
			}
	}


	private static function countPrice(){
			if (isset($_SESSION)  && isset($_SESSION['panier'])) {
				$prix = 0;
				foreach ($_SESSION['panier']['produits'] as $produit) {
					$prix = $prix + $produit['prix'] * $produit['quantité'];
				}
				return $prix;
			}else{
				return 0;
			}
	}




	public static function updatePanier(){
		if (isset($_SESSION)  && isset($_SESSION['panier'])) {
			$_SESSION['quantiteTotal'] = self::countProduct();
			$_SESSION['prixTotal'] = self::countPrice();
		}else{
			self::InitPanier();
		}
	}

	public static function emptyPanier(){
		self::InitPanier();
	}


	public static function is_empty(){
		return self::countProduct() == 0;
	}

	public static function addToPanier($modelProduit){
		if(!isset($_SESSION) || !isset($_SESSION['panier'])){
			self::InitPanier();
		}

		$id = $modelProduit->get('id');

		//on cherche l'id Produit dans le panier
		$index = array_search($id, array_column($_SESSION['panier']['produits'], 'id'));
		//on doit faire une comparaison stricte dans le cas ou l'index 0 serait celui trouvé car 0 != false renvoie false
		if($index !== false){
			$_SESSION['panier']['produits'][$index]['quantité'] = $_SESSION['panier']['produits'][$index]['quantité'] + 1;
		}else{
			$_SESSION['panier']['produits'][] = array('id' => $modelProduit->get('id'), 'prix' => $modelProduit->get('prix'), 'quantité' => 1);
		}
		
		self::updatePanier();
	}

		public static function deleteOneFromPanier($modelProduit){
			if(isset($_SESSION) && isset($_SESSION['panier'])){
					$id = $modelProduit->get('id');

					//on cherche l'id Produit dans le panier
					$index = array_search($id, array_column($_SESSION['panier'], 'id'));
					//on doit faire une comparaison stricte dans le cas ou l'index 0 serait celui trouvé car 0 != false renvoie false
					if($index !== false){
						$_SESSION['panier'][$index]['quantité'] = $_SESSION['panier'][$index]['quantité'] - 1;
					}else{
						//DELETE
						$_SESSION['panier'][] = array('id' => $modelProduit->get('id'), 'prix' => $modelProduit->get('prix'), 'quantité' => 1);
					}
			}
		}


  }

?>