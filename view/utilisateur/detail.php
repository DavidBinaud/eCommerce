<?php
	
	echo "<p> Client de login $login,d'email $email de nom $nom de prénom $prenom né(e) le $dateDeNaissance vit à $ville en $pays à l'adresse $adresse </p>";
	echo"<p>
			<a href='index.php?action=update&controller=utilisateur&login=$loginURL' class='waves-effect waves-light btn grey darken-1 sspaced'>
				<i class='material-icons left'>edit</i>Mettre à Jour
			</a>";
	echo "	<a href='index.php?action=delete&controller=utilisateur&login=$loginURL' class='waves-effect waves-light btn grey darken-1 sspaced'>
				<i class='material-icons left'>delete</i>Supprimer le compte
			</a>
		</p>";

	echo "	<p><a href='index.php?action=readByLogin&controller=commande&login=$loginURL' class='waves-effect waves-light btn grey darken-1 sspaced'>
			<i class='material-icons left'>view_list</i>Voir vos Commandes
		</a>
	</p>";


?>