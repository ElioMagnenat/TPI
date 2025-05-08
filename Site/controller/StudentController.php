<?php
include 'model/StudentRepository.php';
// Classe pour le contrôleur des élèves
class StudentController extends Controller {
    // Fonction pour récupérer l'action et appeler la bonne fonction
    public function dispatch() {
        // Récupération de l'action
        $action = $_GET['action'];

        // Effectue un appel dynamique à la fonction en fonction de l'action
        return call_user_func((array($this, $action)));
    }
    public function listStudent(){
        $StudentRepository = new StudentRepository();
        $list = $StudentRepository->getStudents();
        $view = file_get_contents(('view/page/student/listStudent.php'));
        //Permet l'affichage des bonnes données
        ob_start();
        eval('?>' . $view);
        $content = ob_get_clean();
        return $content;
    }
    public function addFormStudent(){
        $view = file_get_contents(('view/page/student/addFormStudent.php'));
        //Permet l'affichage des bonnes données
        ob_start();
        eval('?>' . $view);
        $content = ob_get_clean();
        return $content;
    }
    public function addStudent() {
        $imgPath = null;
        if (isset($_FILES['picture']) && !empty($_FILES['picture']['name'])) {
            $file_name = $_FILES['picture']['name'];
            $fileType = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
            $date = date("Ymd_His");
            $image_name = str_replace(".", "", uniqid($date . "_", true)) . '.' . $fileType;
            $path_dir = "./ressources/img/student/";
            $imgPath = $path_dir . basename($image_name);

            move_uploaded_file($_FILES['picture']['tmp_name'], $imgPath);
        }
    
        // Sécurité des champs via htmlspecialchars
        $lastname = htmlspecialchars($_POST["lastname"]);
        $firstname = htmlspecialchars($_POST["firstname"]);
        $birthdate = htmlspecialchars($_POST["birthdate"]);
        $institution = htmlspecialchars($_POST["institution"]);
        $entry_date = htmlspecialchars($_POST["entry_date"]);
        $validity_date = htmlspecialchars($_POST["validity_date"]);
        $phone = htmlspecialchars($_POST["phone"]);
        $comment = htmlspecialchars($_POST["comment"]);
        $address = htmlspecialchars($_POST["address"]);
    
        // Appel au Repository
        $StudentRepository = new StudentRepository();
        $StudentRepository->addStudent(
            $lastname,
            $firstname,
            $birthdate,
            $institution,
            $entry_date,
            $validity_date,
            $phone,
            $comment,
            $address,
            $imgPath
        );
    
        // Redirection après ajout
        header("Location: ?controller=student&action=listStudent");
    }
    
}
?>