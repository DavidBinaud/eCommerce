<form method="get" action="index.php">
	<fieldset>
		<legend>Mon formulaire de Restoration du MDP:</legend>
	    
			<p>
		 	 	<label for="mdp_id">Password:</label> 
				<input type="password"  name="mdp" id="mdp_id" required/>
			</p>	

			<p>
		 	 	<label for="confirmmdp_id">Confirmation Password:</label> 
				<input type="password"  name="confirmmdp" id="confirmmdp_id" required/>
			</p>

			<input type='hidden' name='login' value='<?php echo $login;?>'>
			<input type='hidden' name='resetpass' value='<?php echo $resetpass;?>'>
			<input type='hidden' name='action' value='resetpass'>
			<input type='hidden' name='controller' value='utilisateur'>
			<input type="submit" value="Envoyer" />
		</p>
	</fieldset> 
</form>