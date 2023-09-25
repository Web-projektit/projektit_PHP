<?php
$PALVELIN = $_SERVER['HTTP_HOST'];
$PALVELU = "projektit_PHP/php_sovellusmalli";
$LINKKI_RESETPASSWORD = "resetpassword.php";
$LINKKI_VERIFICATION = "verification.php";
$PALVELUOSOITE = "asiakaspalvelu@neilikka.fi";
define("OLETUSSIVU","profiili.php");
$DB = "neilikka";
$LOCAL = in_array($_SERVER['REMOTE_ADDR'],array('127.0.0.1','REMOTE_ADDR' => '::1'));
if ($LOCAL) {	
    $tunnukset = "../../../tunnukset.php";
    if (file_exists($tunnukset)){
        include_once("../../../tunnukset.php");
        } 
    else {
        die("Tiedostoa ei löydy, ota yhteys ylläpitoon.");
        } 
    $db_server = $db_server_local;
    $db_username = $db_username_local; 
    $db_password = $db_password_local;
    $EMAIL_ADMIN = $admin_mail;
    }
elseif (strpos($_SERVER['HTTP_HOST'],"azurewebsites") !== false){
    $db_server = $_ENV['MYSQL_HOSTNAME'];
    $db_username = $_ENV['MYSQL_USERNAME'];
    $db_password = $_ENV['MYSQL_PASSWORD'];
    /* Mailtrap */
    $EMAIL_ADMIN = $_ENV['EMAIL_ADMIN']; 
    $username_mailtrap = $_ENV['EMAIL_USERNAME'];
    $password_mailtrap = $_ENV['EMAIL_PASSWORD'];
    }

define("SAHKOPOSTIPALVELU","mailtrap");
if (SAHKOPOSTIPALVELU == 'sendgrid'){
    /* SendGrid */      
    define("EMAIL_HOST","smtp.sendgrid.net");
    define("EMAIL_PORT", 587);
    define("EMAIL_USERNAME",$username_sendgrid);
    define("EMAIL_PASSWORD",$password_sendgrid);
    }
    
elseif (SAHKOPOSTIPALVELU == 'mailtrap'){
    /* Mailtrap */
    define("EMAIL_HOST",'smtp.mailtrap.io');
    define("EMAIL_PORT",2525);
    define("EMAIL_USERNAME",$username_mailtrap);
    define("EMAIL_PASSWORD",$password_mailtrap);
    //debuggeri("username:".USERNAME.",password:".PASSWORD);
    }

?>