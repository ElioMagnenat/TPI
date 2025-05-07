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
    public function getCategories ()
    {
        $req = $this->connector->prepare("SELECT * FROM category");
        $req->execute();
        return $req;
    }
    public function addBook ($title,$author,$edition,$reference,$location,$comment,$photo,$fk_category, $fk_status)
    {
        $req = $this->connector->prepare("
            INSERT INTO 
            book (id_book, title, author, edition, reference, location, comment, photo, fk_category, fk_status)
            VALUES (NULL, :title, :author, :edition, :reference, :location, :comment, :photo, :fk_category, :fk_status)
        ");
        $req->bindValue('title', $title, PDO::PARAM_STR);
        $req->bindValue('author', $author, PDO::PARAM_STR);
        $req->bindValue('edition', $edition, PDO::PARAM_STR);
        $req->bindValue('reference', $reference, PDO::PARAM_STR);
        $req->bindValue('location', $location, PDO::PARAM_STR);
        $req->bindValue('comment', $comment, PDO::PARAM_STR);
        $req->bindValue('photo', $photo, PDO::PARAM_STR);
        $req->bindValue('fk_category', $fk_category, PDO::PARAM_INT);
        $req->bindValue('fk_status', $fk_status, PDO::PARAM_INT);
        $req->execute();
        return $req;
    }
}