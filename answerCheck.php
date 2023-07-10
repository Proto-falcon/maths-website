<?php
include_once 'DBH.php';
session_start();

/* Compares the user's answer to the true answer to see whether
he or she is correct or not. */
$answer = $_POST["answer"];
$qNum = $_SESSION['btnCLicked'];
$hmwkName = $_GET["hmwkN"];
$_SESSION["hmwkN"] = $hmwkName;

/* Stores the correct answer to a list
of correct answers to make sure the
user's score doesn't exceed 5. */
sort($_SESSION["qTrack"]);
$track = $_SESSION["qTrack"][0];
$wRight = 1;
if (isset($track))
{
	foreach ($_SESSION["qTrack"] as $q)
	{
		if ($qNum == $q)
		{
			break;
		}
		else
		{
			$wRight = 0;
		}
	}
}
else
{
	$wRight = 0;
}


// Checks whether form data given was from questions from homework or subtopic.
if (isset($_GET["hmwk"]))
{
	if ($answer == $_SESSION["answer"] and $wRight == 0)
	{
		array_push($_SESSION["qTrack"], $qNum);
		$_SESSION["total"] = $_SESSION["total"] + 1;
		header("Location: hmwkQuestions.php?qNum=$qNum&hmwkN=$hmwkName&answer=True"); 
	}
	else
	{
		header("Location: hmwkQuestions.php?qNum=$qNum&hmwkN=$hmwkName&answer=False");
	}
}
else
{
	if ($answer == $_SESSION["answer"])
	{
		header("Location: Questions.php?qNum=$qNum&answer=True"); 
	}
	else
	{
		header("Location: Questions.php?qNum=$qNum&answer=False");
	}
}