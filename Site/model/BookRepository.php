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
}