<?php

if (isset($_SESSION['admin']) && $_SESSION['admin'] === true) {
    // L'utilisateur est déjà sur la page admin, pas besoin de redirection
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['logout'])) {
        // Détruire la session et rediriger vers la page de connexion
        session_destroy();
        header("Location: ?page=login");
        exit();
    }
} else {
    header("Location: ?page=login");
    exit();
}
?>
<h1>Bienvenue dans l'espace d'administration du site Mavryl Arts</h1>
<h2 class="pageBlank">Panneau d'administration</h2>

<article>
    <p>Vous êtes connecté en tant qu'administrateur.</p>
    <form method="post">
        <input type="hidden" name="logout" value="1">
        <input type="submit" value="Se déconnecter" class="disconnect">
    </form>
</article>
