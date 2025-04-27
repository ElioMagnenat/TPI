<?php
include_once('model/WineRepository.php');
// Classe pour le contrôleur de le vin
class WineController extends Controller {
    // Fonction pour récupérer l'action et appeler la bonne fonction
    public function dispatch() {
        // Récupération de l'action
        $action = $_GET['action'];

        // Effectue un appel dynamique à la fonction en fonction de l'action
        return call_user_func((array($this, $action)));
    }

    public function listeWine() {
        if((isset($_SESSION["user"]["user_id"]) && !empty($_SESSION["user"]["user_id"])))
        {
            if(!isset($_SESSION["vins"]["types"]) || empty($_SESSION["vins"]["types"])){
                $WineRepository = new WineRepository();
                $WineRepository->getTypes();
            }
            $WineRepository = new WineRepository();
            $WineRepository->getWines();
            $view = file_get_contents(('view/page/wine/listeWine.php'));
            //Permet l'affichage des bonnes données
            ob_start();
            eval('?>' . $view);
            $content = ob_get_clean();
    
            return $content;
        }else{
            header("Location: ?controller=account&action=accessDenied");
        }
    }
    public function addWineForm() {
        if(isset($_SESSION["user"]["roles"]["canAdd"])&& $_SESSION["user"]["roles"]["canAdd"]){
            if(!isset($_SESSION["vins"]["types"]) || empty($_SESSION["vins"]["types"])){
                $WineRepository = new WineRepository();
                $WineRepository->getTypes();
            }
            $view = file_get_contents(('view/page/wine/addWineForm.php'));
            //Permet l'affichage des bonnes données
            ob_start();
            eval('?>' . $view);
            $content = ob_get_clean();

            return $content;
        }else{
            header("Location: ?controller=account&action=accessDenied");
        }
    }
    public function editWineForm() {
        if(isset($_SESSION["user"]["roles"]["canEdit"])&& $_SESSION["user"]["roles"]["canEdit"]){
            $wine_id = $_GET['wineId'];
            if (isset($_SESSION["vins"]["liste"])) {
                foreach ($_SESSION["vins"]["liste"] as $vin) {
                    if ($vin['vin_id'] == $wine_id) {
                        $vinDetail = $vin;
                        $_SESSION["vins"]["details"]=$vinDetail;
                        break;
                    }
                }
            }
            $_SESSION["vins"]["id"]=$wine_id;
            $view = file_get_contents(('view/page/wine/editWineForm.php'));
            //Permet l'affichage des bonnes données
            ob_start();
            eval('?>' . $view);
            $content = ob_get_clean();

            return $content;
        }
    }
    public function verifCreateWine(){

        $WineRepository = new WineRepository();
        $imgPath = "./resources/imgWine/defaultWine.png";
        if (isset($_FILES['picture']) && !empty($_FILES['picture'])){
            $file_name = $_FILES['picture']['name'];
            $fileType = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
            $date = date("Ymd_His");
            $image_name = str_replace(".", "", uniqid($date . "_", true)) . '.' . $fileType;
            $path_dir = "./ressources/imgWine/";
            $imgPath = $path_dir . basename($image_name);
            move_uploaded_file($_FILES['picture']['tmp_name'], $imgPath);
        }
        $WineRepository->addWine(htmlspecialchars($_POST["wineName"]), htmlspecialchars($_POST["wineType"]), htmlspecialchars($_POST["wineCepage"]), htmlspecialchars($_POST["wineMillesime"] . "-01-01"), htmlspecialchars($_POST["wineBuyDate"]), htmlspecialchars($_POST["winePrice"]), htmlspecialchars($_POST["wineQuantity"]),$imgPath);
    }
    public function verifEditWine(){
        $wine_id = $_GET['wineId'];
        $WineRepository = new WineRepository();
        $imgPath = $_SESSION["vins"]["details"]["image"];
        if (is_uploaded_file($_FILES['picture']['tmp_name'])){
            if (file_exists($imgPath)) {
                unlink($imgPath);
            }
            $file_name = $_FILES['picture']['name'];
            $fileType = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
            $date = date("Ymd_His");
            $image_name = str_replace(".", "", uniqid($date . "_", true)) . '.' . $fileType;
            $path_dir = "./ressources/imgWine/";
            $imgPath = $path_dir . basename($image_name);
            move_uploaded_file($_FILES['picture']['tmp_name'], $imgPath);
        }
        $WineRepository->editWine($wine_id,htmlspecialchars($_POST["wineName"]), htmlspecialchars($_POST["wineType"]), htmlspecialchars($_POST["wineCepage"]), htmlspecialchars($_POST["wineMillesime"] . "-01-01"), htmlspecialchars($_POST["wineBuyDate"]), htmlspecialchars($_POST["winePrice"]), htmlspecialchars($_POST["wineQuantity"]),$imgPath);
    }
    public function removeWine(){
        if(isset($_SESSION["user"]["roles"]["canRemove"])&& $_SESSION["user"]["roles"]["canRemove"]){
            $imagePath = $_GET['image'];
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
            $wine_id = $_GET['wineId'];
            $WineRepository = new WineRepository();
            $WineRepository->removeWine($wine_id);
        }
        else{
            header("Location: ?controller=account&action=accessDenied");
        }
    }
    public function detailsWine(){
        $wine_id = $_GET['wineId'];
        if (isset($_SESSION["vins"]["liste"])) {
            foreach ($_SESSION["vins"]["liste"] as $vin) {
                if ($vin['vin_id'] == $wine_id) {
                    $vinDetail = $vin;
                    $_SESSION["vins"]["details"]=$vinDetail;
                    break;
                }
            }
        }
        $view = file_get_contents(('view/page/wine/detailsWine.php'));
        //Permet l'affichage des bonnes données
        ob_start();
        eval('?>' . $view);
        $content = ob_get_clean();

        return $content;
    }
}
?>
