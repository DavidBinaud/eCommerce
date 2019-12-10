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
    <main>
    <body>
        <div class='container'>

        <?php

        if(Session::is_admin()){
            echo "
        	<header>
                <nav>
            		<div class='nav-wrapper grey darken-1'>
                        <ul id='nav-mobile' class='left hide-on-med-and-down'>
                			<li><a href='index.php?action=readAll&controller=produit'>Gestion Produits</a></li>
                			<li><a href='index.php?action=readAll&controller=utilisateur'>Gestion Utilisateurs</a></li>
                			<li><a href='index.php?action=readAll&controller=commande'>Gestion Commandes</a></li>
                        </ul>
                        <ul id='nav-mobile' class='right hide-on-med-and-down'>
                               <li><a href='index.php?action=getpanier&controller=produit'><i class='material-icons left'>shopping_cart</i></a></li>
                               <li><a href='index.php?action=deconnect&controller=utilisateur'><i class='material-icons left'>power_settings_new</i></a></li>
                        </ul>
        			</div>
                </nav>
        	</header>";
        }else{
            echo "
            <header>
            <nav>
                <div class='nav-wrapper grey darkenx-1'>
                <ul id='nav-mobile' class='left hide-on-med-and-down'>
                  <li><a href='index.php?action=readAll&controller=produit'>Produits</a></li>
                  </ul>";
            if(!isset($_SESSION['login'])){
                echo "
                    <ul id='nav-mobile' class='right hide-on-med-and-down'>
                        <li><a href='index.php?action=getpanier&controller=produit'><i class='material-icons left'>shopping_cart</i></a></li>
                        <li><a href='index.php?action=connect&controller=utilisateur'><i class='material-icons left'>account_circle</i></a></li>
                    </ul>";
            }else{
                $loginURL = rawurlencode($_SESSION['login']);
                echo "<li><a   
                    href='index.php?action=read&controller=utilisateur&login=$loginURL'>Compte</a></li>";
                echo "
                    <ul id='nav-mobile' class='right hide-on-med-and-down'>
                        <li><a href='index.php?action=getpanier&controller=produit'><i class='material-icons left'>shopping_cart</i></a></li>                    
                        <li><a href='index.php?action=deconnect&controller=utilisateur'><i class='material-icons left'>power_settings_new</i></a></li>
                    </ul>";
            }

            echo    '</div></nav>
            </header>';

        } echo "<div class ='boxed'>";
    	

    		$filepath = File::build_path(array("view",static::$object, "$view.php"));
    		require $filepath;
            echo '</div>';
    	?>

        </div>
    </main>
    <footer class='page-footer transparent'>
    		<p class="white-text">
  				Site d'eCommerce de Binaud - Manelphe - Sarlin
			</p>
    </footer>
</body>
</html>