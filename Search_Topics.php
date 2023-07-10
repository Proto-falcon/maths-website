<?php
    /* Allows the current file to access variables
    from other pages of the website. */
    session_start();

    /* Allows current file to use $conn variable
    to link database to website.*/
    include_once 'DBH.php';

    if (isset($_GET["username"]))
    {
        $_SESSION["username"] = $_GET["username"];
    }

    if (isset($_SESSION["student"]))
    {
        $student = 1;
    }
    else
    {
        $student = 0;
    }

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
?>

<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Search Topics</title>
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

    h1
    {
        color: #00F;
        font-family: "Arial Black", Gadget, sans-serif;
        font-size: 64px;
        background-color: #FFF;
        top: 50px;
        width: 600px;
        padding: 20px;
        margin: auto;
    }

    p
    {
        color: #00F;
        font-family: "Arial Black", Gadget, sans-serif;
        background-color: #FFF;
        margin-left: 325px;
        top: 40px;
        width: 300px;
        padding: 5px;
        font-size: 32px;
    }

    form
    {
        top: 50px;
    }

    select
    {
        bottom: 46px;
        margin-left: 15%;
        font-size: 32px;
    }

    button
	{
		color: #00F;
		font-size: 64px;
		border-radius: 5px;
        font-family: "Arial Black", Gadget, sans-serif;
        padding: 30px;
        bottom: 300px;
        left: 200px;
	}
    
    #Topic
    {
        bottom: 110px;
        left: 11%;
    }
</style>

<body>
    <div class="w3-bar w3-white">
            <a class="w3-bar-item w3-xlarge">
                <?php echo $_SESSION["username"]; ?>
            </a>
            <a href="HomePage.php" 
            class="
            w3-bar-item 
            w3-button 
            w3-text-blue 
            w3-hover-blue 
            w3-xxlarge">
                <i class="fa fa-home"></i>
            </a>
            <a class="w3-xxlarge" id="Title">Maths Website</a>
    </div>

    <!-- The form will have selector buttons that are for "Education Stage", "Grade", "Topic" and
    search button to search for specific subtopics. -->
    <h1>Search Topics</h1>
    <form action="DBsearch.php" method="POST">
        <p>Education Stage</p>

        <!-- This is the "Education Stage" selector button that can select between "GCSE" or "A level". -->
        <select name="Education_Stage">
            <option value="GCSE">GCSE</option>
            <option value="A Level">A level</option>
        </select>

        <!-- This is the "Grade" selector button that can select from 1-9. -->
        <p>Grade</p>
        <select name="Grade">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
                <option value="9">9</option>   
        </select>

        <!-- This is the "Topic" button that can select from all the topics
        available in the maths specificaiton. -->
        <p>Topic</p>
        <select name="Topic" id="Topic">
                <option value="num">Numbers</option>
                <option value="al">Algebra</option>
                <option value="geo">Geometry</option>
                <option value="prob">Probabilty</option>
                <option value="stat">Statistics</option>
                <option value="ratio">Ratio</option>
                <option value="trig">Trigonometry</option>
                <option value="cal">Calculus</option>
        </select>

        <!-- This is the search button that will search for specific subtopics
        in the criteria specified from the user. -->
        <button>Search</button>
    </form>
</body>

</html>