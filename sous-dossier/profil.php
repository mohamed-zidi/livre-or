<?php
session_start();
if(isset($_POST['deconnexion'])){
    session_destroy();
    header('location:connexion.php');
}

if(isset($_SESSION['login'])){
    $sessionlogin = $_SESSION['login'];
    $sessionmdp = $_SESSION['mdp'];
}

if(isset($_POST['bte_profil'])){
    $newlogin = htmlspecialchars($_POST['newlogin']);
    $newmdp = sha1($_POST['newmdp']);
    $newmdp2 = sha1($_POST['newmdp2']);
    $db = mysqli_connect('localhost','root','','livreor');

    if(!empty($newlogin) && $newmdp == $sessionmdp){
        
        $queryl =mysqli_query($db,"UPDATE utilisateurs SET login ='$newlogin' WHERE login = '$sessionlogin'  ");
        $changelogin = "Votre login a été modifié";

    } elseif(!empty($newmdp) && !empty($newmdp2)){
    
        if($newmdp == $sessionmdp){
            $queryp = mysqli_query($db,"UPDATE utilisateurs SET password = '$newmdp2' WHERE login = '$sessionlogin'");
            $changemdp = "Votre mot de passe a été modifié";
        } 
            
        
    } else {
    
        $changelogin = "Il y a une erreur";
    }

    
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="livre-or.css">
    <title>Document</title>
</head>
<body>
    <header>
    <?php if(isset($_SESSION['login']) && $_SESSION['login'] == 'admin'){ ?>
        <ul>
            <li><a href="../index.php"> Accueil</a></li>
            <li><a href="livre-or.php">Livre d'or</a></li>
            <li><a href="commentaires.php">Commentaires</a></li>
        </ul>
        <form action="" method="post">
            <input type="submit" value="deconnexion" class="btn btn-primary" name="deconnexion">
        </form>
    <?php } elseif(isset($_SESSION['login'])){ ?>
        <ul>
            <li><a href="../index.php"> Accueil</a></li>
            <li><a href="profil.php">Profil</a></li>
            <li><a href="livre-or.php">Livre d'or</a></li>
            <li><a href="commentaires.php">Commentaires</a></li>
        </ul>
        <form action="" method="post">
            <input type="submit" value="deconnexion" class="btn btn-primary" name="deconnexion">
        </form>
    <?php } else { ?>
        <ul>
        <li><a href="../index.php"> Accueil</a></li>
            <li><a href="inscription.php">Inscription</a></li>
            <li><a href="connexion.php">Connexion</a></li>
            <li><a href="livre-or.php">Livre d'or</a></li>
        </ul>
    <?php } ?>
    </header>
    <main>
        <form action="" method="post">
            <label for="newlogin">Entrez votre nouveau login:</label>
            <input type="text" name="newlogin" id="newlogin">

            <label for="newmdp">Entrez votre mot de passe:</label>
            <input type="password" name="newmdp" id="newmdp">

            <label for="newmdp2">Entrez votre nouveau mot de passe:</label>
            <input type="password" name="newmdp2" id="newmdp2">

            <input type="submit" value="Valider" class="btn btn-primary" name="bte_profil">

        </form>

        <?php if(isset($changelogin)){ ?>
          <p> <?php echo $changelogin; ?> </p>
           
        <?php } elseif(isset($changemdp)){ ?> 

        <p> <?php echo $changemdp; ?> </p>
        
        <?php } ?>
        
    </main>
    </body>
</html>