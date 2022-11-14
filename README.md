# SeniorProject
Discription:
Our project is a simple budget management web site that will allow users to log there spending. Our website will allow the user to input there monthly income and by doing this it will help track the user to make sure that they are not spending more than they are making. There are also features that allow the user to set how much they need for bills, how much they want to save, and how much money they will have for just spending for fun. The plan they have setup pulse their income will then be represent in these graphs that will show the user how much they are spending in each category and prompt them if they’re spending too much in one area.

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

