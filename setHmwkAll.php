<?php
	/* Allows the current file to access variables
    from other pages of the website */
	session_start();

    // Allows the current file to access from variables from DBH.php
	include_once "DBH.php";

	$topic = $_SESSION["topicSet"];
	/* Finds the questions in the subtopic within the database
	to be retrieved to the current page. */
	$subtopic = $_GET['subSet'];
    $sql = "SELECT * FROM questions WHERE questionName = '$subtopic';";
    $resultSubtopic = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($resultSubtopic);

    /* Stores the questions and answers in session variables that can
    transfer the information they have to the database once the teacher
    has finished setting the homework. */
    $_SESSION["hmwkQ"] =$row["questions"];
    $_SESSION["hmwkAns"] =$row["answers"];
    header("Location:subtopics.php?topic=$topic&subSet=$subtopic");