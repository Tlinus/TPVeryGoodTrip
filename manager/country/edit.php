<?php
include('../../config.php');
include('../../templates/header.php');
include('../../utility.php');
$db = db_connect();

// initialisation d'un tableau vide (pas obligatoire)
$country = array('id' => 0, 'name' => '');

if (isset($_POST['submit'])) {
  if ($db) {
    $query = $db->prepare(
      'UPDATE country SET name = :name WHERE id = :id');
    $result = $query->execute(array(
      ':name' => cleanInput($_POST['name']),
      ':id' => $_POST['id']
    ));
    if ($result) {
      header('location:list.php');
    } else {
      echo '<p>Problème</p>';
    }
  }
} else {
  // page accédée via la méthode GET
  if ($db) {
    $query = $db->prepare('SELECT * FROM country WHERE id = :id');
    $result = $query->execute(array(':id' => $_GET['id']));
    if ($result) {
      $country = $query->fetch(PDO::FETCH_ASSOC);
    }
  }
}
?>

<h2>Mettre à jour un pays</h2>
<form action="edit.php" method="post">
  <input type="text" name="name" placeholder="Nom"
    value="<?php echo $country['name'] ?>">
    <!-- le champ hidden permet de transmettre l'id à la
    superglobale $_POST issue de la soumission du formulaire
    -->
  <input type="hidden" name="id" value="<?php echo $_GET['id'] ?>">
  <input type="submit" name="submit" value="Mettre à jour">
</form>

<?php
include('../../templates/footer.php');
?>
