<?php
session_start();
if(isset($_POST['deconnexion'])){
    session_destroy();
    header('location:sous-dossier/connexion.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="sous-dossier/livre-or.css">
    <title>Document</title>
</head>
<body>
    <header>
    <?php if(isset($_SESSION['login']) && $_SESSION['login'] == 'admin'){ ?>
        <ul>
            <li><a href="index.php"> Accueil</a></li>
            <li><a href="sous-dossier/livre-or.php">Livre d'or</a></li>
            <li><a href="sous-dossier/commentaires.php">Commentaires</a></li>
        </ul>
        <form action="" method="post">
            <input type="submit" value="deconnexion" class="btn btn-primary" name="deconnexion">
        </form>
    <?php } elseif(isset($_SESSION['login'])){ ?>
        <ul>
            <li><a href="index.php"> Accueil</a></li>
            <li><a href="sous-dossier/profil.php">Profil</a></li>
            <li><a href="sous-dossier/livre-or.php">Livre d'or</a></li>
            <li><a href="sous-dossier/commentaires.php">Commentaires</a></li>
        </ul>
        <form action="" method="post">
            <input type="submit" value="deconnexion" class="btn btn-primary" name="deconnexion">
        </form>
    <?php } else { ?>
        <ul>
        <li><a href="index.php"> Accueil</a></li>
            <li><a href="sous-dossier/inscription.php">Inscription</a></li>
            <li><a href="sous-dossier/connexion.php">Connexion</a></li>
            <li><a href="sous-dossier/livre-or.php">Livre d'or</a></li>
            <li><a href="https://github.com/mohamed-zidi/livre-or">Git</a></li>
        </ul>
    <?php } ?>
    </header>
    <main>
        <h1>Livre d'or</h1>
    </main>
</body>
</html>