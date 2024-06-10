<?php
// Page d'accueil de l'espace d'administration

// Si on est connecté en tant qu'admin
if (isset($_SESSION['admin']) && $_SESSION['admin'] === true) {
    // Si on fait la requête déconnexion
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['logout'])) {
        // Dans ce cas on détruit la session
        session_destroy();
        // Et on se redirige vers la page de connexion
        header("Location: ?page=login");
        exit();
    }
} else {
    // Si on est pa connecté en tant qu'admin, on se redirige vers la page de connexion
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