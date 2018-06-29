<?php
include('../../dbmanager.php');
include('../../templates/header.php');

if (isset($_POST['submit'])) {
  // formulaire posté => écriture en BDD
  $result = updateUser($_POST['id'], $_POST);
  if ($result) {
    header('location:list.php');
  } else {
    echo '<p>Problème</p>';
  }

} else {
  // récupération des champs actuels du voyage identifié
  // afin de préremplir le formulaire

  $user = getUserById($_GET['id']);
}

?>

<h2>Mettre à jour un Utilisateur</h2>
<div class="container">
  <div class="row">
    <div class="col-md-6">
      <form action="edit.php" method="post">
        <input type="hidden" name="id"
          value="<?php echo $_GET['id'] ?>">
        <div class="form-group">
          <label for="firstname">Prénom</label>
          <input type="text" name="firstname" placeholder="prénom"
            value="<?php echo $user['firstname'] ?>">
        </div>
        <div class="form-group">
          <label for="lastname">Nom</label>
          <input type="text" name="lastname"
            value="<?php echo $user['lastname'] ?>">
        </div>
        <div class="form-group">
          <label for="email">Email</label>
          <input type="email" name="email"
            value="<?php echo $user['email'] ?>">
        </div>
        <div class="form-group">
          <label for="password">Mot de passe</label>
          <input type="password" name="password" placeholder="Prix"
            value="<?php echo $user['password'] ?>">
        </div>
        <div class="form-group">
          <label for="active">Actif</label>
          <input type="checkbox" <?php if($user['active'] == true) echo "checked"; ?> name="active"/>
        </div>
        <div class="form-group">
            <select name="role">
              <option value="0">Sélectionner un role</option>
              <option value="admin" <?php if($user['role'] == "admin") echo "selected"; ?> >
                Admin
              </option>
              <option value="user" <?php if($user['role'] == "user") echo "selected"; ?>>
                User
              </option>
            </select>
        </div>
        <input type="submit" name="submit" value="Enregistrer">
      </form>
    </div>
  </div>
</div>



<?php
include('../../templates/footer.php');
?>
