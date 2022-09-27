
<?php
  $host_name = 'db5010208595.hosting-data.io';
  $database = 'dbs8652181';
  $user_name = 'dbu557980';
  $password = 'bettercheddar2';

  $link = new mysqli($host_name, $user_name, $password, $database);

  if ($link->connect_error) {
    die('<p>Failed to connect to MySQL: '. $link->connect_error .'</p>');
  } else {
    //echo '<p>Connection to MySQL server successfully established.</p>';
  }
?>