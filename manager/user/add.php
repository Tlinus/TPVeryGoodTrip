<?php
include_once('../../config.php');
include('../../templates/header.php');
include('../../dbmanager.php');


if (isset($_POST['submit'])) {
  echo $_POST['firstname'];
  $db = db_connect();
  if ($db) {
    $query = $db->prepare(
      'INSERT INTO user (
        firstname,
        lastname,
        email,
        password,
        active,
        role)
        VALUES(
          :firstname,
          :lastname,
          :email,
          :password,
          :active,
          :role)
      ');
    $result = $query->execute(array(
      ':firstname' => $_POST['firstname'],
      ':lastname' => $_POST['lastname'],
      ':email' => $_POST['email'],
      ':password' => $_POST['password'],
      ':active' => 'false',
      ':role' => $_POST['role']
    ));
    if ($result) {
      header('location:list.php');
    }
  }
}

?>

<h2>Ajouter un Utilisateur</h2>
<form action="add.php" method="post">
  <div class="form-group">
    <select name="role">
      <option value="0">Sélectionner un role</option>
          <option value="admin">
            Admin
          </option>
          <option value="user">
            User
          </option>
    </select>
  </div>
  <div class="form-group">
    <label for="firstname">Prénom</label>
    <input type="text" name="firstname">
  </div>
  <div class="form-group">
    <label for="lastname">Nom</label>
    <input type="text" name="lastname">
  </div>
  <div class="form-group">
    <label for="email">Email</label>
    <input type="email" name="email" placeholder="email">
  </div>
  <div class="form-group">
      <label for="password">Mot de passe</label>
    <input type="password" name="password" value="">
  </div>
  <label for="active">Actif</label>
  <input type="checkbox" name="active"/>
  <br />
  <input type="submit" name="submit" value="Enregistrer">
</form>

<?php
  include('../../templates/footer.php');
?>
