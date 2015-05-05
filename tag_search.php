<!DOCTYPE html>
<html lang=“en=US”>
	<head>
		<meta charset=“utf-8” />
		<title>Soduckso</title>
		<link rel="stylesheet" type="text/css" href="header.css"/>
	</head>
	
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
		
		<section id="Search_Bar">
			<form action="tag_search.php" method="get">
				<label for="search box"> Enter a type of food: </label>
				<input id="search box" type="text" name="tag" placeholder="search">
				<input type="submit" value="Submit">
			</form>
		</section>
	</body>
</html>

<?php
    include ("./databaseClass.php");
    $db = new database();
    $db->connect();
    
    echo "<BR>";
     
     if(isset($_GET["tag"]) && !empty($_GET["tag"])) 
	{ 
		$tag = addslashes(strip_tags($_GET["tag"]));
		echo "<h1>".$tag."</h1>\n";
		
		$query = "SELECT * FROM food WHERE tag = '".$tag."'";
		$result = $db->send_sql($query);
		
		$arr = [];
		while($row = $result->fetch_assoc()) {
			array_push($arr, $row);  
			echo ($row["food_name"]."<BR>");
		}
		
		if(count($arr) === 0)
			echo("No foods with tag '".$tag."'");
		
	}
    
    $db->disconnect();
?>