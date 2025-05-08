<?php
include 'model/BookRepository.php';
// Classe pour le contrôleur des livres
class BookController extends Controller {
    // Fonction pour récupérer l'action et appeler la bonne fonction
    public function dispatch() {
        // Récupération de l'action
        $action = $_GET['action'];

        // Effectue un appel dynamique à la fonction en fonction de l'action
        return call_user_func((array($this, $action)));
    }

    public function listBook(){
        $BookRepository = new BookRepository();
        $list = $BookRepository->getBooks();
        $view = file_get_contents(('view/page/book/listBook.php'));
        //Permet l'affichage des bonnes données
        ob_start();
        eval('?>' . $view);
        $content = ob_get_clean();
        return $content;
    }
    public function addFormBook(){
        $BookRepository = new BookRepository();
        $categories = $BookRepository->getCategories();
        $view = file_get_contents(('view/page/book/addFormBook.php'));

        //Permet l'affichage des bonnes données
        ob_start();
        eval('?>' . $view);
        $content = ob_get_clean();
        return $content;
    }
    public function addBook(){
        if (isset($_FILES['picture']) && !empty($_FILES['picture'])){
            $file_name = $_FILES['picture']['name'];
            $fileType = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
            $date = date("Ymd_His");
            $image_name = str_replace(".", "", uniqid($date . "_", true)) . '.' . $fileType;
            $path_dir = "./ressources/img/book/";
            $imgPath = $path_dir . basename($image_name);
            move_uploaded_file($_FILES['picture']['tmp_name'], $imgPath);
        }
        $status = 1;
        $BookRepository = new BookRepository();
        $BookRepository->addBook(
            htmlspecialchars($_POST["title"]),
            htmlspecialchars($_POST["author"]),
            htmlspecialchars($_POST["edition"]),
            htmlspecialchars($_POST["reference"]),
            htmlspecialchars($_POST["location"]),
            htmlspecialchars($_POST["comment"]),
            $imgPath,
            htmlspecialchars($_POST["category"]),
            $status
        );        
        header("Location: ?controller=book&action=listBook");

    }
    public function editFormBook(){
        $BookRepository = new BookRepository();
        $id_book=$_GET['id'];
        $book = $BookRepository->getBook($id_book);
        $categories = $BookRepository->getCategories();
        $view = file_get_contents(('view/page/book/editFormBook.php'));
        //Permet l'affichage des bonnes données
        ob_start();
        eval('?>' . $view);
        $content = ob_get_clean();
        return $content;
    }
    public function updateBook() {
        $id_book = (int)$_GET['id'];
        $BookRepository = new BookRepository();
        $book = $BookRepository->getBook($id_book);
        $image_name = $book[0]['photo']; // Image actuelle
    
        // Si une nouvelle image est envoyée
        if (isset($_FILES['picture']) && !empty($_FILES['picture'])) {
            $file_name = $_FILES['picture']['name'];
            $fileType = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
            $date = date("Ymd_His");
            $new_image_name = str_replace(".", "", uniqid($date . "_", true)) . '.' . $fileType;
            $path_dir = "./ressources/img/book/";
            $imgPath = $path_dir . basename($new_image_name);
            
            if (move_uploaded_file($_FILES['picture']['tmp_name'], $imgPath)) {
                $image_name = $new_image_name;
            }
        }
    
        // Appel au Repository pour mettre à jour le livre
        $BookRepository->updateBook(
            $id_book,
            htmlspecialchars($_POST["title"]),
            htmlspecialchars($_POST["author"]),
            htmlspecialchars($_POST["edition"]),
            htmlspecialchars($_POST["reference"]),
            htmlspecialchars($_POST["location"]),
            htmlspecialchars($_POST["comment"]),
            $image_name,
            htmlspecialchars($_POST["category"]),
            $book[0]['fk_status']
        );
        header("Location: ?controller=book&action=listBook");
    }
}
?>