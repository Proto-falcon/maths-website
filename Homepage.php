<?php
    /* Allows the current file to access variables
    from other pages of the website */
    session_start();

    /* Allows current file to use $conn variable
    to link database to website.*/
    include_once 'DBH.php';

    if (isset($_GET["username"]))
    {
        $_SESSION["username"] = $_GET["username"];
    }

    /* Lets the website know whether
    it's a student or teacher accessing
    the website to send the value to
    javascript code in the page.*/
    if (isset($_SESSION["student"]))
    {
        $student = 1;
    }
    else
    {
        $student = 0;
    }

    /* To be able to put the user's
    username in the sql query. */
    $username = $_SESSION["username"];

    /* Compares the score in the database
    of the current homework to the latest
    score to see whether it needs to be
    updated if it's bigger than the score
    in the database.*/
    if (isset($_SESSION["total"]) and isset($_SESSION["hmwkN"]))
    {
        $total = $_SESSION["total"];
        $hmwkName = $_SESSION["hmwkN"];
        $sql = "SELECT * FROM homework
        WHERE hmwkName = '$hmwkName'
        AND studentName ='$username';";
        $result = mysqli_query($conn, $sql);
        $hmwk = mysqli_fetch_assoc($result);
        $score = $hmwk["scores"];
        if ($total > $score)
        {
            $sqlUpdate = "UPDATE homework
            SET scores = $total
            WHERE hmwkName = '$hmwkName'
            AND studentName ='$username';";
            mysqli_query($conn, $sqlUpdate);
        }
    }
    
    /* Used to keep track of the student's
    score of their homework. */
    $_SESSION["total"] = 0;
    $_SESSION["qTrack"] = [];

    // Checks whether there's any homework set by the teacher.
    $sql = "SELECT * FROM homework WHERE username = '$username'";
    $hmwk = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($hmwk);
    $hmwkExist = 1;
    if (isset($row) == null)
    {
        $hmwkExist = 0;
    }
?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Homepage</title>
</head>
<link rel="stylesheet" href="w3.css">
<link rel="stylesheet" href="fontawesome-free-5.8.2-web/css/all.css">
<style>
    body
    {
        background-color: #00F;
    }
    
    #Title
    {
        color: #00F;
    }
    
    *
    {
        position: relative;
        font-family: "Arial Black", Gadget, sans-serif;
        text-align: center;
    }
    
    
    table
    {
        border-collapse: collapse;
        border: 3px solid #000;
        font-size: 32px;
        top: 50px;
        left: 0%;
        background-color: #FFF;
    }

    td
    {
        border-collapse: collapse;
        border: 3px solid #000;
        color: #00F;
    }

    th
    {
        border-collapse: collapse;
        border: 3px solid #000;
        color: #00F;
    }

    h1
    {
        top: 60px;
        background-color: #FFF;
        width: 731px;
        font-family: "Arial Black", Gadget, sans-serif;
        color: #00F;
        border-top: 2px solid #000;
        border-right: 2px solid #000;
        border-left: 2px solid #000;
    }

    button
    {
        color: #00F;
        font-size: 50px;
        background-color:#FFF; 
        border-radius: 5px;
        font-family: "Arial Black", Gadget, sans-serif;
    }

    a:link
    {
        text-decoration: none;
    }

    a:visited
    {
        text-decoration: none;
    }

    a:hover
    {
        text-decoration: none;
    }

    a:active
    {
        text-decoration: none;
    }
</style>

<!-- This allows the website to be able to display the username
on all pages in the website with a navigation bar -->
<body>
    <div class="w3-bar w3-white">
        <!-- This will display the username of the user going into the website in the navigation bar. -->
        <a class="
        w3-bar-item
        w3-left w3-xlarge">
            <?php echo $_SESSION["username"]; ?>
        </a>

        <!-- This lets the user sign out of the website. -->
        <a href="First Page.php"
        class="
        w3-bar-item 
        w3-button 
        w3-text-blue 
        w3-hover-blue 
        w3-xlarge ">
            Sign Out
        </a>
        <a class="w3-xxlarge" id="Title">
            Maths Website
        </a>

        <!-- This is the button in the navigation bar that leads to the search page. -->
        <a href="Search_Topics.php"
        class="w3-bar-item 
        w3-button 
        w3-text-blue 
        w3-hover-blue 
        w3-xxlarge 
        w3-right">
            <i class="fas fa-search"></i>
        </a>
    </div>

    <!-- This button will lead to
    create student account page. -->
    <button id="CreateStudents"
    style="
    top: 50px;
    left: 675px; 
    height: 250px; 
    width: 300px;">
        <a id="CreateStudents"
        href="Create Student Accounts.php">
            Create Student Account
        </a>
    </button>

    <!-- This button will lead to topic education stage page. -->
    <button
    style="
    top: 350px; 
    left: 425px; 
    padding: 20px;">
        <a href="Topic_Education_Stage.php?homework=False">
            Topic
        </a>
    </button>

    <!-- This button will lead to first page
    of homework section in the website. -->
    <button id="Homework"
    style="
    top: 500px; 
    left: 100px; 
    padding: 20px;">
        <a id="Homework" href="Topic_Education_Stage.php?homework=True">
            Set Homework
        </a>
    </button>

    <!-- In the student homepage version,
    there won't be a columm for students and
    each row will be a button for homework. -->
    <div id="table" style="left: 5%; bottom: 30%;">
        <h1>Homework</h1>
        <table>
            <thead>
                <tr>
                    <th id="name">Name</th>
                    <th id="score">Score</th>
                    <th id="students">Students</th>
                    <th id="due">Due Date</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    /* Allows the current file to use
                    $conn variable to connect to the database.*/
                    include_once "DBH.php";

                    /* Indicates whether the user is
                    a student or teacher */
                    if (isset($_SESSION["student"]))
                    {
                        /* In the student homepage it will display all the student's homework
                        given by their teacher and click on any rows to go to their homework. */
                        $dbstudentName = $_SESSION["username"];
                        $sql = "SELECT * FROM homework WHERE studentName = '$dbstudentName';";
                        $result = mysqli_query($conn, $sql);
                        while ($row = mysqli_fetch_assoc($result))
                        {
                            $hmwkName = $row["hmwkName"];
                            ?>
                            <tr>
                                <td style="width: 350px;">
                                    <a href="hmwkQuestions.php?qNum=1&hmwkN=<?php echo($hmwkName); ?>">
                                        <?php echo($hmwkName); ?> 
                                    </a>
                                </td>

                                <td style="width: 155px;">
                                    <a href="hmwkQuestions.php?qNum=1&hmwkN=<?php echo($hmwkName); ?>">
                                        <?php echo($row["scores"]); ?>
                                    </a>
                                </td>

                                <td style="width: 200px;">
                                    <a href="hmwkQuestions.php?qNum=1&hmwkN=<?php echo($hmwkName); ?>">
                                        <?php echo($row["dueDate"]); ?>
                                    </a>
                                </td>
                            </tr>
                            <?php
                        }
                    }
                    else
                    {
                        /* In the teacher homepage the homework table will display all
                        the teacher's students' homework given. */
                        $username = $_SESSION["username"];
                        $sql = "SELECT * FROM homework WHERE username = '$username';";
                        $result = mysqli_query($conn, $sql);
                        while ($row = mysqli_fetch_assoc($result))
                        {
                            ?>
                            <tr>
                                <td style="width: 200px;">
                                    <?php echo($row["hmwkName"]); ?> 
                                </td>

                                <td style="width: 128px;">
                                    <?php echo($row["scores"]); ?>
                                </td>

                                <td style="width: 200px;">
                                    <?php echo($row["studentName"]); ?>
                                </td>

                                <td style="width: 200px;">
                                    <?php echo($row["dueDate"]); ?>
                                </td>
                            </tr>
                            <?php
                        }
                    }
                ?>
            </tbody>
        </table>
    </div>

</body>

<script>
    /* In the student homepage version,
    the website will see if the user is a student and
    if true then the student columm is removed. */
    var student = <?php echo ($student);?>;
    if (student == 1)
    {
        document.getElementById("CreateStudents").style.display = "none";
        document.getElementById("Homework").style.display = "none";
        document.getElementById("students").style.display = "none";
        document.getElementById("table").style.bottom = "10%";
    }

    // Keeps the table's shape when there is no homework set.
    var hmwkExist = <?php echo($hmwkExist); ?>;
    var student = <?php echo($student); ?>;
    if (student == 0)
    {
        if (hmwkExist == 0)
        {
            document.getElementById("name").style.width = "200px";
            document.getElementById("score").style.width = "128px";
            document.getElementById("students").style.width = "200px";
            document.getElementById("due").style.width = "200px";
        }
    }
    else
    {
        if (hmwkExist == 0)
        {
            document.getElementById("name").style.width = "373px";
            document.getElementById("score").style.width = "155px";
            document.getElementById("due").style.width = "200px";
        }
    }
</script>

</html>