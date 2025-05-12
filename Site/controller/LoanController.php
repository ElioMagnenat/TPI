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
        $id_book=$_GET['id'];
        $bookTitle = $BookRepository->getBookTitle($id_book);
        $students = $StudentRepository->getStudentNames();
        $view = file_get_contents(('view/page/book/loanFormBook.php'));
        //Permet l'affichage des bonnes données
        ob_start();
        eval('?>' . $view);
        $content = ob_get_clean();
        return $content;
    }
    public function newLoan(){
        $id_book=$_GET['id'];
        $LoanRepository = new LoanRepository();
        $LoanRepository->newLoan(
            htmlspecialchars($_POST["startDate"]),
            htmlspecialchars($_POST["expectedReturnDate"]),
            htmlspecialchars($_POST["studentId"]),
            htmlspecialchars($id_book)
        );        
        $BookRepository = new BookRepository();
        $BookRepository->updateStatus($id_book, 2);

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

        header("Location: ?controller=book&action=listBook");
    }
    
}
?>