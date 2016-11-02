
<!-- Select movie and actor part -->
<?php
    $db = new mysqli('localhost', 'cs143', '', 'CS143');
    if($db->connect_errno > 0){
      die('Unable to connect to database [' . $db->connect_error . ']');
    }

    // sample code for queries and displaying the data
    $movies = $db->query("SELECT id, title, year FROM Movie ORDER BY title ASC") or die(mysqli_error($db));
    $actors = $db->query("SELECT id, first, last, dob FROM Actor ORDER BY first ASC") or die(mysqli_error($db));
    $moviesDisplay="";
    $actorsDisplay="";

    while($row = $movies->fetch_array()) {
      $id = $row["id"];
      $title = $row["title"];
      $year = $row["year"];
      $moviesDisplay .= "<option value= " . $id . ">" . $title . " (" . $year . ")</option>";
    }
    while($row = $actors->fetch_array()){
      $id = $row["id"];
      $first = $row["first"];
      $last = $row["last"];
      $dob = $row["dob"];
      $actorsDisplay .= "<option value= " . $id . ">" . $first . " " . $last . " (" . $dob . ")</option>";
    }
    $movies->free();
    $actors->free();
?>


<!-- Form relation part -->
<?php

    // TODOs
    // Record user selection of movie and actor and user input of role into variables
    // $movie, $actor, $role

    // TODOs
    // Validation of user inputs
    // Some variables should not be empty based on the shema of the tables.
    // i.e. $movie, $actor and $roleshould not be empty and if they are empty
    // should print out error message telling the user what is wrong

    // sample code for queries
    $insert_query = $db->query("INSERT INTO MovieActor (mid, aid, role) VALUES ('$movieID', '$actorID', '$role')") or die(mysqli_error($db));
    $movie = $db->query("SELECT title FROM Movie WHERE id = '$movieID'") or die(mysqli_error($db));
    $actor = $db->query("SELECT title FROM Actor WHERE id = '$actorID'") or die(mysqli_error($db));
    $movieArr = $movie->fetch_array();
    $actorArr = $actor->fetch_array();
    echo "(" . $movieArr["title"] . ", " . $actorArr["first"] . " " . $actorArr["last"] . ") Pair Added!";

?>
