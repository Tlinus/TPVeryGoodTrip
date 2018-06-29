<?php

if(isset($_GET['trip'])){
  require_once('dbmanager.php');
  require_once('utility.php');
  include('templates/header.php');

  $thisTrip = getTripByName(urldecode($_GET['trip']));
  $thisPhotos = getPicturesByTrip($thisTrip['id']);
  $thisCountry = getCountryById($thisTrip['country']);

}
else {
  header ('Location: index.php');
}
?>

<div class="container">
  <div class="row text-center">
    <div class="col-12 text-center">
        <h2><?php echo $thisTrip['title'] ?></h2>
    </div>
    <?php foreach ($thisPhotos as $key => $value) {
        echo('<div class="col-4 img-thumbnail">
        <img src="static/img/upload/'.$value['path'].'" />
        </div>');
    } ?>
    <div class="col-12">
        <h4>Du <?php echo($thisTrip['date_start'].' au '. $thisTrip['date_end']); ?> </h4>
    </div>
    <div class="col-12">
      <h4> En <?php echo ($thisCountry['name']) ?></h4>
    </div>
    <div class="col-12">
       <h3><?php echo  $thisTrip['price'] ?> €</h3>
    </div>
    <div class="col-12">
        <p>
          <?php echo $thisTrip['description'] ?>
        </p>
    </div>
    </div>
  </div>
</div>
<?php
include('../../templates/footer.php');
?>
