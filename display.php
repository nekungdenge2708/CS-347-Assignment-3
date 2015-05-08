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
		<!-- couldn't get the hyperlinks to work properly for all the food items. data would not send over when using the href. 
		for now, when clicking the hyperlinks, you will be forwarded to the display.php page but you need to reenter the value you selected originally
		into the search bar to see the details-->
			<form id="Search_Bar" action="display.php" method="get">
				<label for="search box"> Please type the name of the food your selected here: </label>
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
					
					$query = "SELECT * FROM food WHERE food_name = '".$food."'";
					$result = $db->send_sql($query);
					
					$arr = [];
					while($row = $result->fetch_assoc()) {
						array_push($arr, $row);  
						echo '<p>Name: '.($row["food_name"]).'</p> <BR>';
						if(($row["serving_date"])!= "0000-00-00")
						{
							echo '<p>Serving Date: '.($row["serving_date"]).'</p> <BR>';
						}
						if(!empty($row["serving_day"]))
						{
							echo '<p>Serving Day: '.($row["serving_day"]).'</p> <BR>';
						}
						echo '<p>Serving Time: '.($row["serving_time"]).'</p> <BR>';
						echo '<p>Description: '.($row["description"]).'</p> <BR>';
						echo '<p>Rating: '.($row["rating"]).'</p>';
						
						echo '<form id="Rating" action="display.php" method="get"> <label for="rate"> How would you rate '.($row["food_name"]).'?   </label> <input id="rate" type="text" name="rating" placeholder="Enter Number from 1-5"> <input type="submit" value="Submit"> </form>';
					}
					
				}
								
				
				$db->disconnect();
			?>
			<!-- couldnt get the comment system working fully enough to have it update the database due to improper time management.-->

		</section>
	</body>
</html>