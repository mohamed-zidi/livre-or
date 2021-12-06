<?php
if(isset($_POST['deconnexion'])){
    session_destroy();
    header('location:connexion.php');
}

if(isset($_POST['connexion'])){
    $loginconnect = htmlspecialchars($_POST['loginconnexion']);
    $mdpconnect = sha1($_POST['mdpconnexion']);
}

if(!empty($loginconnect) && !empty($mdpconnect)){
    $db = mysqli_connect('localhost','root','','livreor');
    $res = mysqli_query($db,"SELECT * FROM utilisateurs WHERE login = '".$loginconnect."' && password = '".$mdpconnect."' ");
    $result = mysqli_num_rows($res);

    if($result == 1){
        session_start();
        $_SESSION['login'] = $loginconnect;
        $_SESSION['mdp'] = $mdpconnect;
        header('location:../index.php');
    } else {
        $affichage = 'Mot de passe érroné';
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

            <div class ="mb-3">
            <label for="connexion" class="form-label">Entrez votre login : </label>
            <input type="text" name="loginconnexion" id="loginconnexion">
            </div>

            <div class="mb-3">
            <label for="mdpconnexion" class="form-label">Votre mot de passe :</label>
            <input type="password" name="mdpconnexion" id="mdpconnexion">
            </div>

            <input type="submit" value="Se connecter" class="btn btn-primary" name="connexion">
        </form>

        <?php if(isset($affichage)){
            echo $affichage;
        }
        ?>
    </main>

    </body>
</html>