<form method="get" action="index.php">
	<fieldset>
		<legend><?php echo $is_create?'Création de Compte':'Mise à jour du compte';?></legend>
	    
		<p>
	 	 	<label for="login_id">Login:</label> 
			<input type="text" value="<?php echo $login;?>" name="login" id="login_id" <?php echo $is_create?'required':'readonly';?>/>
		</p>		

		<p>
	 	 	<label for="mdp_id">Password:</label> 
			<input type="password"  name="mdp" id="mdp_id" <?php echo $mdpParam?'required':''?>/>
		</p>	

		<p>
	 	 	<label for="confirmmdp_id">Confirmation Password:</label> 
			<input type="password"  name="confirmmdp" id="confirmmdp_id" <?php echo $is_create?'required':'';?>/>
		</p>

		<p>
	      <label for="confimpass_id">Email</label>
	      <input type="email" value="<?php echo $email;?>" name="email" id="email_id" <?php echo $is_create?'required':'';?>/>
	    </p>

		<p>
	  		<label for="nom_id">Nom:</label> 
	  		<input type="text" value="<?php echo $nom;?>" name="nom" id="nom_id" <?php echo $is_create?'required':'';?>/>
		</p>

		<p>
	 		<label for="prenom_id">Prenom:</label> 
	 	 	<input type="text" value="<?php echo $prenom;?>" name="prenom" id="prenom_id" <?php echo $is_create?'required':'';?>/>
		</p>

		<p>
			<label for="ville_id">Ville:</label> 
			<input type="text" value="<?php echo $ville;?>" name="ville" id="ville_id" <?php echo $is_create?'required':'';?>/>
		</p>

		<p>
			<label for="pays_id">Pays:</label> 
			<input type="text" value="<?php echo $pays;?>" name="pays" id="pays_id" <?php echo $is_create?'required':'';?>/>
		</p>

		<p>
			<label for="adresse_id">Adresse:</label> 
			<input type="text" value="<?php echo $adresse;?>" name="adresse" id="adresse_id" <?php echo $is_create?'required':'';?>/>
		</p>

		<p>
			<label for="dateDeNaissance_id">Date de Naissance:</label> 
			<input type="date" value="<?php echo $dateDeNaissance;?>" name="dateDeNaissance" id="dateDeNaissance_id" <?php echo $is_create?'required':'';?>/>
		</p>

		<p>
			<input type='hidden' name='action' value=<?php echo $is_create?'created':'updated';?>>
			<input type='hidden' name='controller' value='utilisateur'>
			<input type="submit" value="Envoyer" />
		</p>
	</fieldset> 
</form>



