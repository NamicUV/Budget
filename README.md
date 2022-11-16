# SeniorProject
Discription:

Our project consists of a simple budget management web site that will help users develop better spending habits. Users are able to log there spending and also have the ability to edit and delete any logs as they see fit. Once they insert their monthly income, calculations will be automatically made and they will see how they should divide their income based on their selected plan. The information will be presented as a bar graph which shows the user thier progress and where they stand in their plan.

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

After you creating and adjusting the information on the server.php file you can just download the rest of the files into your application that allows the use of HTML, CSS, JavaScript and PHP code. Once all the files are copied to your application the code should work once it is run or put into the programming application.

