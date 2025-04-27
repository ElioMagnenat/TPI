<?php
session_start();
require_once 'lib-sso.php';

$cid = $_SESSION[SESSION_SSO_KEY];
$ssoResult = RetrieveSSOLoginInfos(API_KEY, $cid);

if ($ssoResult->IsSuccess()) {
    //TODO Auth user in your app (select * from users where email=$ssolResult->email ...) and redirect to your favourite homepage
    //If you passed custom parameters, you can get them here $_GET["homepage"]...
    $email = $ssoResult->email;
    header("Location: /Gestion_Vin/index.php?controller=account&action=connectedEduvaud&user_id=".$email);
}
