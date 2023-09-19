<?php 
$title = 'Rekisteröityminen';
//$css = 'rekisteroityminen.css';
include "header.php";
include "virheilmoitukset.php";
include "rekisterointi.php";

?>
<div class="container"> 
<form method="post" class="mb-3 needs-validation" novalidate>
<fieldset>
<legend>Rekisteröityminen</legend>

<div class="row">
<label for="firstname" class="col-sm-4 form-label">Etunimi</label>
<div class="col-sm-8">
<input pattern="<?= pattern("firstname"); ?>" type="text" class="mb-1 form-control <?= is_invalid('firstname'); ?>" name="firstname" id="firstname" 
       placeholder="Etunimi" value="<?= arvo("firstname"); ?>" 
       required> 
<div class="invalid-feedback">
<?= error('firstname') ?? ""; ?>    
</div>
</div>    
</div>

<div class="row">
<label for="lastname" class="col-sm-4 form-label">Sukunimi</label>
<div class="col-sm-8">
<input type="text" class="mb-1 form-control" name="lastname" id="lastname" 
       placeholder="Sukunimi" value="<?= arvo("lastname"); ?>" required>
<div class="invalid-feedback">
<?php if (isset($errors['lastname'])) echo $errors['lastname']; 
        else echo $virhetekstit['lastname']['puuttuu'];?>    
</div>
</div>
</div>

<div class="row">
<label for="email" class="col-sm-4 form-label">Sähköpostiosoite</label>
<div class="col-sm-8">
<input type="email" class="mb-1 form-control" name="email" id="email" 
       placeholder="etunimi.sukunimi@palvelu.fi" pattern="<?= pattern('email'); ?>" value="<?= arvo("email"); ?>" required>
<div class="invalid-feedback">
<?php if (isset($errors['email'])) echo $errors['email']; 
        else echo $virhetekstit['email']['oikein'];?>    
</div>
</div>
</div>

<div class="row">
<label for="password" class="col-sm-4 form-label">Salasana</label>
<div class="col-sm-8">
<input type="password" class="mb-1 form-control" name="password" id="password" 
       placeholder="etunimi.sukunimi@palvelu.fi" pattern="" required>
<div class="invalid-feedback">
<?php if (isset($errors['password'])) echo $errors['password']; 
        else echo $virhetekstit['password']['puuttuu'];?>    
</div>
</div>
</div>

<div class="row">
<label for="password2" class="text-nowrap col-sm-4 form-label">Salasana uudestaan</label>
<div class="col-sm-8">
<input type="password" class="mb-1 form-control" name="password2" id="email" 
       placeholder="etunimi.sukunimi@palvelu.fi" pattern="" required>
<div class="invalid-feedback">
<?php if (isset($errors['password2'])) echo $errors['password2']; 
        else echo $virhetekstit['password2']['puuttuu'];?>    
</div>
</div>
</div>
<button type="submit" class="mt-2 float-end btn btn-primary">Rekisteröidy</button>
</fieldset>

</form>

<div  id="ilmoitukset" class="alert alert-success alert-dismissible fade show <?= $display ?? ""; ?>" role="alert">
<p><?= $message; ?></p>
<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>

</div>
<?php include "footer.html"; ?>