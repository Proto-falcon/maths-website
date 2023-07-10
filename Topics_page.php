<?php
    /*Allows the current file to use variables
    from other files with sessions.*/
    session_start();

    /* Lets the pages in the topic section after 
    education stage page to display different titles
    depending on the buttons clicked. */
    $_SESSION["eduStage"] = $_GET["eduStage"];
?>

<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Topics page</title>
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
		width: 143mm;
		font-family: "Arial Black", Gadget, sans-serif;
		color: #00F;
		border: 2px solid #000;
	}

	button
	{
		color: #00F;
		font-size: 50px;
		background-color:#FFF; 
		font-family: "Arial Black", Gadget, sans-serif;
        width: 143mm;
        top: 50px;
        border: 2px solid #000;
	}
    
    #Topics
    {
        margin-left: 6px;
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
    <div>
        <h1> Education Stage > Topics</h1>
    </div>
    
    <!-- Each topic button will lead to the subtopics button that only
     displays subtopics in that selected topic -->
    <div id="Topics">
        <a href="Subtopics.php?topic=al"><button>Algebra</button></a>
        <br>
        <a href="Subtopics.php?topic=geo"><button>Geometry</button></a>
        <br>
        <a href="Subtopics.php?topic=num"><button>Number</button></a>
        <br>
        <a href="Subtopics.php?topic=prob"><button>Probabiltiy</button></a>
        <br>
        <a href="Subtopics.php?topic=stat"><button>Statistics</button></a>
        <br>
        <a href="Subtopics.php?topic=ratio"><button>Ratio</button></a>
        <br>
        <a href="Subtopics.php?topic=trig" id="Alevel1"><button>Trigonometry</button></a>
        <br>
        <a href="Subtopics.php?topic=cal" id="Alevel2"><button>Calculus</button></a>
        <br>
    </div>

</body>
<script>

    /* Displays A level topics if the search value
    in the URL isn't GCSE and changes title. */
    var urlResult =window.location.search;
    var gcse = urlResult.slice(urlResult.indexOf("=") + 1);
    if (gcse == "GCSE")
    {
        document.getElementsByTagName('h1')[0].innerHTML = "GCSE > Topics";
        document.getElementById("Alevel1").style.display = "none";
        document.getElementById("Alevel2").style.display = "none";
    }
    else
    {
        document.getElementsByTagName('h1')[0].innerHTML = "A level > Topics";
    }
</script>
</html>