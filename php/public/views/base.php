<?php
session_start();
ob_start();
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Liens vers les feuilles de style -->
    <link rel="stylesheet" href="../css/base.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../css/contact.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../css/header.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../css/footer.css?v=<?php echo time(); ?>">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <!-- Script JavaScript -->
    <script src="../scripts/menuBurger.js" defer></script>
    <script src="../scripts/connexion.js" defer></script>
    <title>Mavryl Arts</title>
</head>

<body>
    <?php
    // Inclusion du fichier header.php
    include 'header.php';

    // Inclusion des différents fichiers en fonction de la page demandée
    if (!isset($_GET["page"])) {
        include 'home.php';
    }
    if (isset($_GET["page"]) && $_GET["page"] == "about") {
        include 'about.php';
    }
    if (isset($_GET["page"]) && $_GET["page"] == "gallery") {
        include 'gallery.php';
    }
    if (isset($_GET["page"]) && $_GET["page"] == "contact") {
        include 'contact.php';
    }
    if (isset($_GET["page"]) && $_GET["page"] == "login") {
        include 'login.php';
    }
    if (isset($_GET["page"]) && $_GET["page"] == "admin") {
        include 'admin.php';
    }
    if (isset($_GET["page"]) && $_GET["page"] == "logout") {
        include 'logout.php';
    }
    if (isset($_GET["page"]) && $_GET["page"] == "cgu") {
        include 'cgu.php';
    }

    // Inclusion du fichier footer.php
    include 'footer.php';
    ob_end_flush();
    ?>
</body>

</html>