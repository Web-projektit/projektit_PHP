<?php 
include "asetukset.php";
include "db.php";
include "rememberme.php";
$loggedIn = secure_page('admin');
$title = 'Profiili';
$css = 'profiili.css';
include "header.php"; 
?>
<div class="container">
<!-- Kuva ja perustiedot -->
</div>
<?php include "footer.html"; ?>
