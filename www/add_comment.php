
<!-- Select movie part -->
<?php
    $db = new mysqli('localhost', 'cs143', '', 'CS143');
    if($db->connect_errno > 0){
        die('Unable to connect to database [' . $db->connect_error . ']');
    }

    // sample code for query and display
    $idFromURL = $_GET["id"];
    $movies=$db->query("SELECT id, title, year FROM Movie ORDER BY title ASC") or die(mysqli_error($db));
    $moviesDisplay="";
    while($row = $movies->fetch_array()) {
      $id = $row["id"];
      $title = $row["title"];
      $year = $row["year"];
      if ($idFromURL == $id) {
        $moviesDisplay .= "<option value= " . $id . " selected>" . $title . " (" . $year . ")</option>";
      } else {
        $moviesDisplay .= "<option value= " . $id . ">" . $title . " (" . $year . ")</option>";
      }
    }
    $movies->free();
?>


<!-- Add comment part -->
<?php


    // TODOs
    // Record all user inputs into variables
    // $movie, $name, $rating, $comment

    // TODOs
    // Validation of user inputs
    // Some variables should not be empty based on the schema of the tables.
    // i.e. $movie and $rating should not be empty and if they are empty
    // should print out error message telling the user what is wrong

    // sample code for query
    $queryMC = $db->query("INSERT INTO Review (name, time, mid, rating, comment) VALUES ('$name', now(), '$movie', '$rating', '$comment')") or die(mysqli_error($db));
    echo "Comment Added!<br>";
    echo "<a href=\"movie_info.php?id=" . $movie . "\">Go Back to the Movie</a>";

?>
