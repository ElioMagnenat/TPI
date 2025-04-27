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
        $this->connector = new PDO('mysql:host=localhost;dbname=db_gestion_vin;charset=utf8', 'root','root');
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
    
    /**
     * Create user
     *
     * @param string $userName
     * @param string $pwd
     * @return void
     */
    public function createUser($username, $password) {
        $req = $this->connector->prepare("INSERT INTO t_user SET username=:username, password=:password");
        $req->bindValue("username", $username, PDO::PARAM_STR);
        $req->bindValue("password", $password, PDO::PARAM_STR);
        $req->execute();
    }

    /**
     * Récupère le mot de passe d'un utilisateur
     *
     * @param string $userName
     * @return void
     */
    public function selectPassword($username) {
        $req = $this->connector->prepare("SELECT password FROM t_user WHERE username=:username");
        $req->bindValue("username", $username, PDO::PARAM_STR);
        $req->execute();
        return $req;
    }
        /**
     * Username exist
     *
     * @param string $username
     * @return nbr of user have the same name
     */
    public function userExist($username) {
        $req = $this->connector->prepare("SELECT COUNT(user_id) FROM t_user WHERE username=:username");
        $req->bindValue("username", $username, PDO::PARAM_STR);
        $req->execute();
        return $req;
    }

    public function idUser($username) {
        $req = $this->connector->prepare("SELECT user_id FROM t_user WHERE username=:username");
        $req->bindValue('username', $username, PDO::PARAM_STR);
        $req->execute();
        return $req;
    }
    public function insertWine ($wineName, $wineType, $wineCepage, $wineMillesime, $wineBuyDate, $winePrice, $wineQuantity, $winePicture){
        $req = $this->connector->prepare("INSERT INTO t_vin (vin_id, nom, date_achat, date_millesime, prix, cepage, image, quantite, fk_type) VALUES (NULL, :wineName,:wineBuyDate, :wineMillesime, :winePrice, :wineCepage, :winePicture, :wineQuantity, :wineType)");
        $req->bindValue('wineName', $wineName, PDO::PARAM_STR);
        $req->bindValue('wineType', $wineType, PDO::PARAM_INT);
        $req->bindValue('wineCepage', $wineCepage, PDO::PARAM_STR);
        $req->bindValue('wineMillesime', $wineMillesime, PDO::PARAM_STR);
        $req->bindValue('wineBuyDate', $wineBuyDate, PDO::PARAM_STR);
        $req->bindValue('winePrice', $winePrice, PDO::PARAM_STR);
        $req->bindValue('wineQuantity', $wineQuantity, PDO::PARAM_INT);
        $req->bindValue('winePicture', $winePicture, PDO::PARAM_STR);
        $req->execute();
        return $req;
    }
    public function getTypes ()
    {
        $req = $this->connector->prepare("SELECT * FROM t_type");
        $req->execute();
        return $req;
    }
    public function getWines(){
        $req = $this->connector->prepare("SELECT * FROM t_vin");
        $req->execute();
        return $req;
    }
    public function removeWine($wine_id){
        $req = $this->connector->prepare("DELETE FROM t_vin WHERE vin_id = :wine_id");
        $req->bindValue('wine_id', $wine_id, PDO::PARAM_STR);
        $req->execute();
        return $req;
    }
    public function updateWine($wine_id, $wineName, $wineType, $wineCepage, $wineMillesime, $wineBuyDate, $winePrice, $wineQuantity, $winePicture) {
        $req = $this->connector->prepare("
            UPDATE t_vin SET 
                nom = :wineName, 
                date_achat = :wineBuyDate, 
                date_millesime = :wineMillesime, 
                prix = :winePrice, 
                cepage = :wineCepage, 
                image = :winePicture, 
                quantite = :wineQuantity, 
                fk_type = :wineType 
            WHERE vin_id = :wine_id
        ");
    
        $req->bindValue('wine_id', $wine_id, PDO::PARAM_INT);
        $req->bindValue('wineName', $wineName, PDO::PARAM_STR);
        $req->bindValue('wineType', $wineType, PDO::PARAM_INT);
        $req->bindValue('wineCepage', $wineCepage, PDO::PARAM_STR);
        $req->bindValue('wineMillesime', $wineMillesime, PDO::PARAM_STR);
        $req->bindValue('wineBuyDate', $wineBuyDate, PDO::PARAM_STR);
        $req->bindValue('winePrice', $winePrice, PDO::PARAM_STR);
        $req->bindValue('wineQuantity', $wineQuantity, PDO::PARAM_INT);
        $req->bindValue('winePicture', $winePicture, PDO::PARAM_STR);
    
        $req->execute();
    
        return $req;
    }
    public function getUsersRoles(){
        $req = $this->connector->prepare("
        SELECT 
            u.user_id,
            u.username,
            r.role_id,
            r.nom AS role_name
        FROM 
            t_user u
        LEFT JOIN 
            t_role_user ru ON u.user_id = ru.fk_user
        LEFT JOIN 
            t_role r ON ru.fk_role = r.role_id
        ORDER BY 
            u.user_id;
    ");

        $req->execute();
    
        return $req;
    }
    public function getRoles(){
        $req = $this->connector->prepare("SELECT * FROM t_role;");

        $req->execute();
    
        return $req;
    }
    public function updateUserRoles($user_id, $roles) {
        $remove = $this->connector->prepare("DELETE FROM t_role_user WHERE fk_user = :user_id");
        $remove->bindValue('user_id', $user_id, PDO::PARAM_INT);
        $remove->execute();
    
        $add = $this->connector->prepare("INSERT INTO t_role_user (fk_user, fk_role) VALUES (:user_id, :role_id)");
        foreach ($roles as $role_id) {
            $add->bindValue('user_id', $user_id, PDO::PARAM_INT);
            $add->bindValue('role_id', $role_id, PDO::PARAM_INT);
            $add->execute();
        }
    }
    public function getUserRoles($user_id){
            $req = $this->connector->prepare("
            SELECT r.nom AS role_nom
            FROM t_role_user ru
            JOIN t_role r ON ru.fk_role = r.role_id
            WHERE ru.fk_user = :user_id;
            ");
            $req->bindValue('user_id', $user_id, PDO::PARAM_INT);
            $req->execute();
        
            return $req;
    }
}