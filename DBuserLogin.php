<?php
	include_once "DBH.php";
    $dbusername = $_POST["username"];
    $dbpassword = $_POST["password"];
    if ($_POST["SignIn"])
    {
        $sqlSign = "SELECT * FROM user_details WHERE username='$dbusername' AND password='$dbpassword' AND usertype='teacher';";
        $resultSign = mysqli_query($conn, $sqlSign);
        if (mysqli_fetch_assoc($resultSign) == Null)
        {
            $sql = "INSERT INTO user_details (username, password, usertype) VALUES ('$dbusername', '$dbpassword', 'teacher');";
            $result = mysqli_query($conn, $sql);
            header("Location: Homepage.php?username=".$dbusername);
        }
        else
        {
            Header("Location: Teacher_Account.html");
        }
    }
    elseif ($_POST["Login"])
    {
        $sqlLogin = "SELECT * FROM user_details WHERE username='$dbusername' AND password='$dbpassword' AND usertype='teacher';";
        $resultLogin = mysqli_query($conn, $sqlLogin);
        if (mysqli_fetch_assoc($resultLogin) != Null)
        {
            header("Location: Homepage.php?username=".$dbusername);
        }
        else
        {
            Header("Location: Teacher_Account.html");
        }
    }
