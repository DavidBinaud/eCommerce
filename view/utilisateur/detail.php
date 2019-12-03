<?php
	
	echo "<p> Client de login $ulogin,d'email $uemail de nom $unom de prénom $uprenom né(e) le $udateDeNaissance vit à $uville en $upays à l'adresse $uadresse </p>";
	echo"<p>
			<a href=index.php?action=update&controller=utilisateur&login=$uloginURL class='waves-effect waves-light btn grey darken-1 sspaced'>
				<i class='material-icons left'>edit</i>Mettre à Jour
			</a>";
	echo "	<a href=index.php?action=delete&controller=utilisateur&login=$uloginURL class='waves-effect waves-light btn grey darken-1 sspaced'>
				<i class='material-icons left'>delete</i>Supprimer
			</a>
		</p>";


?>