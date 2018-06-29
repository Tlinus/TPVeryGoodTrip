<?php
require_once('dbmanager.php');
require_once('utility.php');
include(TEMPLATES_PATH . '\header.php');

$countries = getCountries();

if (isset($_GET['submit'])) {
  // le client a cliqué sur le bouton Rechecher
  //$trips = searchTrip(null);
  $criteria = array(
    'country'       => null,
    'date_start'    => null,
    'date_end'      => null,
    'price'         => null
  );

  // si conditions de validation respectées on écrase null
  // par la valeur validée (autorisée)
  if ($_GET['country'] > 0) {
    $criteria['country'] = $_GET['country'];
  }

  if ($_GET['date_start'] != "") {
    $criteria['date_start'] = $_GET['date_start'];
  }

  if ($_GET['date_end'] != "") {
    $criteria['date_end'] = $_GET['date_end'];
  }

  if ($_GET['price'] != "") {
    $criteria['price'] = $_GET['price'];
  }

  $trips = searchTrip($criteria);
  //var_dump($trips);
}
?>

<h1>Very Good Trip</h1>
<form method="get">
  <select name="country">
    <option value="0">Choisir une destination</option>
    <?php
      foreach($countries as $country) {
        echo '<option value="'.$country['id'].'">'
        .$country['name'].'</option>';
      }
    ?>
  </select>
  <span>Entre le</span><input type="date" name="date_start" value="">
  <span>et le </span><input type="date" name="date_end">
  <input type="text" name="price" placeholder="Prix maximal">
  <input type="submit" name="submit" value="Rechercher"
    class="btn btn-primary btn-sm">
</form>

<?php if(isset($_GET['submit'])): ?>

  <div>
    <p>Filtres utilisés:</p>
    <?php
      if (sizeof($trips) > 0) {
        echo 'Pays: ' . $trips[0]['country_name'] . ', ';
      }
    ?>
    Date de début: <?php echo $_GET['date_start'] ?>,
    Date de fin: <?php echo $_GET['date_end'] ?>,
    Prix max: <?php echo $_GET['price'] ?>
  </div>

  <table class="table table-bordered table-striped">
    <tr>
      <th>Intitulé</th>
      <th>Destination</th>
      <th>Dates</th>
      <th>Prix</th>
    </tr>
    <?php foreach($trips as $trip): ?>
      <tr>
        <td>
          <?php echo "<a href='trip_detail.php?trip=".urlencode($trip['title'])."'>".$trip['title']."</a>" ?>
        </td>
        <td>
          <?php echo $trip['country_name'] ?>
        </td>
        <td>
          <?php
            echo 'Du ' . transformSQLDate($trip['date_start']);
            echo ' au ' . transformSQLDate($trip['date_end']);
          ?>
        </td>
        <td>
          <?php echo $trip['price'] ?> euros
        </td>
      </tr>
    <?php endforeach; ?>
  </table>

<?php endif; ?>

<?php include('templates/footer.php') ?>
