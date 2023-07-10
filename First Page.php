<?php
	/* This clears all the variables that
	can be accessed by all the pages in
	the website. */
	session_start();
    session_unset();
    session_destroy();
?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Beginning</title>
</head>
<!-- Contains CSS code that styles elements selected by selectors. -->
<style>
	#Title
	{
		color: #FFF;
		font-size: 64px;
	}
	
	*
	{
		position: relative;
		font-family: "Arial Black", Gadget, sans-serif;
		text-align: center;
	}
	
	body
	{
		background-color: blue;
	}
	
	button
	{
		top: 150px;
		color: #00F;
		font-size: 64px;
		background-color:#FFF; 
		border-radius: 5px;
	}
	
	#student
	{
		margin-right: 100px;
		width: 450px;
	}
	#teacher
	{
		width: 450px;
		margin-left: 100px;
	}
	
</style>
<body>
	<h1 id="Title">Maths Education</h1><!-- This creates the title in the first page -->
    <a href="Student_Login_Page.html">
    <button id="student">I am a student</button>
	</a> <!-- This creates the student button -->
    <a href="Teacher_Account.html">
    <button id="teacher">I am a teacher</button>
	</a> <!-- This creates the teacher button -->
</body>
</html>