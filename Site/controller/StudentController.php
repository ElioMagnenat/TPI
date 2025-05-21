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
    $path_dir = "./ressources/img/student/";
    $imgPath = null;
    if (!empty($_POST['cropped_picture'])) {
        $data = $_POST['cropped_picture'];
        $data = str_replace('data:image/jpeg;base64,', '', $data);
        $data = base64_decode($data);
        $image_name = uniqid('student_', true) . '.jpg';
        $imgPath = $image_name;
        file_put_contents($path_dir.$imgPath, $data);
    }


    // Enregistrement
    $StudentRepository = new StudentRepository();
    $StudentRepository->addStudent(
        htmlspecialchars($_POST["lastname"]),
        htmlspecialchars($_POST["firstname"]),
        htmlspecialchars($_POST["birthdate"]),
        htmlspecialchars($_POST["institution"]),
        htmlspecialchars($_POST["entry_date"]),
        htmlspecialchars($_POST["validity_date"]),
        htmlspecialchars($_POST["phone"]),
        htmlspecialchars($_POST["comment"]),
        htmlspecialchars($_POST["address"]),
        $imgPath
    );
    $_SESSION['popup_message'] = "L'élève a bien été créé !";
    // Redirection
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
        $path_dir = "./ressources/img/student/";

        if (!is_dir($path_dir)) {
            mkdir($path_dir, 0755, true);
        }

        if (!empty($_POST['cropped_picture'])) {
            if (!empty($image_name)) {
                @unlink($path_dir . $image_name);
            }

            $data = $_POST['cropped_picture'];
            $data = str_replace('data:image/jpeg;base64,', '', $data);
            $data = base64_decode($data);
            $new_image_name = uniqid('student_', true) . '.jpg';
            $imgPath = $path_dir . $new_image_name;
            file_put_contents($imgPath, $data);
            $image_name = $new_image_name;
        }

        elseif (isset($_FILES['picture']) && $_FILES['picture']['error'] === UPLOAD_ERR_OK) {
            if (!empty($image_name)) {
                @unlink($path_dir . $image_name);
            }

            $file_name = $_FILES['picture']['name'];
            $fileType = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
            $new_image_name = uniqid(date("Ymd_His") . "_", true) . '.' . $fileType;
            $imgPath = $path_dir . basename($new_image_name);

            if (move_uploaded_file($_FILES['picture']['tmp_name'], $imgPath)) {
                $image_name = $new_image_name;
            }
        }

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
        $_SESSION['popup_message'] = "L'élève a bien été modifié !";
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
        $_SESSION['popup_message'] = "L'élève a bien été supprimé !";
        header("Location: ?controller=student&action=listStudent");
    }
}
?>