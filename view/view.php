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
        <div class='container'>

        <?php

        if(Session::is_admin()){
            echo '
        	<header>
        		<div class="nav">
    			  <a class="waves-effect waves-light btn grey darken-1 fspaced" href="index.php?action=readAll&controller=produit">Gestion Produits</a>
    			  <a class="waves-effect waves-light btn grey darken-1 sspaced" href="index.php?action=readAll&controller=utilisateur">Gestion Utilisateurs</a>
    			  <a class="waves-effect waves-light btn grey darken-1 sspaced" href="index.php?action=readAll&controller=commande">Gestion Commandes</a>
                  <a class="waves-effect waves-light btn grey darken-1 sspaced" href="index.php?action=getpanier&controller=produit">Panier</a>
                  <a class="waves-effect waves-light btn grey darken-1 sspaced" href="index.php?action=deconnect&controller=utilisateur">Deconnexion</a>
    			</div>
        	</header>';
        }else{
            echo '
            <header>
                <div class="nav">
                  <a class="waves-effect waves-light btn grey darken-1 fspaced" href="index.php?action=readAll&controller=produit">Produits</a>';
            if(!isset($_SESSION['login'])){
                echo '<a class="waves-effect waves-light btn grey darken-1 sspaced" href="index.php?action=getpanier&controller=produit">Panier</a>';
                echo '<a class="waves-effect waves-light btn grey darken-1 sspaced" href="index.php?action=connect&controller=utilisateur">Connexion</a>';
            }else{
                $loginURL = rawurlencode($_SESSION['login']);
                echo '<a class="waves-effect waves-light btn grey darken-1 fspaced"  
                    href="index.php?action=read&controller=utilisateur&login=$loginURL">Compte</a>';
                echo '<a class="waves-effect waves-light btn grey darken-1 sspaced" 
                    href="index.php?action=getpanier&controller=produit">Panier</a>';
                echo '<a class="waves-effect waves-light btn grey darken-1 sspaced" href="index.php?action=deconnect&controller=utilisateur">Deconnexion</a>';
            }

            echo    '</div>
            </header>';
        } echo '<div class ="boxed">';
    	

    		$filepath = File::build_path(array("view",static::$object, "$view.php"));
    		require $filepath;
            echo '</div>';
    	?>

        </div>
    </body>
    <footer>
    		<p class="white-text">
  				Site d'eCommerce de Binaud - Manelphe - Sarlin
			</p>
    </footer>
</html>