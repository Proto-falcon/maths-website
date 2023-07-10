<?php
	/* Allows the current file to access variables
    from other pages of the website */
	session_start();

    // Allows the current file to access variables from DBH.php
	include_once "DBH.php";

	/* Stores the questions and answers in session variables that can
    transfer the information they have to the database once the teacher
    has finished setting the homework. */
    $q = $_GET["q"];
    $qNum = intval($_SESSION["btnCLicked"]);
    if (count($_SESSION["hmwkQ"]) < 4)
    {
    	$_SESSION["hmwkQ"] = $_SESSION["hmwkQ"].$q.", ";
    	$_SESSION["hmwkAns"] = $_SESSION["hmwkAns"].$_SESSION["answer"].", ";
    	header("Location:Questions.php?qNum=$qNum&set=Set");
    }
    elseif (count($_SESSION["hmwkQ"]) == 4)
    {
    	$_SESSION["hmwkQ"] = $_SESSION["hmwkQ"].$q;
    	$_SESSION["hmwkAns"] = $_SESSION["hmwkAns"].$_SESSION["answer"];
    	header("Location:Questions.php?qNum=$qNum&set=Set");
    }
    else
    {
    	header("Location:Questions.php?qNum=$qNum");
    }

    