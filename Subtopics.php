<?php
    /* Allows the current file to access variables
    from other pages of the website */
    session_start();

    /* Changes the title of the current page depending
    on the buttons clicked on the previous pages. */
    if ($_SESSION["eduStage"] == "GCSE")
    {
        $eduStage = $_SESSION["eduStage"];
    }
    else
    {
        $eduStage = "A level";
    }

    // The selected topic will have it's name displayed.
	switch ($_GET["topic"])
	{
		case 'num':
			$topicName = "Number";
			$_SESSION["topic"] = $topicName;

            /* This session variable will store the value
            to identify each topic for the php file that
            will store the questions in a session variable. */
            $_SESSION["topicSet"] = $_GET["topic"];
			break;

		case 'al':
			$topicName = "Algebra";
			$_SESSION["topic"] = $topicName;
            $_SESSION["topicSet"] = $_GET["topic"];
			break;
		
		case 'geo':
			$topicName = "Geometry";
			$_SESSION["topic"] = $topicName;
            $_SESSION["topicSet"] = $_GET["topic"];
			break;

		case 'prob':
			$topicName = "Probability";
			$_SESSION["topic"] = $topicName;
            $_SESSION["topicSet"] = $_GET["topic"];
			break;

		case "stat":
			$topicName = "Statistics";
			$_SESSION["topic"] = $topicName;
            $_SESSION["topicSet"] = $_GET["topic"];
			break;

		case 'ratio':
			$topicName = "Ratio";
			$_SESSION["topic"] = $topicName;
            $_SESSION["topicSet"] = $_GET["topic"];
			break;

		case 'trig':
			$topicName = "Trigonometry";
			$_SESSION["topic"] = $topicName;
            $_SESSION["topicSet"] = $_GET["topic"];
			break;

		default:
			$topicName = "Calculus";
			$_SESSION["topic"] = $topicName;
            $_SESSION["topicSet"] = $_GET["topic"];
			break;
	}
?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Subopics page</title>
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
		top: 30px;
        margin: auto;
		background-color: #FFF;
		width: 303mm;
		font-family: "Arial Black", Gadget, sans-serif;
		font-size: 50px;
		color: #00F;
		border: 2px solid #000;
		padding: 20px;
	}
    
	button
	{
		color: #00F;
		font-size: 25px;
		background-color:#FFF; 
		font-family: "Arial Black", Gadget, sans-serif;
        width: 143mm;
		border: 0;
		border-top: 0;
		border-bottom: 0;
	}

	#SubContent
	{
		bottom: 20px;
		width: 143mm;
		margin: auto;
	}
	
	.setAll
	{
		color:#00F;
        background-color:#FFF;
        width: 125px;
        border-radius: 10px;
        right: 350px;
        bottom: 42px;
	}

    #giveStudents
    {
        border: 2px solid #000;
        top: 200px;
        height: 100px;
        width: 225px;
        left: 30%;
        border-radius: 10px;
    }

    /* unvisited link */
    a:link {
      text-decoration: none;
    }

    /* visited link */
    a:visited {
      text-decoration: none;
    }

    /* mouse over link */
    a:hover {
      text-decoration: none;
    }

    /* selected link */
    a:active {
      text-decoration: none;
    }

</style>

<body>
    <div class="w3-bar w3-white">
        <a class="w3-bar-item w3-xlarge">
        	<?php echo $_SESSION["username"]; ?>
        </a>
        <a href="HomePage.php" 
            class="w3-bar-item 
            w3-button 
            w3-text-blue 
            w3-hover-blue 
            w3-xxlarge">
            <i class="fa fa-home"></i>
        </a>
        <a class="w3-xxlarge" id="Title">
        	Maths Website
        </a>
        <a href="Search_Topics.php"
        	class="w3-bar-item
        	w3-button
        	w3-text-blue
        	w3-hover-blue
        	w3-xxlarge
        	w3-right">
        	<i class="fa fa-search"></i>
        </a>
    </div>

    <!-- The title will change depending on the buttons clicked on
    the previous pages. -->
    <h1 id="Subtopic">
        <?php echo($eduStage); ?> > <?php echo $topicName; ?> > Subtopics
    </h1>

    <!-- Loads the Setting homework page. -->
    <button id="giveStudents">
        <a href="SetHmwkPage.php">
            Give students homework
        </a>
    </button>
    <div id="SubContent">
    	<?php
        /* Allows current file to use $conn variable
        to link database to website.*/
    	include_once 'DBH.php';

        // Fetches all the subtopics within the topic.
    	switch ($_GET["topic"])
    	{
    		case 'num':
    			$sql = "SELECT * FROM questions WHERE topic = 'num';";
    			$resultTopic = mysqli_query($conn, $sql);
    			break;
    		case 'al':
    			$sql = "SELECT * FROM questions WHERE topic = 'al';";
    			$resultTopic = mysqli_query($conn, $sql);
    			break;
    		
    		case 'geo':
    			$sql = "SELECT * FROM questions WHERE topic = 'geo';";
    			$resultTopic = mysqli_query($conn, $sql);
    			break;

    		case 'prob':
    			$sql = "SELECT * FROM questions WHERE topic ='prob';";
    			$resultTopic = mysqli_query($conn, $sql);
    			break;

    		case 'stat':
    			$sql = "SELECT * FROM questions WHERE topic= 'stat';";
    			$resultTopic = mysqli_query($conn, $sql);
    			break;

    		case 'ratio':
    			$sql = "SELECT * FROM questions WHERE topic='ratio';";
    			$resultTopic = mysqli_query($conn, $sql);
    			break;

    		case 'trig':
    			$sql = "SELECT * FROM questions WHERE topic= 'trig';";
    			$resultTopic = mysqli_query($conn, $sql);
    			break;

    		default:
    			$sql = "SELECT * FROM questions WHERE topic = 'cal';";
    			$resultTopic = mysqli_query($conn, $sql);
    			break;
    	}

        // Displays all the subtopics in the selected topic from SQL query.
        while ($row = mysqli_fetch_assoc($resultTopic))
            {?>
                <a href="QuestionsDir.php?sub=<?php echo $row['questionName'] ?>">
                    <button id="Dir<?php echo $row['questionName'] ?>"
                    style="border: 2px solid #000;">
                        <?php echo $row["questionName"]?>
                    </button>
                </a>

                <!-- This button only appear in the
                homework section of the website for
                each subtopic -->
                <button class="setAll">
                    <a href="setHmwkAll.php?subSet=<?php echo $row['questionName'] ?>">
                        Set All
                    </a>
                </button>

                    <!-- The tick symbol will appear next to the subtopic
                    button that has been set for homework. -->
                    <i id="<?php echo($row['questionName']); ?>"
                        class="fas fa-check-circle fa-3x w3-text-white"
                        style="left: 300px;
                        bottom: 85px;
                        border-radius: 50px;
                        display: none;"></i>

                <?php
            }
    	?>
	</div>

</body>

<script>

    /* If the teacher is entering the subtopics
    without setting homework then the set all buttons
    won't appear on the page. */
	var hmwk = '<?php echo($_SESSION["hmwk"]); ?>';
    var setAll = document.getElementsByClassName('setAll');
    for (var i = 0; i < setAll.length; i++)
    {
        if (hmwk != "True")
        {
            setAll[i].style.display = "none";
            document.getElementById("giveStudents").style.display = "none";
            document.getElementById("SubContent").style.bottom = "0px";
            document.getElementById("SubContent").style.top = "50px";
        }
    }


    // Fetches the query value in the page URL to display the tick next to the subtopic button.
    var urlResult = window.location.search;
    var result = urlResult.slice(urlResult.lastIndexOf("=") + 1); // Only store query value.
    var lResult = result.split("%20");
    var subSet = lResult.join(" ");
    document.getElementById(subSet).style.display = "block";
</script>
</html>