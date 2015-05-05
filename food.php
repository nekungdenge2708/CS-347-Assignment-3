<!DOCTYPE html>
<html lang=“en=US”>
	<head>
		<meta charset=“utf-8” />
		<title>Soduckso</title>
		<link rel="stylesheet" type="text/css" href="header.css"/>
	</head>
	
	<body>
		<body>
		<header id="Navigation_Banner">
			<img id="logo" src="logo_stevens.gif" alt="Stevens Duck"/>
			<h1>Soduckso </h1>
		
			<nav>
				<ul>
					<li>
						<a href = "food.php">Home</a> 
					</li>
					<li>
						<a href = "tag_search.php">Advanced Search</a>
					</li>
					<li>
						<a href = '#'>Calendar</a> 
					</li>
				</ul>
			</nav>
		</header>
		
		<form action="food.php" method="get">
			<label for="search box"> What would you like to eat? </label>
			<input id="search box" type="text" name="food" placeholder="search">
			<input type="submit" value="Submit">
		</form>
	</body>
</html>

<?php
    include ("./databaseClass.php");
    $db = new database();
    $db->connect();
    
    echo "<BR>";
     
     if(isset($_GET["food"]) && !empty($_GET["food"])) 
	{ 
		$food = addslashes(strip_tags($_GET["food"]));
		echo "<h1>".$food."</h1>\n";
		
		$query = "SELECT * FROM food WHERE food_name = '".$food."'";
		$result = $db->send_sql($query);
		
		$arr = [];
		while($row = $result->fetch_assoc()) {
			array_push($arr, $row);  
			echo ($row["food_name"]."<BR>");
		}
		
		if(count($arr) === 0)
			echo("No foods with tag '".$food."'");
		
	}
    
    $db->disconnect();
?>