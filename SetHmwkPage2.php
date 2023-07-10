<?php
	/* Allows the current file to access variables
    from other pages of the website */
    session_start();

    /* Allows the file sending homework
    made by the teacher to the database.*/
    $_SESSION["class"] = $_GET["class"];
?>

<!DOCTYPE html>
<html>
<head>
	<title>Set Homework Page 2</title>
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

	p
    {
        color: #00F;
        font-family: "Arial Black", Gadget, sans-serif;
        background-color: #FFF;
        width: 300px;
        padding: 5px;
        font-size: 32px;
    }

    select
    {
        bottom: 60px;
        margin-left: 10%;
        font-size: 32px;
        height:50px;
		width:300px;
    }

    button
	{
		color: #00F;
		font-size: 32px;
		border-radius: 5px;
        font-family: "Arial Black", Gadget, sans-serif;
        padding: 20px;
        bottom: 150px;
        margin: auto;
	}

	input
	{
		height:50px;
		width:300px;
		font-size:32px;
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

    <!-- Sends the user data for homework name and due date to another file
    to send them to the database with questions and answers, classes that are given. -->
    <form action="GivehmwkStudents.php" method="POST">
    	<p style="margin-left: 10%;"> Name of Homework</p>
    	<input style="margin-right: 60.5%; top: 19px;" type="text" name="hmwkName">

    	<p style="margin: auto; bottom: 170px;">Due Date</p>
    	<div><input style="margin: auto; bottom: 100px;" type="date" name="dueDate"></div>

        <button style="margin-left: 60%; bottom: 225px;">Send</button>
    </form>
</body>

</html>