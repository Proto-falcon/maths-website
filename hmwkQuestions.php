<?php
	/* Allows the current file to access variables
    from other pages of the website */
	session_start();

	/* Allows current file to use $conn variable
    to link database to website.*/
	include_once 'DBH.php';

	/* Finds the questions in the chosen homework
	within the database
	to be retrieved to the current page. */
	$dbstudentName = $_SESSION["username"];
	$dbhmwkName = $_GET["hmwkN"];
	$sql = "SELECT * FROM homework
	WHERE hmwkName = '$dbhmwkName'
	AND studentName = '$dbstudentName';";
	$result = mysqli_query($conn, $sql);
	$hmwk = mysqli_fetch_assoc($result);
	$questions = explode(", ", $hmwk["questions"]);
	$answers = explode(", ", $hmwk["answers"]);

	/* Removes empty strings at
	the end of questions and
	answers */
	if (end($questions) == "")
	{
		array_pop($questions);
		array_pop($answers);
	}

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
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
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

	/* unvisited link */
    a:link
    {
      text-decoration: none;
    }

    /* visited link */
    a:visited
    {
      text-decoration: none;
    }

    /* mouse over link */
    a:hover
    {
      text-decoration: none;
    }

    /* selected link */
    a:active
    {
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
	<!-- The title will change depending on the homework the
	student selected. -->
    <h1>
    	<?php echo($_GET["hmwkN"])?>
    </h1>
    <h2>Questions</h2>

    <!-- Each button from 1-5 will lead to question when clicked. -->
    <div style="top: 80px; padding: 5px;">
    	<?php
    		$qSize = count($questions);
    		$i = 1;
    		while ($i <= $qSize)
    		{
    			?>
    			<a href="hmwkQuestions.php?qNum=<?php echo($i); ?>&
    				hmwkN=<?php echo($dbhmwkName); ?>">
    				<button style="margin-right:100px;">
    					<?php echo($i); ?>
    				</button>
    			</a>

    			<?php
    			$i = $i + 1;
    		}
    	?>
    </div>
    <div style="top:100px; padding:0px;">

    	<!-- On each question there will be a different question
    	depending on the number button clicked that will have a 
    	textarea to enter the answer and check button to check
    	if the user is correct by the website comparing the
    	user's answer to the real answer. -->
    	<form action="answerCheck.php?hmwk=True&hmwkN=<?php echo($dbhmwkName); ?>"
    		method="post">
			<p><?php echo ($q); ?></p>
        	<textarea name="answer" rows="10" cols="60"></textarea>
        	<button style="bottom: 50px;" type="submit">Check</button>
    	</form>
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
		
	//If the answer right or wrong the alert message will appear depending on the answer.
	if (ans == "False")
	{
		document.getElementsByClassName('alert')[0].style.display = "block";
	}
	else if (ans == "True")
	{
		document.getElementsByClassName('alert')[0].style.display = "block";
		document.getElementsByClassName('alert')[0].innerHTML = "This Answer is correct!";
	}
	else
	{
		document.getElementsByClassName('alert')[0].style.display = "none";
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