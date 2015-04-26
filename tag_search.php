<!DOCTYPE html>
<html lang=“en=US”>
	<head>
		<meta charset=“utf-8” />
		<title>Soduckso</title>
	</head>
	
	<body>
		<header>
			<h1>Soduckso </h1>
		
			<nav>
				<a href = "food.php">Home</a> 
				<a href = "tag search.php">Advanced Search</a>
				<a href = '#'>Calendar</a> 
			</nav>
		</header>
		
		<form action="tag_search.php" method="get">
			<label for="search box"> Enter a type of food: </label>
			<input id="search box" type="text" name="tag" placeholder="search">
			<input type="submit" value="Submit">
		</form>
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