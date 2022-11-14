# SeniorProject
How to run:
First you will need to set up either a remote or local database and insert the information corresponding to the database into the server.php file.
*Please Note* 
If you are using a remote database code to connect your webpage to the database can be provided by your service provider. IONOS is an example of these service providers.
If you will be using a local host you should switch the code provided in server.php to:

*<?php

  $servername = "localhost";

  $username = "username";

  $password = "password";


  // Create connection

  $link = mysqli_connect($servername, $username, $password);


  // Check connection

  if (!$conn) {

    die("Connection failed: " . mysqli_connect_error());

  }

  echo "Connected successfully";

?>*

