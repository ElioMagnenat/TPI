<?php
include_once 'model/Database.php';

class LoanRepository {
    public function newLoan($start_date, $expected_return, $fk_student, $fk_book) {
        $db = new Database();
        $req = $db->newLoan($start_date, $expected_return, $fk_student, $fk_book);
        $db->disconnect();
        $db->clearCash($req);
    }
    public function closeLoan($id_loan, $return_date, $comment) {
        $db = new Database();
        $req = $db->closeLoan($id_loan, $return_date, $comment);
        $db->disconnect();
        $db->clearCash($req);
    }
    public function getIdBook($id_loan) {
        $db = new Database();
        $req = $db->getIdBook($id_loan);
        $db->disconnect();
        $id_book = $db->formatData($req);
        $db->clearCash($req);
        return $id_book;
    }
    public function getIdLoan($id_book) {
        $db = new Database();
        $req = $db->getIdLoan($id_book);
        $db->disconnect();
        $id_loan = $db->formatData($req);
        $db->clearCash($req);
        return $id_loan;
    }
    public function getBookLoans($id_book) {
        $db = new Database();
        $req = $db->getBookLoans($id_book);
        $db->disconnect();
        $loans = $db->formatData($req);
        $db->clearCash($req);
        return $loans;
    }
    public function getStudentLoans($id_student) {
        $db = new Database();
        $req = $db->getStudentLoans($id_student);
        $db->disconnect();
        $loans = $db->formatData($req);
        $db->clearCash($req);
        return $loans;
    }
    public function getLoans() {
        $db = new Database();
        $req = $db->getLoans();
        $db->disconnect();
        $loans = $db->formatData($req);
        $db->clearCash($req);
        return $loans;
    }
}