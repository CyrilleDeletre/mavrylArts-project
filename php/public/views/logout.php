<?php
session_start();

// Détruire toutes les données de session
$_SESSION = array();

// Si vous utilisez des cookies de session, détruisez-les également
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Finalement, détruisez la session
session_destroy();

// Redirigez vers la page de connexion
header("Location: ?page=login");
exit();
?>
