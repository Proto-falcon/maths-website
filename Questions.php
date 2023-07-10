<?php
	/* Allows the current file to access variables
    from other pages of the website */
	session_start();

	/* Allows current file to use $conn variable
    to link database to website.*/
	include_once 'DBH.php';
	if ($_SESSION["eduStage"] == "GCSE")
    {
        $eduStage = $_SESSION["eduStage"];
    }
    else
    {
        $eduStage = "A level";
    }

	/* Finds the questions in the subtopic within the database
	to be retrieved to the current page. */
	$subtopic = $_SESSION['subtopic'];
    $sql = "SELECT * FROM questions WHERE questionName = '$subtopic';";
    $resultSubtopic = mysqli_query($conn, $sql);
    $row= mysqli_fetch_assoc($resultSubtopic);
    $questions = explode(", ", $row["questions"]);
    $answers = explode(", ", $row["answers"]);

    /* The current page will start at question 1 and
    set empty strings for 5 questions and
    answers respectively in the subtopic. */
    $_SESSION["btnCLicked"] = intval($_GET["qNum"]);

    /* Stores the question and answer in variables
    so that the user can answer the quesion and the
    website be able to tell them whether their right
    or wrong */
    switch ($_SESSION["btnCLicked"])
        {
            case 5:
                $q = $questions[4];
                $_SESSION["answer"] = $answers[4];
                break;
        
            case 4:
                $q = $questions[3];
                $_SESSION["answer"] = $answers[3];
                break;
        
            case 3:
                $q = $questions[2];
                $_SESSION["answer"] = $answers[2];
                break;
        
            case 2:
                $q = $questions[1];
                $_SESSION["answer"] = $answers[1];
                break;
        
            default:
                $q = $questions[0];
                $_SESSION["answer"] = $answers[0];
                break;
        }
    /* The variable can be used to
    carry the value to the link within
    set button. */
    $qNum = intval($_GET["qNum"]);
?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Questions</title>
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
		width: 1300px;
		font-size: 64px;
		font-family: "Arial Black", Gadget, sans-serif;
		color: #00F;
		padding: 10px;
		border: 2px solid #000;
	}
	
	h2
	{
		top: 60px;
        margin: auto;
		background-color: #FFF;
		width: 1300px;
		font-size: 45px;
		font-family: "Arial Black", Gadget, sans-serif;
		color: #00F;
		padding: 5px;
		border: 2px solid #000;
	}
    
	button
	{
		color: #00F;
		background-color: #FFF;
		font-size: 25px;
		width: 100px;
		font-family: "Arial Black", Gadget, sans-serif;
		border: 2px solid #FFF;
		cursor: pointer;
	}
	
	button:hover
	{
		border: 2px solid #00F;
	}
	
	button:active
	{
		background-color:#00F;
		color:#FFF;
	}
	
	div
	{
		margin: auto;
		background-color:#FFF;
		width:inherit;
	}
	
	textarea
	{
		right: 200px;
		border: 2px solid #00F;
		border-radius: 5px;
		text-align:left;
	}
	
	#check
	{
		color:#FFF;
		background-color:#00F;
		bottom: 100px;
		margin: auto;
		width: 125px;
		height:50px;
		border-radius: 10px;
	}

	#set
	{
		bottom: 250px;
		left: 325px;
		color:#FFF;
		background-color:#00F;
		width: 125px;
		height:50px;
		border-radius: 10px;
	}

	p 
	{
		font-size: 32px;
		font-family: "Arial Black", Gadget, sans-serif;
		color: #00F;
		padding: 5px;
	}

	.alert
	{
		padding: 10px;
		width: 400px;
		margin: auto;
		background-color: #00F;
		color: #FFF;
		border-radius: 10px;
		font-size: 20px;
		font-family: "Arial Black", Gadget, sans-serif;
		bottom: 100px;
		left: 20%;
	}
	
	.closebtn:hover
	{
		color: black;
	}

	#giveStudents
	{
		bottom: 250px;
		left: 325px;
		color:#FFF;
		background-color:#00F;
		width: 225px;
		height:100px;
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
            <a class="w3-xxlarge" id="Title">Maths Website</a>
            <a href="Search_Topics.php?student=<?php echo($_SESSION['student']) ?>"
            	class="
            	w3-bar-item
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
    <h1>
    	<?php echo($eduStage); ?> > <?php echo $_SESSION["topic"];?> > <?php echo $_SESSION["subtopic"];?>
    </h1>
    <h2>Questions</h2>

    <!-- Each button from 1-5 will lead to question when clicked. -->
    <div style="top: 80px; padding: 5px;">
    	<a href="Questions.php?qNum=1">
    		<button style="margin-right:100px;">
    			1
    		</button>
    	</a>
        <a href="Questions.php?qNum=2">
        	<button style="margin-right:100px;">
        		2
        	</button>
        </a>
        <a href="Questions.php?qNum=3">
        	<button style="margin-right:100px;">
        		3
        	</button>
        </a>
        <a href="Questions.php?qNum=4">
        	<button style="margin-right:50px;">
        		4
        	</button>
        </a>
        <a href="Questions.php?qNum=5">
        	<button style="margin-left:50px;">
        		5
        	</button>
        </a>
    </div>
    <div style="top:100px; padding:0px;">

    	<!-- On each question there will be a different question
    	depending on the number button clicked that will have a 
    	textarea to enter the answer and check button to check
    	if the user is correct by the website comparing the
    	user's answer to the real answer. -->
    	<form action="answerCheck.php" method="post">
			<p><?php echo ($q); ?></p>
        	<textarea name="answer" rows="10" cols="60"></textarea>
        	<button style="bottom: 50px;" type="submit">Check</button>
    	</form>

    	<!-- In homework section this button would display on the page. -->
        <button id="set">
        	<a href="SetHmwkSingle.php?q=<?php echo($q); ?>&qNum=$qNum">
        		Set
        	</a>
        </button>
        <br>
        <!-- Loads the Setting homework page. -->
        <button id="giveStudents">
        	<a href="SetHmwkPage.php">
        		Give students homework
        	</a>
        </button>

        <i id="tick"
        class="fas fa-check-circle fa-3x w3-text-blue"
        style="
        bottom: 400px;
        left: 450px;
        border-radius: 50px;
        display: none;"></i>
    </div>
    <div class="alert">
		<span class="closebtn">
			&times;
		</span>
		This Answer is incorrect!
	</div>
</body>
<script>
	// Stores the query name and value in the page URL.
	var urlResult = window.location.search;
	var ans = urlResult.slice(urlResult.lastIndexOf("=") + 1); // Only store query value.
	// Stores value for the session homework checker.
	var hmwk = "<?php echo $_SESSION['hmwk']; ?>";

	/* If the answer is wrong then the appear to say your wrong
	otherwise your correct the answer is correct and
	in homework section it will display the tick symbol. */
	if (ans == "False")
	{
		document.getElementsByClassName('alert')[0].style.display = "block";
	}
	else if (ans == "True")
	{
		document.getElementsByClassName('alert')[0].style.display = "block";
		document.getElementsByClassName('alert')[0].innerHTML = "This Answer is correct!";
	}
	else if(ans == "Set")
	{
		document.getElementById("tick").style.display = "block";
		document.getElementsByClassName('alert')[0].style.display = "none";
	}
	else
	{
		document.getElementsByClassName('alert')[0].style.display = "none";
	}

	/* In the homework section, the set and give students homework
	buttons would appear. */
	if (hmwk == "False")
	{
		document.getElementById("set").style.display = "none";
		document.getElementById("giveStudents").style.display = "none";
	}

	var close = document.getElementsByClassName("closebtn");
	var i;
	for (i = 0; i < close.length; i++)
	{
		close[i].onclick = function()
		{
			var div = this.parentElement;
			div.style.opacity = "0";
			setTimeout(function(){ div.style.display = "none"; }, 600);
    	}	
	}

</script>
</html>
