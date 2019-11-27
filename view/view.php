<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="css/styles.css">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
<link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet"> 
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
              <a href="index.php?action=getpanier&controller=produit">Panier</a>
              <a href="index.php?action=deconnect&controller=utilisateur">Deconnexion</a>
			</div>
    	</header>';
    }else{
        echo '
        <header>
            <div class="nav">
              <a class="waves-effect waves-light btn fspaced" href="index.php?action=readAll&controller=produit">Produits</a>';
        if(!isset($_SESSION['login'])){
            echo '<a class="waves-effect waves-light btn sspaced" href="index.php?action=getpanier&controller=produit">Panier</a>';
            echo '<a class="waves-effect waves-light btn sspaced" href="index.php?action=connect&controller=utilisateur">Connexion</a>';
        }else{
            $loginURL = rawurlencode($_SESSION['login']);
            echo "<a href='index.php?action=read&controller=utilisateur&login=$loginURL'>Compte</a>";
            echo '<a href="index.php?action=getpanier&controller=produit">Panier</a>';
            echo '<a href="index.php?action=deconnect&controller=utilisateur">Deconnexion</a>';
        }

        echo    '</div>
        </header>';
    } echo '<div class ="boxed">';
	

		$filepath = File::build_path(array("view",static::$object, "$view.php"));
		require $filepath;
        echo '</div>';
	?>

    </body>
    <footer>
    		<p style="border: 1px solid black;text-align:right;padding-right:1em;">
  				Site d'eCommerce de Binaud - Manelphe - Sarlin
			</p>
    </footer>
</html>