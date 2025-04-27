<?php
include_once 'model/Database.php';

class AccountRepository {
    /**
     * Verifie les données rentrées par l'utilisateur pour créer un utilisateur
     *
     * @param string $username
     * @param string $password
     * @return void
     */
    public function verifCreateUser($username, $password) {
        $db = new Database();
        $req = $db->userExist($username);
        $db->disconnect();
        $nbUser = $db->formatData($req);
        $db->clearCash($req);

        if ($nbUser[0]['COUNT(user_id)'] == 0) {
            $db->connect();
            $db->createUser($username, password_hash($password, PASSWORD_BCRYPT));
            $db->disconnect();
            $_SESSION['username'] = $username;
            $_SESSION["createUser"]["errorUserName"] = "";
            header("Location: ?controller=account&action=connectForm");
        } else {
            $_SESSION["createUser"]["errorUserName"] = "Cette utilisateur existe déjà";
            header("Location: ?controller=account&action=createForm");
        }
    }
        /**
     * Verifie les données rentrées par l'utilisateur pour se connecter
     *
     * @param string $username
     * @param string $password
     * @return void
     */
    public function verifUserConnection($username, $password) {
        $db = new Database();
        $req = $db->userExist($username);
        $db->disconnect();
        $nbUser = $db->formatData($req);
        $db->clearCash($req);
        $isEduvaud = isset($_SESSION["user"]["eduvaud"]) && $_SESSION["user"]["eduvaud"] === true;
        if ($nbUser[0]['COUNT(user_id)'] == 1) {
        $isPasswordValid = false;
            if (!$isEduvaud) {
                $db->connect();
                $req = $db->selectPassword($username);
                $db->disconnect();
                $passwordHash = $db->formatData($req);
                $db->clearCash($req);

                if (!empty($passwordHash) && password_verify($password, $passwordHash[0]["password"])) {
                    $isPasswordValid = true;
                }
            }
            if ($isPasswordValid || $isEduvaud) {
                $_SESSION['username'] = $username;
                $db->connect();
                $req = $db->idUser($username);
                $db->disconnect();
                $idUser = $db->formatData($req);
                $db->clearCash($req);

                $db->connect();
                $req = $db->getUserRoles($idUser[0]['user_id']);
                $db->disconnect();
                $roles = $db->formatData($req);
                $_SESSION["user"]=[];
                $_SESSION["user"]["user_id"] = $idUser[0]['user_id'];
                $_SESSION["user"]["username"] = $username;
                $_SESSION["user"]["roles"]["isAdmin"]=false;
                $_SESSION["user"]["roles"]["canAdd"]=false;
                $_SESSION["user"]["roles"]["canEdit"]=false;
                $_SESSION["user"]["roles"]["canRemove"]=false;
                if($isEduvaud){
                    $_SESSION["user"]["eduvaud"]=true;
                }
                if($roles){
                    foreach ($roles as $role) {
                        if ($role['role_nom'] === 'Administrateur') {
                            $_SESSION["user"]["roles"]["isAdmin"]= true;
                            $_SESSION["user"]["roles"]["canAdd"]= true;
                            $_SESSION["user"]["roles"]["canEdit"]= true;
                            $_SESSION["user"]["roles"]["canRemove"]= true;
                        }
                        if ($role['role_nom'] === 'Ajouter') {
                            $_SESSION["user"]["roles"]["canAdd"]= true;
                        }
                        if ($role['role_nom'] === 'Modifier') {
                            $_SESSION["user"]["roles"]["canEdit"]= true;
                        }
                        if ($role['role_nom'] === 'Supprimer') {
                            $_SESSION["user"]["roles"]["canRemove"]= true;
                        }
                }
            }
                $_SESSION["connectUser"]["errorConnection"] = "";
                header("Location: ?controller=wine&action=listeWine");
            } else {
                $_SESSION["connectUser"]["errorConnection"] = "Le mot de passe ou le nom d'utilisateur est incorrect";
               header("Location: ?controller=account&action=connectForm");
            }
        } else {
            if($isEduvaud){
                $db->connect();
                $db->createUser($_SESSION["user"]["user_id"], password_hash($password, PASSWORD_BCRYPT));
                $db->clearCash($req);
                $db->disconnect();
            }
            else{
                $_SESSION["connectUser"]["errorConnection"] = "Le mot de passe ou le nom d'utilisateur est incorrect";
                header("Location: ?controller=account&action=connectForm");
            }
        }
    }
    public function getUsersRoles() {
        $db = new Database();
        $req = $db->getUsersRoles();
        $db->disconnect();
        $roles = $db->formatData($req);
        $db->clearCash($req);
    
        $OrderedUsersRoles = [];
    
        foreach ($roles as $role) {
            $userId = $role["user_id"];
            $found = false;
    
            foreach ($OrderedUsersRoles as &$user) {
                if ($user["user_id"] == $userId) {
                    if (!is_null($role["role_id"])) {
                        $user["roles"][] = ["id" => $role["role_id"]];
                    }
                    $found = true;
                    break;
                }
            }
    
            if (!$found) {
                $OrderedUsersRoles[] = [
                    "user_id" => $userId,
                    "username" => $role["username"],
                    "roles" => is_null($role["role_id"]) ? [] : [["id" => $role["role_id"]]]
                ];
            }
        }
    
        $_SESSION["UsersRoles"] = $OrderedUsersRoles;
    
        $db = new Database();
        $req = $db->getRoles();
        $db->disconnect();
        $roles = $db->formatData($req);
        $db->clearCash($req);
        $_SESSION["Roles"] = $roles;
    }
    
    public function addUserRoles($user_id, $roles_id) {
        $db = new Database();
        $db->updateUserRoles($user_id, $roles_id);
        $db->disconnect();
    }
}