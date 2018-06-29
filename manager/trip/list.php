<?php
require_once('../../dbmanager.php');
require_once('../../utility.php');
include('../../templates/header.php');
$trips = getTrips($full = false); // équivalent à getTrips(false)
?>

<h2>Liste des voyages</h2>
<a class="btn btn-primary btn-sm" href="add.php">Ajouter un voyage</a>
<table class="table table-bordered table-striped">
  <tr>
    <th>Intitulé</th>
    <th>Destination</th>
    <th>Dates</th>
    <th>Actions</th>
  </tr>
  <?php foreach($trips as $trip): ?>
    <tr>
      <td>
        <?php echo $trip['title'] ?>
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
        <a
          class="btn btn-primary btn-sm"
          href="edit.php?id=<?php echo $trip['id'] ?>">Editer</a>
        <a
          class="btn btn-danger btn-sm"
          href="delete.php?id=<?php echo $trip['id'] ?>">Supprimer</a>
      </td>
    </tr>
  <?php endforeach; ?>
</table>

<?php
include('../../templates/footer.php');
?>
