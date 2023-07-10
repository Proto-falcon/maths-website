<?php
$dbServername = "localhost"; //Declare name of the server.
$dbUsername = "root";
$dbPassword = ""; // Made an empty password to enter server.
$dbname = "maths website database"; // Name of the database.

// Connection between database and maths website.
$conn = mysqli_connect($dbServername, $dbUsername, $dbPassword, $dbname);