
<?php
  $host_name = 'host name';
  $database = 'database name';
  $user_name = 'username';
  $password = 'password';

  $link = new mysqli($host_name, $user_name, $password, $database);

  if ($link->connect_error) {
    die('<p>Failed to connect to MySQL: '. $link->connect_error .'</p>');
  } else {
    //echo '<p>Connection to MySQL server successfully established.</p>';
  }
?>
