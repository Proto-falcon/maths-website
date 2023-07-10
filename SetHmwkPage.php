<?php
	/* Allows the current file to access variables
    from other pages of the website */
    session_start();

	// Allows the current file to access from variables from DBH.php
	include_once "DBH.php";
?>

<!DOCTYPE html>
<html>
<head>
	<title>Set Homework Page 1</title>
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
    <p style="margin: auto; top: 50px;">Classes</p>
    <?php
        /* Send an SQL query to the database to fetch all the student accounts
        that have the teacher's username then store how many their are. */
        $classes = [];
        $username = $_SESSION["username"];
        $sql = "SELECT * FROM studentaccounts WHERE username = '$username';";
        $resultClasses = mysqli_query($conn, $sql);
        $numRows = mysqli_num_rows($resultClasses);

        /* Iterateres through all the teacher's students' accounts
        to display all the class buttons available on the 
        webpage. */
        while ($row = mysqli_fetch_assoc($resultClasses))
        {
            /* Checks whether there are any classes in the
            $classes variable to display the first class the first
            student has on the webpage. */
            if (sizeof($classes) < 1)
            {
                array_push($classes, $row["class"]);
                ?>
                <button style="
                top: 60px;
                width: 300px;
                border: 2px solid #000;"
                id="0">
                    <a href="SetHmwkPage2.php?class=<?php echo($row['class']); ?>">
                        <?php echo ($row["class"]); ?>                  
                    </a>
                </button>
                <?php
            }
                    
            /* This compares all the possible classes checked
            so far to display unique class buttons. */
            else
            {
                $i = 0;
                while ($i < sizeof($classes))
                {
                    if ($row["class"] != $classes[$i])
                    {
                        array_push($classes, $row["class"]);
                        ?>
                        <button style="
                        width: 300px;
                        border-bottom: 2px solid #000;
                        border-left: 2px solid #000;
                        border-right: 2px solid #000;"
                        id="<?php echo ($i); ?>">
                            <a href="SetHmwkPage2.php?class=<?php echo($row['class']); ?>">
                                <?php echo ($row["class"]); ?>                        
                            </a>
                        </button>
                        <?php
                        break 1;
                    }
                    $i = $i + 1;

                }
            }
        }
    ?>

</body>

</html>