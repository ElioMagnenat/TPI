<?php
// Classe du contrôleur principal
abstract class Controller {
    // Appeler l'action
    public function display() {
        $page = $_GET['action'] . "Display";

        $this->$page();
    }
}
?>
