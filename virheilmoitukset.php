<?php
$kentat = ['firstname','lastname','email','mobilenumber','password','password2'];
$kentat_suomi = ['etunimi','sukunimi','sähköpostiosoite','matkapuhelinnumero','salasana','salasana'];
$pakolliset = ['firstname','lastname','email','password','password2'];
$kaannokset = array_combine($kentat,$kentat_suomi);
//$kaannokset = ['firstname' => 'etunimi', 'lastname' => 'sukunimi', 'email' => 'sähköpostiosoite', 'mobilenumber' => 'matkapuhelinnumero', 'password' => 'salasana', 'password2' => 'salasana uudestaan'];
//$kaannokset = $kentat_suomi[array_search('lastname',$kentat)]

$patterns['password'] = "/^.{12,}$/";
$patterns['password2'] = $patterns['password'];
/* Huom. Myös heittomerkki ja tavuviiva */
$patterns['firstname'] = "/^[a-zåäöA-ZÅÄÖ'\-]+$/";
$patterns['lastname'] = $patterns['firstname']; 
$patterns['name'] = "/^[a-zåäöA-ZÅÄÖ '\-]+$/";
$patterns['mobilenumber'] = "/^[0-9]{7,15}$/";
$patterns['email'] = "/^[\w]+[\w.+-]*@[\w-]+(\.[\w-]{2,})?\.[a-zA-Z]{2,}$/";
$patterns['image'] = "/^[^\s]+\.(jpe?g|png|gif|bmp)$/"; 
$patterns['rememberme'] = "/^checked$/";


function kaannos($kentta){
    return $GLOBALS['kaannokset'][$kentta];
    }
    
function validationMessages($kentat){   
    foreach ($kentat as $input) {
        $kentta = kaannos($input);   
        $validationMessage[$input]['customError'] = "Virheellinen $kentta";
        $validationMessage[$input]['patternMismatch'] = "Virheellinen $kentta";
        $validationMessage[$input]['rangeOverflow'] = "Liian suuri $kentta";
        $validationMessage[$input]['rangeUnderflow'] = "Liian pieni $kentta";
        $validationMessage[$input]['stepMismatch'] = "Väärän kokoinen muutos";
        $validationMessage[$input]['tooShort'] = "Liian lyhyt $kentta";
        $validationMessage[$input]['tooLong'] = "Liian pitkä $kentta";
        $validationMessage[$input]['typeMismatch'] = "Väärän tyyppinen $kentta";
        $validationMessage[$input]['valueMissing'] = ucfirst($kentta)." puuttuu";
        $validationMessage[$input]['valid'] = "Oikea arvo";
        }   
    return $validationMessage;
    }
    
$virheilmoitukset = validationMessages($kentat);
$virheilmoitukset['password']['patternMismatch'] = "Salasanan pitää olla vähintään 12 merkkiä pitkä";    
$virheilmoitukset['password2']['valueMissing'] = "Anna salasana uudestaan"; 
$virheilmoitukset['password2']['customError'] = "Salasanat eivät täsmää";     
$virheilmoitukset['email']['emailExistsError'] = "Sähköpostiosoite on jo käytössä";     
$virheilmoitukset['firstname']['nameExistsError'] = "Nimi on jo käytössä";  
$virheilmoitukset['lastname']['nameExistsError'] = "Nimi on jo käytössä";  
?>