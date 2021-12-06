<?php

session_start();
if(isset($_POST['deconnexion'])){
    session_destroy();
    header('location:connexion.php');
}

if(isset($_POST['btn'])){
    
    $sessionlogin = $_SESSION['login'];
    $com = $_POST['com'];
    $bdd = mysqli_connect('localhost','root','','livreor');
    $selectid = mysqli_query($bdd,"SELECT id FROM utilisateurs WHERE login = '$sessionlogin'");
    $s = mysqli_fetch_all($selectid);
    $id = $s[0][0]; #Recuperation de l'id
       
    #Insertion du commentaire 
    if(!empty($com)){
    
        $querycom = mysqli_query($bdd,"INSERT INTO commentaires (commentaire, id_utilisateur, date) VALUES ('$com','$id',NOW())");
    
        $comment = 'Votre commentaire a été pris en compte';
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
            <label for="com">Entrez votre commentaire:</label>
            <input type="text" name="com" id="com">

            <input type="submit" value="Valider" class="btn btn-primary" name="btn">
        </form>
    <p>
        <?php if(isset($comment)){
            echo $comment;
        }
        ?>
    </p>
    </main>
    
    </body>
</html>