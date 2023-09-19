<?php
$display = "d-none";
$message = "";
$errors = [];

$patterns['password'] = "/^.{12,}$/";
$patterns['password2'] = $patterns['password'];
/* Huom. Myös heittomerkki ja tavuviiva */
$patterns['firstname'] = "/^[a-zåäöA-ZÅÄÖ'\-]+$/";
$patterns['lastname'] = $patterns['firstname']; 
$patterns['name'] = "/^[a-zåäöA-ZÅÄÖ '\-]+$/";
$patterns['mobilenumber'] = "/^[0-9]{7,15}$/";
$patterns['email'] = "/^[\w]+[\w.+\-]*@[\w\-]+(\.[\w\-]{2,})?\.[a-zA-Z]{2,}$/";
$patterns['image'] = "/^[^\s]+\.(jpe?g|png|gif|bmp)$/"; 
$patterns['rememberme'] = "/^checked$/";

function pattern($kentta) {
    return trim($GLOBALS['patterns'][$kentta],"/");
    }
    
function error($kentta) {
    return $GLOBALS['errors'][$kentta] ?? $GLOBALS['virhetekstit'][$kentta]['puuttuu'];
    }

function arvo($kentta) {
    return $_POST[$kentta] ?? "";
    }   
    
function is_invalid($kentta) {        
    return (isset($GLOBALS['errors'][$kentta])) ? "is-invalid" : "";
    }       


if (isset($_POST['firstname'])) {
    $firstname = $_POST['firstname'];
    if (!empty($firstname) and !preg_match($patterns['firstname'], $firstname)) {
        $errors['firstname'] = "Nimi ei kelpaa";
    }
}    

var_export($_POST);
var_export($errors);
/*
if (isset($_POST['firstname'])) {
    $firstname = $_POST['firstname'];
    if (empty($firstname)) {
        $errors['firstname'] = "Nimi puuttuu";
    }
}   
$password_hash = password_hash($_POST['password'], PASSWORD_DEFAULT);        
*/

/*
$display = "d-block";
$message = "Tallennettu!";
*/
?>