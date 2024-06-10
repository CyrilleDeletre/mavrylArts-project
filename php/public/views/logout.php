<?php
// Verification qu'il y'a bien une session active, si non, on en crée une
if (!isset($_SESSION)) {
    session_start();
}

// Détruire toutes les données de session
$_SESSION = array();

// Si vous utilisez des cookies de session, on les détruit également
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// On détruit la session
session_destroy();

// On redirige vers la page de connexion
header("Location: ?page=login");
exit();
?>
