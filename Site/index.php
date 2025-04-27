<?php
// Démarrer les sessions
session_start();

// Définir le fuseau horaire par défaut
date_default_timezone_set('Europe/Zurich');

// Importer le contrôleur des routes
include_once("./routes/routes.php");

// Appel du contrôleur des routes
$routesController = new RoutesController();
$currentPage = $routesController->dispatch();

// Récupérer le contenu de la page
$pageContent = $currentPage->dispatch();

// Construction de la page
include(dirname(__FILE__) . '/view/head.html');
include(dirname(__FILE__) . '/view/header.php');
echo $pageContent;
include(dirname(__FILE__) . '/view/footer.html');
?>
