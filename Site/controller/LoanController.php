<?php
require_once 'model/BookRepository.php';
require_once  'model/StudentRepository.php';
require_once  'model/LoanRepository.php';
// Classe pour le contrôleur des livres
class LoanController extends Controller {
    // Fonction pour récupérer l'action et appeler la bonne fonction
    public function dispatch() {
        // Récupération de l'action
        $action = $_GET['action'];

        // Effectue un appel dynamique à la fonction en fonction de l'action
        return call_user_func((array($this, $action)));
    }
    public function loanFormBook() {
        $BookRepository = new BookRepository();
        $StudentRepository = new StudentRepository();

        $bookTitle = [];

        if (isset($_GET['ids'])) {
            $ids = explode(',', $_GET['ids']);
            foreach ($ids as $id) {
                $book = $BookRepository->getBookTitle((int)$id);
                if ($book) {
                    $bookTitle[] = $book[0];
                }
            }
        } elseif (isset($_GET['id'])) {
            $id = (int)$_GET['id'];
            $book = $BookRepository->getBookTitle($id);
            if ($book) {
                $bookTitle[] = $book[0];
            }
        }

        $students = $StudentRepository->getStudentNames();

        $view = file_get_contents('view/page/book/loanFormBook.php');
        ob_start();
        eval('?>' . $view);
        $content = ob_get_clean();
        return $content;
    }

    public function newLoan() {
        $bookIds = explode(',', $_GET['ids'] ?? '');
        $LoanRepository = new LoanRepository();
        $BookRepository = new BookRepository();

        $startDate = htmlspecialchars($_POST["startDate"]);
        $expectedReturnDate = htmlspecialchars($_POST["expectedReturnDate"]);
        $studentId = htmlspecialchars($_POST["studentId"]);

        foreach ($bookIds as $id_book) {
            $id_book = htmlspecialchars(trim($id_book));
            if (!empty($id_book)) {
                $LoanRepository->newLoan($startDate, $expectedReturnDate, $studentId, $id_book);
                $BookRepository->updateStatus($id_book, 2);
            }
        }
        $_SESSION['popup_message'] = "L'emprunt a bien été effectué !";
        header("Location: ?controller=book&action=listBook");
    }
    public function restoreFormBook() {
        $BookRepository = new BookRepository();
        $LoanRepository = new LoanRepository();
        $id_book=htmlspecialchars($_GET['id']);
        $bookTitle = $BookRepository->getBookTitle(htmlspecialchars($id_book));
        $id_loan = $LoanRepository->getIdLoan(htmlspecialchars($id_book));
        $view = file_get_contents(('view/page/book/restoreFormBook.php'));
        //Permet l'affichage des bonnes données
        ob_start();
        eval('?>' . $view);
        $content = ob_get_clean();
        return $content;
    }
    public function closeLoan() {
        $id_loan = $_GET['id'];

        $LoanRepository = new LoanRepository();
        $LoanRepository->closeLoan(
            htmlspecialchars($id_loan),
            htmlspecialchars($_POST["returnDate"]),
            htmlspecialchars($_POST["comment"])
        );
        $id_book = $LoanRepository->getIdBook(htmlspecialchars($id_loan));
        $BookRepository = new BookRepository();
        $BookRepository->updateStatus($id_book[0]['fk_book'], 1);
        $_SESSION['popup_message'] = "Le rendu a bien été effectué !";
        header("Location: ?controller=book&action=listBook");
    }
    
}
?>