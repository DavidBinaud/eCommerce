<div class="row">	
	<form method='<?php echo Conf::getDebug()?"GET":"POST"; ?>' action="index.php" class="col s12">
		<fieldset class="row">
			<legend>Mon formulaire de Connexion:</legend>

			<div class="input-field col s12">
				<i class="material-icons prefix">account_circle</i>
				<input type="text" value='<?php echo $login;?>' name="login" id="login_id" class="validate" required>
				<label class="active" for="login_id">Login:</label>
			</div>

			<div class="input-field col s12">
				<i class="material-icons prefix">vpn_key</i>
				<input type="password"  name="mdp" id="mdp_id" required/>
				<label for="mdp_id" class="active">Mot de Passe:</label>
			</div>

			<p>
				<input type='hidden' name='action' value='connected'>
				<input type='hidden' name='controller' value='utilisateur'>
				<button class="btn waves-effect waves-light" type="submit">Se connecter
					<i class="material-icons right">send</i>
				</button>
			</p>
			<a href="index.php?action=create&controller=utilisateur" class="waves-effect waves-light btn"><i class="material-icons left">create</i>S'inscrire</a>
			<a href="index.php?action=askresetpass&controller=utilisateur" class="waves-effect waves-light btn"><i class="material-icons left">sync</i>Mot de passe oublié?</a>
		</fieldset>

	</form>
