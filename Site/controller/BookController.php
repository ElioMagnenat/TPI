<?php
require_once 'model/BookRepository.php';
require_once 'model/LoanRepository.php';
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
        $LoanRepository = new LoanRepository();
        $loans = $LoanRepository->getLoans();
        foreach($loans as $loan){
            if($loan['return_date']== NULL && strtotime($loan['expected_return_date']) < time()){
                    $BookRepository->updateStatus($loan['fk_book'],3);
            }
        }
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
    public function addBook() {
        $image_name = "";
        $path_dir = "./ressources/img/book/";

        if (isset($_FILES['picture']) && $_FILES['picture']['error'] === UPLOAD_ERR_OK) {
            $file_name = $_FILES['picture']['name'];
            $fileType = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
            $allowedTypes = ['jpg', 'jpeg', 'png', 'gif', 'webp'];

            if (in_array($fileType, $allowedTypes)) {
                $date = date("Ymd_His");
                $image_name = str_replace(".", "", uniqid($date . "_", true)) . '.' . $fileType;
                $imgPath = $path_dir . $image_name;
                move_uploaded_file($_FILES['picture']['tmp_name'], $imgPath);
            }
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
            $image_name,
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

        $status = $book[0]['id_status'];
    
        // Si une nouvelle image est envoyée
        if(isset($_FILES['picture']) && $_FILES['picture']['error'] === UPLOAD_ERR_OK) {
            $path_dir = "./ressources/img/book/";

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
        if(isset($_POST['removeBook']) && $_POST['removeBook'] == 'on'){
            $status=4;
        }
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
            $status
        );
        header("Location: ?controller=book&action=listBook");
    }
    public function detailBook() {
        $BookRepository = new BookRepository();
        $id_book=$_GET['id'];
        $book = $BookRepository->getBook($id_book);
        $LoanRepository = new LoanRepository();
        $loans = $LoanRepository->getBookLoans($id_book);
        $view = file_get_contents(('view/page/book/detailBook.php'));
        ob_start();
        eval('?>' . $view);
        $content = ob_get_clean();
        return $content;
    }
    public function removeBook() {
        $BookRepository = new BookRepository();
        $id_book=$_GET['id'];
        $book = $BookRepository->removeBook($id_book);
        $category = $BookRepository->getCategory($book[0]['fk_category']);
        $book[0]['category'] = $category[0]['name'] ;
        header("Location: ?controller=book&action=listBook");
    }
    public function reinstate() {
        $id_book=htmlspecialchars($_GET['id']);
        $BookRepository = new BookRepository();
        $BookRepository->updateStatus($id_book, 1);
        header("Location: ?controller=book&action=listBook");
    }
    public function exportDatabase() {
        $user = 'bibliosolidaire';
        $pass = 'bibliosolidaire';
        $db = 'db_bibliosolidaire';
        $host = 'localhost';
        $filename = 'export_biblio_' . date('Ymd_His') . '.sql';
        $filePath = './ressources/exports/' . $filename;

        $mysqldumpPath = './ressources/exports/mysqldump.exe';

        $command = "\"$mysqldumpPath\" -h $host -u $user -p$pass $db > \"$filePath\"";

        system($command);

        if (file_exists($filePath)) {
            header('Content-Description: File Transfer');
            header('Content-Disposition: attachment; filename="' . $filename . '"');
            readfile($filePath);
            unlink($filePath);
        }
    }
    public function importDatabase() {
        if (isset($_FILES['sql_file'])) {
            $tmpPath = $_FILES['sql_file']['tmp_name'];
            $user = 'bibliosolidaire';
            $pass = 'bibliosolidaire';
            $db = 'db_bibliosolidaire';
            $host = 'localhost';

            $mysqlPath = realpath(__DIR__ . '/../ressources/import/mysql.exe');
            $command = "cmd /c \"$mysqlPath\" -h $host -u $user -p$pass $db < \"$tmpPath\"";
            system($command, $returnCode);
        }

        header("Location: ?controller=book&action=listBook");
    }
}
?>