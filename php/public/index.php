<?php 
// Inclusion du fichier Controller.php
require_once __DIR__ . "/controllers/Controller.php";

// Instanciation de la classe Controller
$controller = new Controller;

// Appel de la méthode index() de l'objet $controller
$controller->index();
?>