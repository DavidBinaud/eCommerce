<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title><?php echo $pagetitle; ?></title>
    </head>
    <body>
    <?php

    if(Session::is_admin()){
        echo '
    	<header>
    		<div class="nav">
			  <a href="index.php?action=readAll&controller=produit">Gestion Produits</a>
			  <a href="index.php?action=readAll&controller=utilisateur">Gestion Utilisateurs</a>
			  <a href="index.php?action=readAll&controller=commande">Gestion Commandes</a>
              <a href="index.php?action=deconnect&controller=utilisateur">Deconnexion</a>
			</div>
    	</header>';
    }else{
        echo '
        <header>
            <div class="nav">
              <a href="index.php?action=readAll&controller=produit">Produits</a>';
        if(!isset($_SESSION['login'])){
            echo '<a href="index.php?action=connect&controller=utilisateur">Connexion</a>';
        }else{
            $loginURL = rawurlencode($_SESSION['login']);
            echo "<a href='index.php?action=read&controller=utilisateur&login=$loginURL'>Compte</a>";
            echo '<a href="index.php?action=deconnect&controller=utilisateur">Deconnexion</a>';
        }

        echo    '</div>
        </header>';
    }
	
		// Si $controleur='voiture' et $view='list',
		// alors $filepath="/chemin_du_site/view/voiture/list.php"
		$filepath = File::build_path(array("view",static::$object, "$view.php"));
		require $filepath;
	?>

    </body>
    <footer>
    		<p style="border: 1px solid black;text-align:right;padding-right:1em;">
  				Site d'eCommerce de Binaud - Manelphe - Sarlin
			</p>
    </footer>
</html>