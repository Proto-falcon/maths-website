<?php
	include_once "DBH.php";
    $dbusername = $_POST["username"];
    $dbpassword = $_POST["password"];
    /* Will either store the teacher's username and password in the database then
    go to the homepage or back to teacher account page which will display an alert. */
    if ($_POST["SignIn"])
    {
        $sqlSign = 
        "SELECT * FROM teacheraccounts 
        WHERE username='$dbusername' 
        AND password='$dbpassword';";
        $resultSign = mysqli_query($conn, $sqlSign);
        if (mysqli_fetch_assoc($resultSign) == Null)
        {
            $sql = 
            "INSERT INTO teacheraccounts
            (username, password) 
            VALUES ('$dbusername', '$dbpassword');";
            $result = mysqli_query($conn, $sql);
            header("Location: Homepage.php?username=".$dbusername);
        }
        else
        {
            Header("Location: Teacher_Account.html?exists=True");
        }
    }
    /* Will either go to the homepage or 
    back to teacher account page which will display an alert. */
    elseif ($_POST["Login"])
    {
        $sqlLogin = 
        "SELECT * FROM teacheraccounts 
        WHERE username='$dbusername' 
        AND password='$dbpassword';";
        $resultLogin = mysqli_query($conn, $sqlLogin);
        if (mysqli_fetch_assoc($resultLogin) != Null)
        {
            header("Location: Homepage.php?username=".$dbusername);
        }
        else
        {
            Header("Location: Teacher_Account.html?exists=True");
        }
    }
