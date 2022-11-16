# SeniorProject
Description:

Our project consists of a simple budget management web site that will help users develop better spending habits. Users are able to log there spending and also have the ability to edit and delete any logs as they see fit. Once they insert their monthly income, calculations will be automatically made and shown allowing users to see how they should divide their income based on their selected plan. The information will be presented as a bar graph which shows the users their progress and where they standings accoring to thier plan.

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

Once you have successfully connected your database to your webage feel free to comment out the echo line in the server.php file so that it will not appear on your webpage. Next, make sure you are using a coding application that allows the use of HTML, CSS, JavaScript and PHP code. Next you should download the code from the repository and add all of the files from the repository to your coding application. Make sure that all files are under the same folder and once that is done the code should be ready to use. Run/Put the code into your webpage space and this should be everything that needs to be done in order to use the project. If you have your own domain just enter the website domain into your browser url to see the project but if you are using a local host you will need to enter the local host url into your browser url to see the project.
