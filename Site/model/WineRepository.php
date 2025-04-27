<?php
include_once 'model/Database.php';

class WineRepository{
    public function getPersonne() {
        $req = $this->connector->query("SELECT * FROM t_personne");
        return $req;
    }
    public function addWine($wineName, $wineType, $wineCepage, $wineMillesime, $wineBuyDate, $winePrice, $wineQuantity, $winePicture) {
        $database = new Database();
        $database->insertWine($wineName, $wineType, $wineCepage, $wineMillesime, $wineBuyDate, $winePrice, $wineQuantity, $winePicture);
        $database->disconnect();
        header("Location: ?controller=wine&action=listeWine");
    }
    public function editWine($wine_id, $wineName, $wineType, $wineCepage, $wineMillesime, $wineBuyDate, $winePrice, $wineQuantity, $winePicture) {
        $database = new Database();
        $database->updateWine($wine_id, $wineName, $wineType, $wineCepage, $wineMillesime, $wineBuyDate, $winePrice, $wineQuantity, $winePicture);
        $database->disconnect();
        header("Location: ?controller=wine&action=listeWine");
    }
    public function getTypes ()
    {
        $db = new Database();
        $req = $db->getTypes();
        $db->disconnect();
        $types = $db->formatData($req);
        $db->clearCash($req);
        $_SESSION["vins"]["types"] = $types;
    }
    public function getWines ()
    {
        //Obtenir les vins
        $db = new Database();
        $req = $db->getWines();
        $db->disconnect();
        $liste = $db->formatData($req);
        $db->clearCash($req);
        //Obtenir les types
        $db = new Database();
        $req = $db->getTypes();
        $db->disconnect();
        $types = $db->formatData($req);
        $db->clearCash($req);
        foreach ($liste as &$vin) {
            foreach ($types as $type){
                if($type["type_id"]==$vin["fk_type"])
                {
                    $vin["fk_type"] = $type["nom"];
                }
            }
        } 
        $_SESSION["vins"]["liste"] = $liste;
    }
    public function removeWine ($wine_id)
    {
        $database = new Database();
        $database->removeWine($wine_id);
        $database->disconnect();
        header("Location: ?controller=wine&action=listeWine");
    }
}
?>
