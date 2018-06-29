<?php
include('../../dbmanager.php');
include('../../templates/header.php');

if (isset($_POST['submit'])) {
  // formulaire posté => écriture en BDD
  $result = updateTrip($_POST['id'], $_POST);
  if ($result) {
    header('location:list.php');
  } else {
    echo '<p>Problème</p>';
  }

} else {
  // récupération des champs actuels du voyage identifié
  // afin de préremplir le formulaire
  $countries = getCountries();
  $trip = getTripById($_GET['id']);
  $pictures = getPicturesByTrip($_GET['id']);
}

?>

<h2>Mettre à jour un voyage</h2>
<div class="container">
  <div class="row">
    <div class="col-md-6">
      <form action="edit.php" method="post">
        <input type="hidden" name="id"
          value="<?php echo $_GET['id'] ?>">
        <div class="form-group">
          <input type="text" name="title" placeholder="Intitulé"
            value="<?php echo $trip['title'] ?>">
        </div>
        <div class="form-group">
          <select name="country">
            <option value="0">Sélectionner un pays</option>
            <?php if ($countries): ?>
              <?php foreach($countries as $country): ?>
                <?php if ($country['id'] == $trip['country']): ?>
                  <option selected value="<?php echo $country['id']?>">
                    <?php echo $country['name'] ?>
                  </option>
                <?php else: ?>
                  <option value="<?php echo $country['id']?>">
                    <?php echo $country['name'] ?>
                  </option>
                <?php endif; ?>
              <?php endforeach; ?>
            <?php endif; ?>
          </select>
        </div>
        <div class="form-group">
          <label for="date_start">Date de départ</label>
          <input type="date" name="date_start"
            value="<?php echo $trip['date_start'] ?>">
        </div>
        <div class="form-group">
          <label for="date_end">Date de retour</label>
          <input type="date" name="date_end"
            value="<?php echo $trip['date_end'] ?>">
        </div>
        <div class="form-group">
          <input type="text" name="price" placeholder="Prix"
            value="<?php echo $trip['price'] ?>">
        </div>
        <div class="form-group">
          <textarea style="width:100%; height:200px" name="description" placeholder="Descriptif">
            <?php echo $trip['description'] ?>
          </textarea>
        </div>
        <input type="submit" name="submit" value="Enregistrer">
      </form>
    </div>
    <div class="col-md-6">
      <!-- formulaire d'ajout photo -->
      <h2>Ajouter une photo</h2>
      <form enctype="multipart/form-data" action="upload_picture.php" method="post">
        <input type="hidden" name="trip_id"
          value="<?php echo $_GET['id'] ?>">
        <input type="file" name="picture" value="">
        <input type="submit" name="submit_picture" value="Envoyer">
      </form>

      <h2>Photos associées</h2>
      <?php
        if ($pictures != null && sizeof($pictures) > 0) {
          foreach($pictures as $picture) {
            $picture_path =
              BASE_URL . '/static/img/upload/' . $picture['path'];
            echo '<img class="thumb" src="'.$picture_path.'">';
          }
        } else {
          echo '<p>Aucune photo associée</p>';
        }
      ?>
    </div>
  </div>
</div>



<?php
include('../../templates/footer.php');
?>
