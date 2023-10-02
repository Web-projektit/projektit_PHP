<?php 
include "asetukset.php";
include "db.php";
include "rememberme.php";
$loggedIn = secure_page('admin');
$title = 'Käyttäjähallinta';
//$css = 'Kayttajahallinta.css';
include "header.php";
if (isset($_POST['tallenna'])) {
    debuggeri($_POST);
    $values = "";
    $query = "INSERT INTO users (id,is_active,role) VALUES ";

    foreach($_POST['id'] as $id) {
        $is_active = in_array($id,$_POST['is_active']) ? 1 : 0;
        $role = in_array($id,$_POST['name']) ? 2 : 1;
        $values.= "($id,'$is_active',$role),";
        }
    $values = rtrim($values,',');
    $query.= $values;
    $query.= " ON DUPLICATE KEY UPDATE is_active = VALUES(is_active), role = VALUES(role)";
    debuggeri($query);
    $result = $yhteys->query($query);
}

$query = "SELECT users.id AS id,firstname,lastname,is_active,role,name FROM users LEFT JOIN roles ON role = roles.id ORDER BY lastname,firstname"; 
$result = $yhteys->query($query);
if ($result->num_rows) {
    $users = $result->fetch_all(MYSQLI_ASSOC);
    }
else {
    $users = [];
    }
debuggeri($users);
?>
<div class="container">
<!-- Kuva ja perustiedot -->
<form action="kayttajat.php" method="post">
<table>
    <tr>
        <th>Sukunimi</th>
        <th>Etunimi</th>
        <th>Aktiivinen</th>
        <th>Pääkäyttäjä</th>
    </tr>
    <?php foreach ($users as $key => $user) { ?> 
    <tr>
    <td class="d-none"><input type="hidden" name="id[]" value="<?= $user['id'] ?>"></td>    
    <td><?= $user['lastname'] ?></td>
    <td><?= $user['firstname'] ?></td>
    <td><input name="is_active[]" value=<?= $user['id']; ?> type="checkbox" <?php if($user['is_active']) echo "checked" ?>></td>
    <td><input name="name[]" value=<?= $user['id']; ?> type="checkbox" <?php if($user['name'] == 'mainuser') echo "checked" ?>></td> 
    <td></td>
    </tr>    
    <?php } ?> 
    </table>
<input class="btn btn-primary" type="submit" name="tallenna" value="Tallenna">    
</form>
</div>
<?php include "footer.html"; ?>
