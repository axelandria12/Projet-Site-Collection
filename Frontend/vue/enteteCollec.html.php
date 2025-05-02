<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
        <title><?php echo "Projet Collection" //$titre ?></title>
        <link rel="stylesheet" href="../css/css_entete.css">
        <link rel="stylesheet" href="../css/css_image.css">
    </head>
    <body>
    <div>
    <header>
    <a href="./?action=Main.php"><img src="../images/collecthor.png" class="photo" alt="logo" /></a> 
    <div class="search-bar">
      <input type="text" placeholder="Rechercher...">
    </div>
  <?php include_once "../../Backend/data.php" ?>
    <?php if(isLoggedIn()){ ?>
            <a href="./?action=profil"><img src="images/profil.png" alt="loupe" />Mon Profil</a><
            <?php } 
            else{ ?>
            <a href="./?action=cgu"><img src="../images/connexion.png" class="photo" alt="déconnecter" /></a>
            <?php } ?>
            
</header>
