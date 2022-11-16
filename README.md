# SeniorProject
Discription:

Our project consists of a simple budget management web site that will help users develop better spending habits. Users are able to log there spending and also have the ability to edit and delete any logs as they see fit. Once they insert their monthly income, calculations will be automatically made and they will see how they should divide their income based on their selected plan. The information will be presented as a bar graph which shows the user thier progress and where they stand in their plan.

How to run:

First you will need to set up either a remote or local database and insert the information corresponding to your database into the server.php file. You will replace the database information in the server.php file with that of your own database based on the information required.

*Please Note*: 
If you are using a remote database, code to connect your webpage to the database may be provided by your service provider. We used IONOS as a domain and database provider and were able to copy a premade database connection code.
If you will be using a local host you should switch the code provided in server.php to the one below and add your database information based on the information required:

*<?php

$servername = "localhost";

$database = "database name";

$username = "username";

$password = "password";

// Create connection

$link = mysqli_connect($servername, $username, $password, $database);

// Check connection

if ($link->connect_error) {

die("Connection failed: " . $link->connect_error);
}

echo “Connected successfully”;

mysqli_close($link);

?>*

After you creating and adjusting the information on the server.php file you can just download the rest of the files into your application that allows the use of HTML, CSS, JavaScript and PHP code. Once all the files are copied to your application the code should work once it is run or put into the programming application.

