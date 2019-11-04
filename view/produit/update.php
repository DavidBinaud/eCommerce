<?php
	$controller = static::$object;
	$loginParam = "";
	if($pAction == "create"){
		$loginParam = "required";
		$actionAfter = "created";
		$titreForm = "Création de " . ucfirst(static::$object);
	}else {
		$loginParam = "readonly";
		$actionAfter = "updated";
		$titreForm = "Mise à Jour de " . ucfirst(static::$object);
	}
?>

<form method="get" action="index.php">
	<fieldset>
		<legend>Mon formulaire de <?php echo $titreForm;?>:</legend>
	    
		<p>
	 	 	<label for="id_id">Id</label> :
			<input type="text" value="<?php echo $pId;?>" name="id" id="id_id" <?php echo $loginParam;?>/>
		</p>

		<p>
	  		<label for="nom_id">Nom</label> :
	  		<input type="text" value="<?php echo $pNom;?>" name="nom" id="nom_id" required/>
		</p>

		<p>
	 		<label for="description_id">Description</label> :
	 	 	<input type="text" value="<?php echo $pDescription;?>" name="description" id="description_id" required/>
		</p>

		<p>
			<label for="prix_id">Prix</label> :
			<input type="text" value="<?php echo $pPrix;?>" name="prix" id="prix_id" required/>
		</p>

		<p>
			<label for="nationalite_id">Nationalite</label> :
			<input type="text" value="<?php echo $pNationalite;?>" name="nationalite" id="nationalite_id"/>
		</p>

		<p>
			<input type='hidden' name='action' value=<?php echo $actionAfter;?>>
			<input type='hidden' name='controller' value=<?php echo $controller;?>>
			<input type="submit" value="Envoyer" />
		</p>
	</fieldset> 
</form>



