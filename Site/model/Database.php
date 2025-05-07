<?php

class Database 
{
    public $connector;

    /**
     * Constructeur
     */
    function __construct()
    {
        $this->connect();
    }

    /**
     * Connection à la base de données
     */
    public function connect() {
        $this->connector = new PDO('mysql:host=localhost;dbname=db_bibliosolidaire;charset=utf8', 'bibliosolidaire','bibliosolidaire');
    }

    /**
        * Disconnect
        */
    public function disconnect() {
        $this->connector = null;
    }

    /**
        * Clear cash
        *
        * @param mixed $req
        */
    public function clearCash($req) {
        $req->closeCursor();
    }

    /**
        * Fetch all
        *
        * @param mixed $req
        * @return void retourne les données associées
        */
    public function formatData($req) {
        return $req->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getBooks ()
    {
        $req = $this->connector->prepare("
            SELECT 
                book.title,
                book.author,
                book.edition,
                category.name AS category,
                book.reference,
                book.location,
                status.name AS status
            FROM 
                book
            JOIN 
                category ON book.fk_category = category.id_category
            JOIN 
                status ON book.fk_status = status.id_status
            ORDER BY 
                book.title ASC;

        ");
        $req->execute();
        return $req;
    }
}