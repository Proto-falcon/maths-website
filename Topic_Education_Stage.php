<?php
    /*Allows the current file to use variables
    from other files with sessions.*/
    session_start();
    $_SESSION["hmwkQ"] = "";
    $_SESSION["hmwkAns"] = "";
    $_SESSION["hmwk"] = $_GET["homework"];
?>

<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Topic Education stage</title>
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
        margin: auto;
    }

    button
	{
		color: #00F;
		font-size: 64px;
		border-radius: 5px;
        font-family: "Arial Black", Gadget, sans-serif;
        padding: 30px;
	}

    #GCSE
    {
        top: 100px;
    }

    #Alevel
    {
        top: 150px;
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
    <h1 id="title">insert</h1>

    <!-- This button will lead to the topics page
    with only GCSE topics. -->
    <div>
        <a href="Topics_page.php?eduStage=GCSE">
            <button id="GCSE">
                GCSE
            </button>
        </a>
    </div>

    <!-- This button will lead to the topics page
    with A level and GCSE topics. -->
    <a href="Topics_page.php?eduStage=Alvl">
        <button id="Alevel">
            A Level
        </button>
    </a>
</body>

<script>
    var urlResult =window.location.search;
    var hmwk = urlResult.slice(urlResult.indexOf("=") + 1);
    if (hmwk != "True")
    {
        document.getElementById('title').innerHTML = 
        "Education Stage";
        document.getElementById("title").style.width = "400px";
    }
    else
    {
        document.getElementById('title').innerHTML = 
        "Homework > Education Stage";
        document.getElementById("title").style.width = "1200px";
    }
</script>

</html>