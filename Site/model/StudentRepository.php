<?php
include_once 'model/Database.php';

class StudentRepository {
    public function getStudents (){
        $db = new Database();
        $req = $db->getStudents();
        $db->disconnect();
        $list = $db->formatData($req);
        $db->clearCash($req);
        return $list;
    }
    public function addStudent($lastname, $firstname, $birthdate, $institution, $entry_date, $validity_date, $phone, $comment, $address, $photo) {
        $db = new Database();
        $req = $db->addStudent($lastname, $firstname, $birthdate, $institution, $entry_date, $validity_date, $phone, $comment, $address, $photo);
        $db->disconnect();
        $db->clearCash($req);
    }
    
}