<?php
    session_start(); // Allows the file to get teacher username.
	include_once "DBH.php"; // Allows current file to use $conn in "DBH.php".
	
    // Fetches all the data in the form from the teacher.
    $dbstudentName = $_POST["studentName"];
    $dbstudentpwd = $_POST["studentPwd"];
    $dbclass = $_POST["class"];
    $dbusername = $_SESSION["username"];
    
    /* Finds if theres a student account with
    the same information inputted from the teacher*/
    $sqlCreate = 
    "SELECT * FROM studentaccounts 
    WHERE studentName ='$dbstudentName' 
    AND studentPwd ='$dbstudentpwd' 
    AND class = '$dbclass';";
    $resultCreate = mysqli_query($conn, $sqlCreate);

    /* Creates a student account if there's no student account with
    the same information from the teacher or
    goes back to Create student accounts page.*/
    if (mysqli_fetch_assoc($resultCreate) == Null)
    {
        $sql = 
        "INSERT INTO studentaccounts
        (studentName, studentPwd, username, class) 
        VALUES('$dbstudentName', '$dbstudentpwd', '$dbusername', '$dbclass');";
        $result = mysqli_query($conn, $sql);
        header("Location: Homepage.php");
    }
    else
    {
        header("Location: Create Student Accounts.php?exists=True");
    }