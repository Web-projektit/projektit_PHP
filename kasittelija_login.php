<?php
/* ALOITUS */   
if (isset($_POST['painike'])){
   list($virheet,$arvot) = validoi_lomake($kentat);   
   debuggeri($virheet);
   if (!$virheet){
      $email = $arvot[array_search('email',$kentat)];
      $password = $arvot[array_search('password',$kentat)];
      $rememberme = $arvot[array_search('rememberme',$kentat)];
      $query = "SELECT id,password,is_active FROM users WHERE email = '$email'";
      $result = $yhteys->query($query);
      if(!$result) die("Tietokantayhteys ei toimi: ".mysqli_error($connection));
      if (!$result->num_rows) {
         $virheet_palvelin[] =  $virheilmoitukset['accountNotExistErr'];
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
               else $location = "index.php";   
               header("location: $location");
               exit;
               }      
            else {
               $virheet_palvelin[] = $virheilmoitukset['verificationRequiredErr'];
               }
            }
         else {
            $virheet_palvelin[] = $virheilmoitukset['emailPwdErr'];
            }
         }  
      }  
   }   
?>