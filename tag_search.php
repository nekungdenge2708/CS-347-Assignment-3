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
				</ul>
			</nav>
		</header>
		
		<section id = "search">
			<form id="Search_Bar" action="tag_search.php" method="get">
				<label for="search box"> Enter a type of food: </label>
				<input id="search box" type="text" name="tag" placeholder="search">
				<input type="submit" value="Submit">
			</form>
			<?php
				include ("./databaseClass.php");
				$db = new database();
				$db->connect();
				
				echo "<BR>";
				 
				 if(isset($_GET["tag"]) && !empty($_GET["tag"])) 
				{ 
					$tag = addslashes(strip_tags($_GET["tag"]));
					echo '<h1 id="Search_Header">Your search: </h1>';
					echo '<p id="Entry">'.$tag.'</h2>';
					
					$query = "SELECT * FROM food WHERE tag = '".$tag."'";
					$result = $db->send_sql($query);
					
					echo '<h2 id="Search_Results">Search results:</h1>';
					
					$db->disconnect();
					
					$arr = [];
					while($row = $result->fetch_assoc()) {
						array_push($arr, $row);  
						echo '<a href="display.php?food="'.($row["food_name"]).'">'.($row["food_name"]).'</a>';
					}
					
					if(count($arr) === 0)
						echo("No foods with tag '".$tag."'");
					
				}
				
				$db->disconnect();
			?>
		</section>
	</body>
</html>
