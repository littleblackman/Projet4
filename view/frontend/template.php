<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="public/css/style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <title><?= $title ?></title>
</head>
<body class="main-body container">
<!-- <div class="container"> -->

<header>
    <div class="row">
        <p class="col">Short Story</p>
        <ul class="nav">
            <li>
                <a class="nav-link">
                    <?php
                        if (isset($_SESSION['id']) AND isset($_SESSION['nickname'])){
                            echo "Bonjour ". $_SESSION['nickname'];
                        }
                    ?>
                </a>
            </li> 
            <li>
                <a class="nav-link" href="/projet4/index.php">Accueil</a>
            </li>
            <?php
                if (isset($_SESSION['id']) AND isset($_SESSION['nickname'])){
            ?>
            <li>
                <a class="nav-link" href="/projet4/index.php?action=checkLog">Accueil Administration</a>
            </li>
            <?php
            }
            ?>
            <li>
                <a class="nav-link" href="/projet4/index.php?action=post&id=1">Chapitre</a>
            </li>
            <li>
                <?php
                    if (isset($_SESSION['id']) AND isset($_SESSION['nickname'])){
                ?>
                    <a class="nav-link" href="/projet4/view/frontend/logout.php">Se déconnecter</a>
                <?php
                    } else {
                ?>
                    <a class="nav-link" href="/projet4/view/frontend/login.php">Se connecter</a>
                <?php
                    } 
                ?>
            </li>              
        </ul>
    </div>

<?= $content ?>

<!-- ???
</div>
-->

<!-- script -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
    
</html>