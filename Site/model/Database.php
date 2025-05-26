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
    //Books section
    public function getBooks ()
    {
        $req = $this->connector->prepare("
            SELECT 
                book.id_book,
                book.title,
                book.author,
                book.edition,
                category.name AS category,
                category.id_category,
                book.reference,
                book.location,
                status.name AS status,
                status.id_status AS id_status
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
    public function getBook ($id_book)
    {
    $req = $this->connector->prepare("
            SELECT 
                book.id_book,
                book.title,
                book.author,
                book.edition,
                category.name AS category,
                category.id_category AS id_category,
                book.reference,
                book.location,
                book.comment,
                book.photo,
                status.name AS status,
                status.id_status AS id_status
            FROM 
                book
            JOIN 
                category ON book.fk_category = category.id_category
            JOIN 
                status ON book.fk_status = status.id_status
            WHERE 
                book.id_book = :id_book
        ");

        $req->bindValue('id_book', $id_book, PDO::PARAM_INT);
        $req->execute();
        return $req;
    }
    public function updateBook ($id_book, $title,$author,$edition,$reference,$location,$comment,$photo,$fk_category, $fk_status)
    {
        $req = $this->connector->prepare("
            UPDATE book SET 
                title = :title, 
                author = :author, 
                edition = :edition, 
                reference = :reference, 
                location = :location, 
                comment = :comment, 
                photo = :photo, 
                fk_category = :fk_category,
                fk_status = :fk_status
            WHERE id_book = :id_book
        ");
        $req->bindValue('id_book', $id_book, PDO::PARAM_INT);
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
    public function getCategory ($id_category)
    {
        $req = $this->connector->prepare("SELECT name FROM category WHERE id_category = :id_category");
        $req->bindValue('id_category', $id_category, PDO::PARAM_INT);
        $req->execute();
        return $req;
    }
    public function removeBook ($id_book)
    {
        $req = $this->connector->prepare("DELETE FROM book WHERE id_book = :id_book");
        $req->bindValue('id_book', $id_book, PDO::PARAM_INT);
        $req->execute();
        return $req;
    }
    public function getBookTitle ($id_book)
    {
        $req = $this->connector->prepare("SELECT id_book, title FROM book WHERE id_book = :id_book");
        $req->bindValue('id_book', $id_book, PDO::PARAM_INT);
        $req->execute();
        return $req;
    }
    public function updateStatus ($id_book,$fk_status)
    {
        $req = $this->connector->prepare("
            UPDATE book SET 
                fk_status = :fk_status
            WHERE id_book = :id_book
        ");
        $req->bindValue('id_book', $id_book, PDO::PARAM_INT);
        $req->bindValue('fk_status', $fk_status, PDO::PARAM_INT);
        $req->execute();
        return $req;
    }
    //Students section
    public function getStudents ()
    {
        $req = $this->connector->prepare("
            SELECT 
                id_student,
                lastname,
                firstname,
                institution,
                entry_date,
                validity_date
            FROM 
                student
        ");
        $req->execute();
        return $req;
    }
    public function addStudent($lastname, $firstname, $birthdate, $institution, $entry_date, $validity_date, $phone, $comment, $address, $photo)
    {
        $req = $this->connector->prepare("
            INSERT INTO 
            student (id_student, lastname, firstname, birthdate, institution, entry_date, validity_date, phone, comment, address, photo)
            VALUES (NULL, :lastname, :firstname, :birthdate, :institution, :entry_date, :validity_date, :phone, :comment, :address, :photo)
        ");
        $req->bindValue('lastname', $lastname, PDO::PARAM_STR);
        $req->bindValue('firstname', $firstname, PDO::PARAM_STR);
        $req->bindValue('birthdate', $birthdate, $birthdate ? PDO::PARAM_STR : PDO::PARAM_NULL);
        $req->bindValue('institution', $institution, PDO::PARAM_STR);
        $req->bindValue('entry_date', $entry_date, PDO::PARAM_STR);
        $req->bindValue('validity_date', $validity_date, PDO::PARAM_STR);
        $req->bindValue('phone', $phone, PDO::PARAM_STR);
        $req->bindValue('comment', $comment, PDO::PARAM_STR);
        $req->bindValue('address', $address, PDO::PARAM_STR);
        $req->bindValue('photo', $photo, PDO::PARAM_STR);
        $req->execute();
        return $req;
    }
    public function getStudent ($id_student)
    {
        $req = $this->connector->prepare("SELECT * FROM student WHERE id_student = :id_student");
        $req->bindValue('id_student', $id_student, PDO::PARAM_INT);
        $req->execute();
        return $req;
    }
    public function updateStudent($id_student, $lastname, $firstname, $birthdate, $institution, $entry_date, $validity_date, $phone, $comment, $address, $photo)
    {
        $req = $this->connector->prepare("
            UPDATE student SET 
                lastname = :lastname,
                firstname = :firstname,
                birthdate = :birthdate,
                institution = :institution,
                entry_date = :entry_date,
                validity_date = :validity_date,
                phone = :phone,
                comment = :comment,
                address = :address,
                photo = :photo
            WHERE id_student = :id_student
        ");

        $req->bindValue('id_student', $id_student, PDO::PARAM_INT);
        $req->bindValue('lastname', $lastname, PDO::PARAM_STR);
        $req->bindValue('firstname', $firstname, PDO::PARAM_STR);
        $req->bindValue('birthdate', $birthdate, $birthdate ? PDO::PARAM_STR : PDO::PARAM_NULL);
        $req->bindValue('institution', $institution, PDO::PARAM_STR);
        $req->bindValue('entry_date', $entry_date, PDO::PARAM_STR);
        $req->bindValue('validity_date', $validity_date, PDO::PARAM_STR);
        $req->bindValue('phone', $phone, PDO::PARAM_STR);
        $req->bindValue('comment', $comment, PDO::PARAM_STR);
        $req->bindValue('address', $address, PDO::PARAM_STR);
        $req->bindValue('photo', $photo, PDO::PARAM_STR);

        $req->execute();
        return $req;
    }
    public function removeStudent ($id_student)
    {
        $req = $this->connector->prepare("DELETE FROM student WHERE id_student = :id_student");
        $req->bindValue('id_student', $id_student, PDO::PARAM_INT);
        $req->execute();
        return $req;
    }
    public function getStudentNames ()
    {
        $req = $this->connector->prepare("SELECT id_student, lastname, firstname, validity_date  FROM student");
        $req->execute();
        return $req;
    }


    // Loan
    public function newLoan($start_date, $expected_return, $fk_student, $fk_book)
    {
        $req = $this->connector->prepare("
            INSERT INTO 
            loan (id_loan, start_date, expected_return_date, return_date, comment, fk_student, fk_book)
            VALUES (NULL, :start_date, :expected_return, NULL, NULL, :fk_student, :fk_book)
        ");
        $req->bindValue('start_date', $start_date, PDO::PARAM_STR);
        $req->bindValue('expected_return', $expected_return, PDO::PARAM_STR);
        $req->bindValue('fk_student', $fk_student, PDO::PARAM_INT);
        $req->bindValue('fk_book', $fk_book, PDO::PARAM_INT);
        $req->execute();
        return $req;
    }
    public function closeLoan($id_loan, $return_date, $comment)
    {
        $req = $this->connector->prepare("
            UPDATE loan SET 
                return_date = :return_date,
                comment = :comment
            WHERE id_loan = :id_loan
        ");

        $req->bindValue('id_loan', $id_loan, PDO::PARAM_INT);
        $req->bindValue('return_date', $return_date, PDO::PARAM_STR);
        $req->bindValue('comment', $comment, PDO::PARAM_STR);
        $req->execute();
        return $req;
    }
    public function getIdBook ($id_loan)
    {
        $req = $this->connector->prepare("SELECT fk_book FROM loan WHERE id_loan = :id_loan");
        $req->bindValue('id_loan', $id_loan, PDO::PARAM_INT);
        $req->execute();
        return $req;
    }
    public function getIdLoan ($fk_book)
    {
        $req = $this->connector->prepare("SELECT id_loan FROM loan WHERE fk_book = :fk_book");
        $req->bindValue('fk_book', $fk_book, PDO::PARAM_INT);
        $req->execute();
        return $req;
    }
    public function getBookLoans($fk_book)
    {
        $req = $this->connector->prepare("
            SELECT 
                student.id_student,
                student.firstname,
                student.lastname,
                loan.start_date,
                loan.expected_return_date,
                loan.return_date,
                loan.comment
            FROM 
                loan
            JOIN 
                student ON loan.fk_student = student.id_student
            WHERE 
                loan.fk_book = :fk_book
            ORDER BY 
                loan.start_date DESC

        ");
        $req->bindValue('fk_book', $fk_book, PDO::PARAM_INT);
        $req->execute();
        return $req;
    }
    public function getStudentLoans($fk_student)
    {
        $req = $this->connector->prepare("
            SELECT 
                loan.id_loan,
                book.title,
                loan.start_date,
                loan.expected_return_date,
                loan.return_date,
                loan.comment,
                loan.fk_book
            FROM 
                loan
            JOIN 
                book ON loan.fk_book = book.id_book
            WHERE 
                loan.fk_student = :fk_student
            ORDER BY    
                loan.start_date DESC
    ");
        $req->bindValue('fk_student', $fk_student, PDO::PARAM_INT);
        $req->execute();
        return $req;
    }
    public function getLoans ()
    {
        $req = $this->connector->prepare("SELECT start_date, expected_return_date, return_date, fk_book FROM loan");
        $req->execute();
        return $req;
    }

}