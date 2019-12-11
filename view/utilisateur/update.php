<form method='<?php echo Conf::getDebug()?"GET":"POST"; ?>' action="index.php">
	<fieldset class="row">
		<legend><?php echo $is_create?'Création de Compte':'Mise à jour du compte';?></legend>

		<div class="input-field col s12">
			<input type="text" value="<?php echo $login;?>" name="login" id="login_id" <?php echo $is_create?'required':'readonly';?>/>
			<label for="login_id" class="active">Login:</label> 
		</div>		

		<div class="input-field col s12">
			<input type="password"  name="mdp" id="mdp_id" <?php echo $is_create?'required':''?>/>
			<label for="mdp_id" class="active">Password:</label> 
		</div>	

		<div class="input-field col s12">
			<input type="password" name="confirmmdp" id="confirmmdp_id" <?php echo $is_create?'required':'';?>/>
			<label for="confirmmdp_id" class="active">Confirmation Password:</label> 
		</div>

		<div class="input-field col s12">
			<input type="email" value="<?php echo $email;?>" name="email" id="email_id" <?php echo $is_create?'required':'';?>/>
			<label for="email_id" class="active">Email</label>
		</div>

		<div class="input-field col s12">
			<input type="text" value="<?php echo $nom;?>" name="nom" id="nom_id" <?php echo $is_create?'required':'';?>/>
			<label for="nom_id" class="active">Nom:</label> 
		</div>

		<div class="input-field col s12">
			<input type="text" value="<?php echo $prenom;?>" name="prenom" id="prenom_id" <?php echo $is_create?'required':'';?>/>
			<label for="prenom_id" class="active">Prenom:</label> 
		</div>

		<div class="input-field col s12">
			<input type="text" value="<?php echo $ville;?>" name="ville" id="ville_id" <?php echo $is_create?'required':'';?>/>
			<label for="ville_id" class="active">Ville:</label> 
		</div>

		<div class="input-field col s12">
			<input type="text" value="<?php echo $pays;?>" name="pays" id="pays_id" <?php echo $is_create?'required':'';?>/>
			<label for="pays_id" class="active">Pays:</label> 
		</div>

		<div class="input-field col s12">
			<input type="text" value="<?php echo $adresse;?>" name="adresse" id="adresse_id" <?php echo $is_create?'required':'';?>/>
			<label for="adresse_id" class="active">Adresse:</label> 
		</div>

		<div class="input-field col s12">
			<input type="date" value="<?php echo $dateDeNaissance;?>" name="dateDeNaissance" id="dateDeNaissance_id" <?php echo $is_create?'required':'';?>/>
			<label for="dateDeNaissance_id" class="active">Date de Naissance:</label> 
		</div>

		<?php 
			if(Session::is_admin()){
				echo "<div class='col s12'><label>
				<input type='checkbox' "; 
				echo $is_admin?"checked='checked'":'';
				echo "name='is_admin' id='is_admin_id'/>
				<span>Administrateur:</span> </label>
				</div>";
			}
		?>

		<div class="col s12">
			<input type='hidden' name='action' value=<?php echo $is_create?'created':'updated';?>>
			<input type='hidden' name='controller' value='utilisateur'>
			<input type="submit" value="Envoyer" />
		</div>
	</fieldset> 
</form>