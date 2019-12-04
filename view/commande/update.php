<?php
	$controller = static::$object;
	$loginParam = "";
	if($cAction == "create"){
		$actionAfter = "created";
		$titreForm = "Création de " . ucfirst(static::$object);
	}else {
		$actionAfter = "updated";
		$titreForm = "Mise à Jour de " . ucfirst(static::$object);
	}
?>

<form method="get" action="index.php">
	<fieldset>
		<legend>Mon formulaire de <?php echo $titreForm;?>:</legend>

	    <?php
	    	if ($cAction == "update") {
	    		echo "<p>
				 	 	<label for='id_id'>Id</label> :
						<input type='text' value='$cId' name='id' id='id_id' readonly/>
					</p>";
	    	}
	    ?>

		<p>
	  		<label for="prixTotal_id">Prix Total</label> :
	  		<input type="text" value="<?php echo $cPrixTotal;?>" name="prixTotal" id="prixTotal_id" required/>
		</p>

		<p>
	 		<label for="dateDeCommande_id">Date de Commande</label> :
	 	 	<input type="date" value="<?php echo $cDateDeCommande;?>" name="dateDeCommande" id="dateDeCommande_id" required/>
		</p>

		<p>
			<label for="loginClient_id">Login du client</label> :
			<input type="text" value="<?php echo $cLoginClient;?>" name="loginClient" id="loginClient_id" required/>
		</p>

		<p>
			<input type='hidden' name='action' value=<?php echo $actionAfter;?>>
			<input type='hidden' name='controller' value=<?php echo $controller;?>>
			<input type="submit" value="Envoyer" />
		</p>
	</fieldset> 
</form>