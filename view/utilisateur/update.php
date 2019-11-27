<?php
	$controller = static::$object;
	$loginParam = "";
	if($uAction == "create"){
		$loginParam = "required";
		$mdpParam = "required";
		$actionAfter = "created";
		$titreForm = "Création de " . ucfirst(static::$object);
	}else {
		$loginParam = "readonly";
		$mdpParam = "";
		$actionAfter = "updated";
		$titreForm = "Mise à Jour de " . ucfirst(static::$object);
	}
?>



<form method="get" action="index.php">
	<fieldset>
		<legend>Mon formulaire de <?php echo $titreForm;?>:</legend>
	    
		<p>
	 	 	<label for="login_id">Login:</label> 
			<input type="text" value="<?php echo $ulogin;?>" name="login" id="login_id" <?php echo $loginParam;?>/>
		</p>		

		<p>
	 	 	<label for="mdp_id">Password:</label> 
			<input type="password"  name="mdp" id="mdp_id" <?php echo $mdpParam;?>/>
		</p>	

		<p>
	 	 	<label for="confirmmdp_id">Confirmation Password:</label> 
			<input type="password"  name="confirmmdp" id="confirmmdp_id" <?php echo $mdpParam;?>/>
		</p>

		<p>
	      <label for="confimpass_id">Email</label>
	      <input type="email" value="<?php echo $uEmail;?>" name="email" id="email_id" required/>
	    </p>

		<p>
	  		<label for="nom_id">Nom:</label> 
	  		<input type="text" value="<?php echo $uNom;?>" name="nom" id="nom_id" required/>
		</p>

		<p>
	 		<label for="prenom_id">Prenom:</label> 
	 	 	<input type="text" value="<?php echo $uPrenom;?>" name="prenom" id="prenom_id" required/>
		</p>

		<p>
			<label for="ville_id">Ville:</label> 
			<input type="text" value="<?php echo $uVille;?>" name="ville" id="ville_id" required/>
		</p>

		<p>
			<label for="pays_id">Pays:</label> 
			<input type="text" value="<?php echo $uPays;?>" name="pays" id="pays_id"/>
		</p>

		<p>
			<label for="adresse_id">Adresse:</label> 
			<input type="text" value="<?php echo $uAdresse;?>" name="adresse" id="adresse_id"/>
		</p>

		<p>
			<label for="dateDeNaissance_id">Date de Naissance:</label> 
			<input type="date" value="<?php echo $uDateDeNaissance;?>" name="dateDeNaissance" id="dateDeNaissance_id"/>
		</p>

		<p>
			<input type='hidden' name='action' value=<?php echo $actionAfter;?>>
			<input type='hidden' name='controller' value=<?php echo $controller;?>>
			<input type="submit" value="Envoyer" />
		</p>
	</fieldset> 
</form>



