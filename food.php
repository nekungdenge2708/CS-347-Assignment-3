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
		
		<section id="search">
			<form id="Search_Bar" action="food.php" method="get">
				<label for="search box"> What would you like to eat? </label>
				<input id="search box" type="text" name="food" placeholder="search">
				<input type="submit" value="Submit">
			</form>
			<?php
				include ("./databaseClass.php");
				$db = new database();
				$db->connect();
				
				echo "<BR>";
				 
				 if(isset($_GET["food"]) && !empty($_GET["food"])) 
				{ 
					$food = addslashes(strip_tags($_GET["food"]));
					echo '<h1 id="Search_Header">Your search: </h1>';
					echo '<p id="Entry">'.$food.'</h2>';
					
					$query = "SELECT * FROM food WHERE food_name = '".$food."'";
					$result = $db->send_sql($query);
					
					echo '<h2 id="Search_Results">Search results:</h1>';
					
					$arr = [];
					while($row = $result->fetch_assoc()) {
						array_push($arr, $row);  
						echo '<a href="display.php">'.$food.'</a>';
					}
					
					if(count($arr) === 0)
						echo("No foods with name '".$food."'");
					
				}
				
				$db->disconnect();
			?>
		</section>
	</body>
</html>