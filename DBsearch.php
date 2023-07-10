<?php
	Include_once "DBH.php";
	// Allows the current file to access from variables from DBH.php

	/* Allows the current file to access variables
    from other pages of the website. */
	session_start();
	$_SESSION["eduStage"] = $_POST["Education_Stage"];
	$_SESSION["topic"] = $_POST["Topic"];
	$_SESSION["hmwk"] = "False";
	//Allows other pages in the website to use this variable from session.

	$grade = $_POST["Grade"];
	$topic = $_SESSION["topic"];
	// Allows the value to be put in the URL without causing errors.


	/* Sends a query to the database to fetcg only topics that
	meet the specified criteria chosen from the user then checks whether
	there's any topics in the datbase to send the user back to the search page
	or load the subtopics page. */
	$sql = "SELECT * FROM questions
	WHERE topic = '$topic'
	AND grade = $grade;";
	$result = mysqli_query($conn, $sql);
	if (mysqli_fetch_assoc($result) == NULL)
	{
		header("Location: Search_Topics.php");
	}
	else
	{
		header("Location: Subtopics.php?topic=$topic");
	}