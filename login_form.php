<?php
include('config.php');
include(TEMPLATES_PATH . '\header.php');
?>

<form action="login_process.php" method="post">
  <input type="email" name="email" placeholder="email">
  <input type="password" name="password" placeholder="password">
  <input type="submit" name="submit" value="Valider">
</form>

<?php include('templates/footer.php') ?>
