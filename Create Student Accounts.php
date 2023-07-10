<?php
	/* Allows the current file to access variables
    from other pages of the website */
	session_start();
?>

<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Create Student Account</title>
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
	
		
	form
	{
		color: #00F;
	}
	
	#username
	{
		top: 50px;
		font-size: 16px;
	}
	
	#password
	{
		top: 90px;
		font-size: 16px;
	}

	#Class
	{
		top: 70px;
		font-size: 16px;
	}

	input
	{
		height:50px;
		width:300px;
		font-size:32px;
	}
	
	button
	{
		color: #00F;
		top: 100px;
		font-size: 36px;
		border-radius: 5px;
	}

	h1
	{
		bottom: 10px;
		margin: auto;
		font-family: "Arial Black", Gadget, sans-serif;
		background-color: #FFF;
		width: 250px;
		padding: 5px;
	}

		.alert
	{
		padding: 20px;
		width: 700px;
		margin: auto;
		background-color: #FFF;
		color: #00F;
		border-radius: 10px;
		font-size: 40px;
		font-family: "Arial Black", Gadget, sans-serif;
		top: 110px;
	}
	
	.closebtn:hover
	{
		color: black;
	}

</style>

<body>
    <div class="w3-bar w3-white">
		<a class="w3-bar-item w3-xlarge">
			<?php echo $_SESSION["username"]; ?>
		</a>

		<!-- This button will be in the navigation bar that leads to the homepage. -->
		<a href="HomePage.php"
		class="
		w3-bar-item 
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

	<!-- This form is where the teacher will enter details to
	create student account by sending the input valus to
	"DBstudentCreate.php" file. -->
	<form action="DBstudentCreate.php" method="post">
		<div id="username">
			<h1>Username:</h1>
			<input type="text" name="studentName">
		</div>
		<div id="Class">
			<h1>Class Name:</h1>
			<input type="text" name="class">
		</div>
		<div id="password">
			<h1>Password:</h1>
			<input type="password" name="studentPwd">
		</div>
		<button>Create</button>
	</form>
	<div class="alert">
		<span class="closebtn">
			&times;
		</span>
		This Account Already Exists!
	</div>
</body>

<script>
	// The variable will store the search name and value in the URL.
	var urlSearch = window.location.search;

	// The variable will store the position of the first character in the search value.
	var pos = urlSearch.indexOf("=") + 1;

	// The variable will store the the search value.
	var urlValue = urlSearch.substr(pos);

	// It will show the alert if if urlValue equals "True" otherwise it will won't show the alert.
	if (urlValue == "True")
	{
		document.getElementsByClassName('alert')[0].style.display = "block";
	}
	else
	{
		document.getElementsByClassName('alert')[0].style.display = "none";
	}

	// The variable will store all the attributes and values of the alert.
	var close = document.getElementsByClassName("closebtn");
	var i;
	// In the for loop, if the user clicks the close button on the alert then the alert will close.
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
