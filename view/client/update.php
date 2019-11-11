<?php
	$controller = static::$object;
	$loginParam = "";
	if($cAction == "create"){
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
	 	 	<label for="id_id">Id:</label> 
			<input type="text" value="<?php echo $cId;?>" name="id" id="id_id" <?php echo $loginParam;?>/>
		</p>

		<p>
	  		<label for="nom_id">Nom:</label> 
	  		<input type="text" value="<?php echo $cNom;?>" name="nom" id="nom_id" required/>
		</p>

		<p>
	 		<label for="prenom_id">Prenom:</label> 
	 	 	<input type="text" value="<?php echo $cPrenom;?>" name="prenom" id="prenom_id" required/>
		</p>

		<p>
			<label for="ville_id">Ville:</label> 
			<input type="text" value="<?php echo $cVille;?>" name="ville" id="ville_id" required/>
		</p>

		<p>
			<label for="pays_id">Pays:</label> 
			<input type="text" value="<?php echo $cPays;?>" name="pays" id="pays_id"/>
		</p>

		<p>
			<label for="adresse_id">Adresse:</label> 
			<input type="text" value="<?php echo $cAdresse;?>" name="adresse" id="adresse_id"/>
		</p>

		<p>
			<label for="dateDeNaissance_id">Date de Naissance:</label> 
			<input type="text" value="<?php echo $cDateDeNaissance;?>" name="dateDeNaissance" id="dateDeNaissance_id"/>
		</p>

		<p>
			<input type='hidden' name='action' value=<?php echo $actionAfter;?>>
			<input type='hidden' name='controller' value=<?php echo $controller;?>>
			<input type="submit" value="Envoyer" />
		</p>
	</fieldset> 
</form>



