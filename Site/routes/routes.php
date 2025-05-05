<?php
// Importer les contrôleurs
include_once('./controller/Controller.php');
include_once('./controller/BookController.php');
include_once('./controller/StudentController.php');

// Classe du contrôleur principal du fichier index.php
class RoutesController {
    // Fonction pour récupérer le contrôleur
    public function dispatch() {
        // Si aucun contrôleur n'est spécifié
        if (!isset($_GET['controller'])) {
            $_GET['controller'] = 'book';
            $_GET['action'] = 'listBook';
        }

        // Appeler la fonction pour sélectionner le contrôleur et le retourner
        $currentLink = $this->selectController($_GET['controller']);
        return $currentLink;
    }

    // Fonction pour sélectionner le bon contrôleur et l'instancier
    protected function selectController($controller) {
        switch ($controller) {
            case 'book' :
                $link = new BookController();
                break;
            case 'student' :
                $link = new StudentController();
                break;
        }
        return $link;
    }
}
?>
