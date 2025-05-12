<?php
include_once 'model/Database.php';

class BookRepository {
    public function getBooks (){
        $db = new Database();
        $req = $db->getBooks();
        $db->disconnect();
        $list = $db->formatData($req);
        $db->clearCash($req);
        return $list;
    }
    public function getCategories (){
        $db = new Database();
        $req = $db->getCategories();
        $db->disconnect();
        $categories = $db->formatData($req);
        $db->clearCash($req);
        return $categories;
    }
    public function addBook ($title,$author,$edition,$reference,$location,$comment,$photo,$fk_category, $fk_status){
        $db = new Database();
        $req = $db->addBook($title,$author,$edition,$reference,$location,$comment,$photo,$fk_category, $fk_status);
        $db->disconnect();
        $db->clearCash($req);
    }
    public function getBook ($id_book){
        $db = new Database();
        $req = $db->getBook($id_book);
        $db->disconnect();
        $book = $db->formatData($req);
        $db->clearCash($req);
        return $book;
    }
    public function updateBook ($id_book, $title,$author,$edition,$reference,$location,$comment,$photo,$fk_category, $fk_status){
        $db = new Database();
        $req = $db->updateBook($id_book, $title,$author,$edition,$reference,$location,$comment,$photo,$fk_category, $fk_status);
        $db->disconnect();
        $db->clearCash($req);
    }
    public function getCategory ($id_category){
        $db = new Database();
        $req = $db->getCategory($id_category);
        $db->disconnect();
        $book = $db->formatData($req);
        $db->clearCash($req);
        return $book;
    }
    public function removeBook ($id_book){
        $db = new Database();
        $req = $db->removeBook($id_book);
        $db->disconnect();
        $book = $db->formatData($req);
        $db->clearCash($req);
        return $book;
    }
    public function getBookTitle ($id_book){
        $db = new Database();
        $req = $db->getBookTitle($id_book);
        $db->disconnect();
        $book = $db->formatData($req);
        $db->clearCash($req);
        return $book;
    }
    public function updateStatus ($id_book,$fk_status){
        $db = new Database();
        $req = $db->updateStatus($id_book,$fk_status);
        $db->disconnect();
        $book = $db->formatData($req);
        $db->clearCash($req);
        return $book;
    }
}