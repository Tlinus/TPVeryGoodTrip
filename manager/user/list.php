<?php
require_once('../../dbmanager.php');
require_once('../../utility.php');
include('../../templates/header.php');
$users = getUsers($full = false); // équivalent à getTrips(false)
?>

<h2>Liste des Utilisateurs</h2>
<a class="btn btn-primary btn-sm" href="add.php">Ajouter un Utilisateur</a>
<select name="role" id="role">
  <option value="0">TOUS</option>
  <option value="admin" >
    Admin seulement
  </option>
  <option value="user" >
    User seulement
  </option>
</select>
<select name="active" id="active">
  <option value="0">TOUS</option>
  <option value="true" >
    Actifs seulement
  </option>
  <option value="false" >
    Non Actifs seulement
  </option>
</select>
<table class="table table-bordered table-striped">
  <tr>
    <th>Nom</th>
    <th>Prénom</th>
    <th>Email</th>
    <th>Mot de passe</th>
    <th>Role<th>
    <th>Actif<th>
  </tr>
  <?php foreach($users as $user): ?>
    <tr class="<?php echo $user['role']; echo " ".$user['active'];?>">
      <td>
        <?php echo $user['firstname'] ?>
      </td>
      <td>
        <?php echo $user['lastname'] ?>
      </td>
      <td>
        <?php echo $user['email'];  ?>
      </td>
      <td>
        <?php echo $user['password'];  ?>
      </td>
      <td>
        <?php echo $user['role'];  ?>
      </td>
      <td>
        <?php echo $user['active'];  ?>
      </td>
      <td>
        <a
          class="btn btn-primary btn-sm"
          href="edit.php?id=<?php echo $user['id'] ?>">Editer</a>
        <a
          class="btn btn-danger btn-sm"
          href="delete.php?id=<?php echo $user['id'] ?>">Supprimer</a>
      </td>
    </tr>
  <?php endforeach; ?>
</table>

<script>
  $('#role').on('change', function() {
    if(this.value =='admin'){
      $('.user').hide();
      $('.admin').show();
    }
    else if(this.value =='user'){
      $('.admin').hide();
      $('.user').show();
    }
    else{
      $('.user').show();
      $('.admin').show();
    }
  })

  $('#active').on('change', function() {
    alert(this.value);
    if(this.value =='false'){
      $('.true').hide();
      $('.false').show();
    }
    else if(this.value =='true'){
      $('.false').hide();
      $('.true').show();
    }
    else{
      $('.true').show();
      $('.false').show();
    }
  })
</script>
<?php
include('../../templates/footer.php');
?>
