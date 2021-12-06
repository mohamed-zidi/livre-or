<?php
session_start();
if(isset($_POST['deconnexion'])){
    session_destroy();
    header('location:connexion.php');
}
?>
<?php
if(isset($_POST['valider'])){
    $login = htmlspecialchars($_POST['login']);
    $mdp = sha1($_POST['mdp']);
    $mdp2 = sha1($_POST['mdp2']);
    $affichage = NULL ;

    if(!empty($login) && !empty($mdp) && !empty($mdp2)){

    if($mdp == $mdp2){
        $bdd = mysqli_connect('localhost','root','','livreor') or die('erreur');
        $req = "INSERT INTO utilisateurs (`login`, `password`) VALUES ('$login' , '$mdp ') ";
        $res = mysqli_query($bdd,$req);
        header('location:connexion.php');
    } else {
        $affichage = 'Confirmez votre mot de passe';
    }
    } else{
        $affichage = 'Tous les champs doivent être remplis';
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
            <label for="login">Ajoutez votre login</label>
            <input type="text" name="login" id="login">

            <label for="mdp">Entrez votre mot de passe:</label>
            <input type="password" name="mdp" id="mdp">

            <label for="mdp2">Confirmez votre mot de passe:</label>
            <input type="password" name="mdp2" id="mdp2">

            <input type="submit" value="S'inscrire" class="btn btn-primary" name="valider">

        </form>

        <?php 
            if(isset($affichage)){
            echo $affichage ; 
            } ?>
    </main>
    </body>
</html>