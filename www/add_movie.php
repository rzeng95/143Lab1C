<?php
    // Establish connection with mysql

    $db = new mysqli('localhost', 'cs143', '', 'CS143');
    if($db->connect_errno > 0){
        die('Unable to connect to database [' . $db->connect_error . ']');
    }

    // Record all user inputs into variables
    // $title, $company, $year, $rating, $genre.

    $title = $_GET["title"];
    $company = $_GET["company"];
    $year = $_GET["year"];
    $rating = $_GET["rating"];
    $genres = $_GET["genre"];


    // Validation of user inputs
    // Some variables should not be empty based on the schema of the tables.
    // i.e. $title and $company should not be empty and if they are empty
    // should print out error message telling the user what is wrong
    if ($title == "" && $company == "" && $year == "" && $rating == "" && count($genres) == 0) {
      echo "Please provide enough information about the movie.";
    }
    elseif ($title == "") {
      echo "Please provide the title of the movie.";
    }
    elseif ($year == "") {
      echo "Please provide the year of the movie.";
    }

    else {
      $maxId = $db->query("SELECT MAX(id) FROM MaxMovieID") or die(mysqli_error($db));

      $maxIdArr = mysqli_fetch_array($maxId);
      $cur = $maxIdArr[0];
      $new = $cur + 1;

      $newMovie = $db->query("INSERT INTO Movie (id, title, year, rating, company) VALUES ('$new', '$title', '$year', '$rating', '$company')") or die(mysqli_error($db));
  		$db->query("UPDATE MaxMovieID SET id=$new WHERE id=$cur") or die(mysqli_error($db));
  		for ($i = 0; $i < count($genres); $i++) {

  			$genre = $db->query("INSERT INTO MovieGenre (mid, genre) VALUES ('$new', '$genres[$i]')") or die(mysqli_error($db));
  		}
  		echo $title . " Added!";
    }

    $maxId->free();
    $newMovie->free();
    $genre->free();
    $db->close();


?>
