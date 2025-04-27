<?php
// Importer les contrôleurs
include_once('./controller/Controller.php');
include_once('./controller/WineController.php');
include_once('./controller/AccountController.php');

// Classe du contrôleur principal du fichier index.php
class RoutesController {
    // Fonction pour récupérer le contrôleur
    public function dispatch() {
        // Si aucun contrôleur n'est spécifié
        if (!isset($_GET['controller'])) {
            if((!isset($_SESSION["user"]["user_id"]) || empty($_SESSION["user"]["user_id"])))
            {
                $_GET['controller'] = 'account';
                $_GET['action'] = 'connectForm';
            }
            else{
                // Définir le contrôleur et l'action pour aller sur la page d'accueil
                $_GET['controller'] = 'wine';
                $_GET['action'] = 'listeWine';
            }
        }

        // Appeler la fonction pour sélectionner le contrôleur et le retourner
        $currentLink = $this->selectController($_GET['controller']);
        return $currentLink;
    }

    // Fonction pour sélectionner le bon contrôleur et l'instancier
    protected function selectController($controller) {
        switch ($controller) {
            case 'wine' :
                $link = new WineController();
                break;
            case 'account' :
                $link = new AccountController();
                break;
        }
        return $link;
    }
}
?>
