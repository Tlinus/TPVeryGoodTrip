<?php
require_once('config.php');

// table: country
function getCountries() {
  $db = db_connect();
  $countries = null;
  if ($db) {
    $query = $db->prepare(
      'SELECT * FROM country ORDER BY name ASC');
    $result = $query->execute();
    if ($result) {
      $countries = $query->fetchAll(PDO::FETCH_ASSOC);
      return $countries;
    }
  }
  return $countries;
}

function getCountryById($id) {
  $db = db_connect();
  if ($db) {
    $query = $db->prepare(
      'SELECT * FROM country WHERE id = :id');
    $result = $query->execute(array(':id' => $id));
    if ($result) {
      return $query->fetch(PDO::FETCH_ASSOC);
    }
  }
  return null;
}

function getUsers() {
  $db = db_connect();
  $users = null;
  if ($db) {

    $query = $db->prepare(
      'SELECT * FROM user ');

    $result = $query->execute();
    if ($result) {
      $users = $query->fetchAll(PDO::FETCH_ASSOC);
      return $users;
    }
  }
  return $users;
}
// table: trip
function getTrips($full = true) {
  $db = db_connect();
  $trips = null;
  if ($db) {
    if ($full) {
      $query = $db->prepare(
        'SELECT * FROM trip ORDER BY date_start DESC');
    } else {
      // si le paramètre $full vaut false, on ne prend
      // qu'une partie des colonnes
      $query = $db->prepare(
        'SELECT trip.id, title, country, date_start, date_end, name AS country_name
          FROM trip
          LEFT JOIN country ON trip.country = country.id
          ORDER BY date_start DESC');
    }
    $result = $query->execute();
    if ($result) {
      $trips = $query->fetchAll(PDO::FETCH_ASSOC);
      return $trips;
    }
  }
  return $trips;
}


function getUserById($id) {
  $db = db_connect();
  if ($db) {
    $query = $db->prepare(
      'SELECT * FROM user WHERE id = :id');
    $result = $query->execute(array(':id' => $id));
    if ($result) {
      return $query->fetch(PDO::FETCH_ASSOC);
    }
  }
  return null;
}
function getTripById($id) {
  $db = db_connect();
  if ($db) {
    $query = $db->prepare(
      'SELECT * FROM trip WHERE id = :id');
    $result = $query->execute(array(':id' => $id));
    if ($result) {
      return $query->fetch(PDO::FETCH_ASSOC);
    }
  }
  return null;
}

function getTripByName($name) {
  $db = db_connect();
  if ($db) {
    $query = $db->prepare(
      'SELECT * FROM trip WHERE title = :name');
    $result = $query->execute(array(':name' => $name));
    if ($result) {
      return $query->fetch(PDO::FETCH_ASSOC);
    }
  }
  return null;
}

function updateUser($id, $data) {

  if ($data['active'] == 'on'){ $data['active'] = "true"; }else {$data['active'] = "false";}
  var_dump($data);
  $db = db_connect();
  if ($db) {
    $query = $db->prepare(
      'UPDATE user
        SET firstname = :firstname,
          lastname = :lastname,
          email = :email,
          password = :password,
          active = :active,
          role = :role
        WHERE id = :id
      ');
    $result = $query->execute(array(
      ':id'             => $id,
      ':firstname'      => $data['firstname'],
      ':lastname'       => $data['lastname'],
      ':email'          => $data['email'],
      ':password'        => $data['password'],
      ':active'         => $data['active'],
      ':role'         => $data['role']
    ));
    return $result;
  }
  return null;
}


function updateTrip($id, $data) {
  $db = db_connect();
  if ($db) {
    $query = $db->prepare(
      'UPDATE trip
        SET country = :country,
          date_start = :date_start,
          date_end = :date_end,
          title = :title,
          description = :description,
          price = :price
        WHERE id = :id
      ');
    $result = $query->execute(array(
      ':id'           => $id,
      ':country'      => $data['country'],
      ':date_start'   => $data['date_start'],
      ':date_end'     => $data['date_end'],
      ':title'        => $data['title'],
      ':description'  => $data['description'],
      ':price'        => $data['price']
    ));
    return $result;
  }
  return null;
}
function deleteUser($id) {
  $db = db_connect();
  if ($db) {
    $query = $db->prepare(
      'DELETE FROM user WHERE id = :id');
    $result = $query->execute(array(':id' => $id));
    return $result;
  }
  return null;
}

function deleteTrip($id) {
  $db = db_connect();
  if ($db) {
    $query = $db->prepare(
      'DELETE FROM trip WHERE id = :id');
    $result = $query->execute(array(':id' => $id));
    return $result;
  }
  return null;
}

function searchTrip($criteria) {
  $db = db_connect();
  if ($db) {
    $sql = 'SELECT trip.id, country, title,
      date_start, date_end, price, name AS country_name
      FROM trip
      LEFT JOIN country ON trip.country = country.id
      WHERE trip.id > 0';

    if ($criteria['country'] != null) {
      $sql .= ' AND country = ' . $criteria['country'];
    }

    if ($criteria['date_start'] != null) {
      // SQL exige la présence de single quotes autour de la date
      // 2018-08-24 => MAUVAIS ; '2018-08-24' => OK
      $sql .= ' AND date_start >= ' . '\''
        . $criteria['date_start'] . '\'';
    }

    if ($criteria['date_end'] != null) {
      $sql .= ' AND date_end <= ' . '\''
        . $criteria['date_end'] . '\'';
    }

    if ($criteria['price'] != null) {
      $sql .= ' AND price < ' . $criteria['price'];
    }

    $query = $db->prepare($sql);
    $result = $query->execute();
    if ($result) {
      return $query->fetchAll(PDO::FETCH_ASSOC);
    }
  }
}

// table: picture
function insertPicture($trip_id, $path) {
  $db = db_connect();
  echo('father');
  if ($db) {
    echo ("mother");
    $query = $db->prepare(
      'INSERT INTO picture (trip_id, path)
        VALUES(:trip_id, :path)');
    $result = $query->execute(array(
      ':trip_id' => $trip_id,
      ':path' => $path
    ));
    echo("else");
    var_dump($result);
    return $result;
  }
  return null;
}

function getPicturesByTrip($trip_id) {
  $db = db_connect();
  if ($db) {
    $query = $db->prepare(
      'SELECT * FROM picture WHERE trip_id = :trip_id');
    $result = $query->execute(array(':trip_id' => $trip_id));
    if ($result) {
      return $query->fetchAll(PDO::FETCH_ASSOC);
    }
  }
  return null;
}




?>
