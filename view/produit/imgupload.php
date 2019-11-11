<?php
	$controller = static::$object;



?>
<form method="post" action="index.php" enctype="multipart/form-data">
	<fieldset> 
		<p>
		 	<label for="id_id">Id</label> :
			<input type="text" value="<?php echo $pId;?>" name="id" id="id_id" required readonly/>
		</p>
	
		<p>
			 	<label for="nom-du-fichier">Fichier</label> :
				<input type="file" name="nom-du-fichier" accept=".jpg,.png,.jpeg">
		</p>
	
	
		<p>
			<input type='hidden' name='action' value=imguploaded>
			<input type='hidden' name='controller' value=<?php echo $controller;?>>
			<input type="submit" value="Envoyer" />
		<p>
	</fieldset>

</form>

