<?php
    /* Allows the current file to set
    variables to be used in other pages.*/
    session_start();
    /* Allows the current file to use
    $conn variable to connect to the database.*/
	include_once "DBH.php";
	
    // Fetches input data from the student.
    $dbstudentName = $_POST["studentName"];
	$dbclass = $_POST["class"];
    $dbstudentPwd = $_POST["studentPwd"];

    /* Lets the user to login to the website if there's
    no existing account in the database
    or goes back to the student login page. */
	if ($_POST["Login"])
    {
        $sqlLogin = "SELECT * FROM studentaccounts 
        WHERE studentName ='$dbstudentName'
        AND class = '$dbclass'
        AND studentPwd ='$dbstudentPwd';";
        $resultLogin = mysqli_query($conn, $sqlLogin);
        if (mysqli_fetch_assoc($resultLogin) != Null)
        {
            $_SESSION["class"] = $dbclass;
            header("Location: Homepage.php?username=".$dbstudentName."&student=True");
            $_SESSION["student"]= "true";
        }
        else
        {
            Header("Location: Student_Login_Page.html?exists=False");
            $_SESSION["student"]= "false";
        }
    }
