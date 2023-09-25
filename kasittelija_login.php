<?php
/* ALOITUS */   
if (isset($_POST['painike'])){
   foreach ($_POST as $kentta => $arvo) {
      $$kentta = $yhteys->real_escape_string(strip_tags(trim($arvo)));
      if (in_array($kentta, $pakolliset) and empty($arvo)) {
          $errors[$kentta] = $virheilmoitukset[$kentta]['valueMissing'];
          }
      else {
          if (isset($patterns[$kentta]) and !preg_match($patterns[$kentta], $arvo)) {
              $errors[$kentta] = $virheilmoitukset[$kentta]['patternMismatch'];
              }
          }
      }
   debuggeri($errors);
   if (!$errors){
      $query = "SELECT id,password,is_active FROM users WHERE email = '$email'";
      $result = $yhteys->query($query);
      if (!$result) die("Tietokantayhteys ei toimi: ".mysqli_error($connection));
      if (!$result->num_rows) {
         $errors['email'] =  $virheilmoitukset['accountNotExistErr'];
         }
      else {
         [$id,$password_hash,$is_active] = $result->fetch_row();
         if (password_verify($password, $password_hash)){
            if ($is_active){
               if (!session_id()) session_start();
               $_SESSION["loggedIn"] = true;
               if ($rememberme) rememberme($id);
               if (isset($_SESSION['next_page'])){
                  $location = $_SESSION['next_page'];
                  unset($_SESSION['next_page']);
                  }
               else $location = OLETUSSIVU;   
               header("location: $location");
               exit;
               }      
            else {
               $errors['email'] = $virheilmoitukset['verificationRequiredErr'];
               }
            }
         else {
            $errors['password'] = $virheilmoitukset['emailPwdErr'];
            }
         }  
      }  
   }   
?>