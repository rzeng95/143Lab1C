
<!-- Select movie and actor part -->
<?php
    $db = new mysqli('localhost', 'cs143', '', 'CS143');
    if($db->connect_errno > 0){
      die('Unable to connect to database [' . $db->connect_error . ']');
    }

    // sample code for queries and displaying the data
    $movies=$db->query("SELECT id, title, year FROM Movie ORDER BY title ASC") or die(mysqli_error($db));
    $directors=$db->query("SELECT id, first, last, dob FROM Director ORDER BY first ASC") or die(mysqli_error($db));
    $moviesDisplay="";
    $directorsDisplay="";
    while($row = $movies->fetch_array()) {
      $id = $row["id"];
      $title = $row["title"];
      $year = $row["year"];
      $moviesDisplay .= "<option value= " . $id . ">" . $title . " (" . $year . ")</option>";
    }
    while($row = $directors->fetch_array()) {
        $id = $row["id"];
        $first = $row["first"];
        $last = $row["last"];
        $dob = $row["dob"];
        $directorsDisplay .= "<option value= " . $id . ">" . $first . " " . $last . " (" . $dob . ")</option>";
      }
    $movies->free();
    $directors->free();
?>


<!-- Form relation part -->
<?php

    // TODOs
    // Record user selection of movie and director and user input of role into variables
    // $movie, $director, $role

    // TODOs
    // Validation of user inputs
    // Some variables should not be empty based on the shema of the tables.
    // i.e. $movie, $director and $roleshould not be empty and if they are empty
    // should print out error message telling the user what is wrong

    // sample code for queries
    $insert_query = $db->query("INSERT INTO MovieDirector (mid, did) VALUES ('$movieID', '$directorID')") or die(mysqli_error($db));
    $movie = $db->query("SELECT title FROM Movie WHERE id = '$movieID'") or die(mysqli_error($db));
    $director = $db->query("SELECT first, last FROM Director WHERE id = '$directorID'") or die(mysqli_error($db));
    $movieArr = $movie->fetch_array();
    $directorArr = $director->fetch_array();
    echo "(" . $movieArr["title"] . ", " . $directorArr["first"] . " " . $directorArr["last"] . ") Pair Added!";

?>
