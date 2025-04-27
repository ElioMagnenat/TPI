<?php
include 'model/AccountRepository.php';
require_once 'sso/lib-sso.php';
// Classe pour le contrôleur de la page d'accueil
class AccountController extends Controller {
    // Fonction pour récupérer l'action et appeler la bonne fonction
    public function dispatch() {
        // Récupération de l'action
        $action = $_GET['action'];

        // Effectue un appel dynamique à la fonction en fonction de l'action
        return call_user_func((array($this, $action)));
    }

    public function connectForm() {
        $view = file_get_contents(('view/page/account/connectForm.php'));

        //Permet l'affichage des bonnes données
        ob_start();
        eval('?>' . $view);
        $content = ob_get_clean();
        
        return $content;
    }
    public function createForm() {
        
        $view = file_get_contents(('view/page/account/createForm.php'));
        //Permet l'affichage des bonnes données
        ob_start();
        eval('?>' . $view);
        $content = ob_get_clean();

        return $content;
    }
    public function rolesForm() {
        if(isset($_SESSION["user"]["roles"]["isAdmin"])&& $_SESSION["user"]["roles"]["isAdmin"]){
        $AccountRepository = new AccountRepository();
        $AccountRepository->getUsersRoles();
        $view = file_get_contents(('view/page/account/rolesForm.php'));
        //Permet l'affichage des bonnes données
        ob_start();
        eval('?>' . $view);
        $content = ob_get_clean();

        return $content;
        }
        else{
            header("Location: ?controller=account&action=accessDenied");
        }
    }
    public function verifCreateUser() {
        $AccountRepository = new AccountRepository();
        $AccountRepository->verifCreateUser(htmlspecialchars($_POST["username"]), htmlspecialchars($_POST["password"]));
    }
    public function verifUserConnection() {
        $AccountRepository = new AccountRepository();
        $AccountRepository->verifUserConnection(htmlspecialchars($_POST["username"]), htmlspecialchars($_POST["password"]));
    }
    public function disconnection() {
        if(isset($_SESSION["user"]["eduvaud"]) && $_SESSION["user"]["eduvaud"] == true)
        {
            $_SESSION["user"]="";
            $URL_AFTER_LOGOUT = 'http://'.$_SERVER['SERVER_NAME'].':'.$_SERVER['SERVER_PORT'].'/Gestion_Vin/?controller=account&action=connectForm';
            header('Location: '.SSO_PORTAL."bridge/logout?redirectUri=" . urlencode($URL_AFTER_LOGOUT));
        }
        else
        {
            $_SESSION["user"]="";
            header("Location: ?controller=account&action=connectForm");
        }
    }
    public function updateRoles() {
        $data = $_POST;
        $first = true;
        foreach($data as $key => $value)
        {
            $separateKey= explode(",",$key);
            if($first)
            {
                $id=$separateKey[1];
                $first=false;
            }
            $roles[]=$separateKey[0];
        }
        $AccountRepository = new AccountRepository();
        $AccountRepository->addUserRoles($id,$roles);

        header("Location: ?controller=account&action=rolesForm");
    }
    public function accessDenied (){
        $view = file_get_contents(('view/page/denied.php'));

        //Permet l'affichage des bonnes données
        ob_start();
        eval('?>' . $view);
        $content = ob_get_clean();
        
        return $content;
    }
    public function eduvaudConnection(){
        $cid = GenerateCorrelationId(API_KEY);

        InitiateSSOLogin($cid);
    }
    public function connectedEduvaud(){
        $user_id=$_GET['user_id'];
        $_SESSION["user"]=[];
        $_SESSION["user"]["eduvaud"] = true;
        $AccountRepository = new AccountRepository();
        $AccountRepository->verifUserConnection($user_id,"");
        header("Location: ?controller=wine&action=listeWine");    
    }
}
?>
