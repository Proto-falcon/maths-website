<?php
	/* Allows the current file to access variables
    from other pages of the website */
	session_start();

    // Allows the current file to access from variables from DBH.php
	include_once "DBH.php";

	/* It checks whether the subtopic name exists in the database then
	stores the name in a session variable so the question page can
	access it. */
	$subtopic = $_GET['sub'];
	$sql = "SELECT * FROM questions WHERE questionName = '$subtopic';";
    $resultSub = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($resultSub);
    $_SESSION["subtopic"] = $row["questionName"];
    $sub = $row["questionName"];
    header("Location:Questions.php?qNum=1");