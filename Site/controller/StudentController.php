<?php
require_once  'model/StudentRepository.php';
require_once 'model/LoanRepository.php';
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
    public function editFormStudent(){
        $StudentRepository = new StudentRepository();
        $id_student=$_GET['id'];
        $student = $StudentRepository->getStudent($id_student);
        $view = file_get_contents(('view/page/student/editFormStudent.php'));
        //Permet l'affichage des bonnes données
        ob_start();
        eval('?>' . $view);
        $content = ob_get_clean();
        return $content;
    }
    public function updateStudent() {
        $id_student = (int)$_GET['id'];
        $StudentRepository = new StudentRepository();
        $student = $StudentRepository->getStudent($id_student);
        $image_name = $student[0]['photo']; // Image actuelle
    
        if(isset($_FILES['picture']) && $_FILES['picture']['error'] === UPLOAD_ERR_OK) {
            $path_dir = "./ressources/img/student/";

            if (!empty($image_name)){
                unlink($path_dir . $image_name);
            }

            $file_name = $_FILES['picture']['name'];
            $fileType = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
            $date = date("Ymd_His");
            $new_image_name = str_replace(".", "", uniqid($date . "_", true)) . '.' . $fileType;
            $imgPath = $path_dir . basename($new_image_name);
            
            if (move_uploaded_file($_FILES['picture']['tmp_name'], $imgPath)) {
                $image_name = $new_image_name;
            }
        }
    
        // Appel au Repository pour mettre à jour le livre
        $StudentRepository->updateStudent(
            $id_student,
            htmlspecialchars($_POST["lastname"]),
            htmlspecialchars($_POST["firstname"]),
            htmlspecialchars($_POST["birthdate"]),
            htmlspecialchars($_POST["institution"]),
            htmlspecialchars($_POST["entry_date"]),
            htmlspecialchars($_POST["validity_date"]),
            htmlspecialchars($_POST["phone"]),
            htmlspecialchars($_POST["comment"]),
            htmlspecialchars($_POST["address"]),
            $image_name
        );
        header("Location: ?controller=student&action=listStudent");
    }
    public function detailStudent() {
        $StudentRepository = new StudentRepository();
        $id_student=$_GET['id'];
        $student = $StudentRepository->getStudent($id_student);
        $LoanRepository = new LoanRepository();
        $loans = $LoanRepository->getStudentLoans($id_student);
        $view = file_get_contents(('view/page/student/detailStudent.php'));
        //Permet l'affichage des bonnes données
        ob_start();
        eval('?>' . $view);
        $content = ob_get_clean();
        return $content;
    }
    public function removeStudent() {
        $StudentRepository = new StudentRepository();
        $id_student=$_GET['id'];
        $student = $StudentRepository->removeStudent($id_student);
        header("Location: ?controller=student&action=listStudent");
    }
}
?>