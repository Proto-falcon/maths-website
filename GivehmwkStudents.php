<?php
	/* Allows the current file to access variables
    from other pages of the website */
    session_start();

	// Allows the current file to access from variables from DBH.php
	include_once "DBH.php";

	/* Sends the homework information to the database then
	loads the homepage after sending the information to the databases. */
	$hmwkName = $_POST["hmwkName"];
	$qs = $_SESSION["hmwkQ"];
	$ans = $_SESSION["hmwkAns"];
	$class = $_SESSION["class"];
	$username = $_SESSION["username"];
	$dueDate = $_POST["dueDate"];

	/* Selects all the students from the selected class to be iterated
	through one at a time to be sent their homework from their teacher. */
	$sqlFind = "SELECT * FROM studentaccounts WHERE class = '$class';";
	$findResult = mysqli_query($conn, $sqlFind);
	while ($row = mysqli_fetch_assoc($findResult))
	{
		$dbstudentName = $row["studentName"];
		$sqlIn = "INSERT INTO homework
		(hmwkName, questions, answers, studentName, username, scores, dueDate)
		VALUES ('$hmwkName','$qs','$ans','$dbstudentName', '$username', 0 ,'$dueDate');";
		mysqli_query($conn, $sqlIn);
		header("Location:Homepage.php");
	}

