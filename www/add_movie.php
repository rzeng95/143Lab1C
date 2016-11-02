<?php
    // Establish connection with mysql

    $db = new mysqli('localhost', 'cs143', '', 'CS143');
    if($db->connect_errno > 0){
        die('Unable to connect to database [' . $db->connect_error . ']');
    }

    // TODOs
    // Record all user inputs into variables
    // $title, $company, $year, $rating, $genre.

    $title = $_GET["title"];
    $company = $_GET["company"];
    $year = $_GET["year"];
    $rating = $_GET["rating"];
    $genres = $_GET["genre"];

    // TODOs
    // Validation of user inputs
    // Some variables should not be empty based on the schema of the tables.
    // i.e. $title and $company should not be empty and if they are empty
    // should print out error message telling the user what is wrong
    

    // Sample code for the queries
    $MIquery = $db->query("INSERT INTO Movie (id, title, year, rating, company) VALUES ('$newMaxID', '$title', '$year', '$rating', '$company')") or die(mysqli_error($db));
		$db->query("UPDATE MaxMovieID SET id=$newMaxID WHERE id=$curMaxID") or die(mysqli_error($db));
		for ($i = 0; $i < count($genres); $i++) {
			$Gquery = $db->query("INSERT INTO MovieGenre (mid, genre) VALUES ('$newMaxID', '$genres[$i]')") or die(mysqli_error($db));
		}
		echo $title . " Added!";
?>
