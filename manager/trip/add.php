<?php
include_once('../../config.php');
include('../../templates/header.php');
include('../../dbmanager.php');
$countries = getCountries();

if (isset($_POST['submit'])) {
  $db = db_connect();
  if ($db) {
    $query = $db->prepare(
      'INSERT INTO trip (
        country,
        date_start,
        date_end,
        title,
        description,
        price)
        VALUES(
          :country,
          :date_start,
          :date_end,
          :title,
          :description,
          :price)
      ');
    $result = $query->execute(array(
      ':country' => $_POST['country'],
      ':date_start' => $_POST['date_start'],
      ':date_end' => $_POST['date_end'],
      ':title' => $_POST['title'],
      ':description' => $_POST['description'],
      ':price' => $_POST['price']
    ));
    if ($result) {
      header('location:list.php');
    }
  }
}

?>

<h2>Ajouter un voyage</h2>
<form action="add.php" method="post">
  <div class="form-group">
    <input type="text" name="title" placeholder="Intitulé">
  </div>
  <div class="form-group">
    <select name="country">
      <option value="0">Sélectionner un pays</option>
      <?php if ($countries): ?>
        <?php foreach($countries as $country): ?>
          <option value="<?php echo $country['id']?>">
            <?php echo $country['name'] ?>
          </option>
        <?php endforeach; ?>
      <?php endif; ?>
    </select>
  </div>
  <div class="form-group">
    <label for="date_start">Date de départ</label>
    <input type="date" name="date_start">
  </div>
  <div class="form-group">
    <label for="date_end">Date de retour</label>
    <input type="date" name="date_end">
  </div>
  <div class="form-group">
    <input type="text" name="price" placeholder="Prix">
  </div>
  <div class="form-group">
    <textarea name="description" rows="8" cols="80" placeholder="Descriptif"></textarea>
  </div>
  <input type="submit" name="submit" value="Enregistrer">
</form>

<?php
  include('../../templates/footer.php');
?>
