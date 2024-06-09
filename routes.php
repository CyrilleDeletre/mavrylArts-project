<?php
// C'est un exemple pour les routes
require_once __DIR__.'/router.php';

get("/", "./index.php");
// ---------------- Syntaxe ------------------------
get("/variables", "./01-syntaxe/01-variable.php");

// Err 404
any("/404", "./404.php");