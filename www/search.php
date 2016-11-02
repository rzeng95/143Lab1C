<?php
    $db = new mysqli('localhost', 'cs143', '', 'CS143');
    if($db->connect_errno > 0){
        die('Unable to connect to database [' . $db->connect_error . ']');
    }

    // get the search from outside, as seen in movie_info.php
    $search = $_GET["search"];
    $search = $db->real_escape_string($search);

    // sample code for query
    $words = explode(' ', $search);
    if (trim($search) == '') {
      // Do Nothing because no search query
    } else {

      // actors
      echo "<h3>Matching Actors</h3>";
      $query = "SELECT id, last, first, dob FROM Actor WHERE (first LIKE '%$words[0]%' OR last LIKE '%$words[0]%')";
      for($i = 1; $i < count($words); $i++) {
        $word = $words[$i];
        $query .= "AND (first LIKE '%$word%' OR last LIKE '%$word%')";
      }
      $query .= "ORDER BY first ASC";
      $actors = $db->query($query) or die(mysqli_error());
      while ($row = $actors->fetch_assoc()) {
        echo "<a href=\"show_actor_info.php?id=" . $row["id"] . "\">" . $row["first"] . " " . $row["last"] . " (" . $row["dob"] . ")</a><br>";
      }
      $actors->free();

      // movies
      echo "<h3>Matching Movies</h3>";
      $query = "SELECT id, title, year FROM Movie WHERE (title LIKE '%$words[0]%') ORDER BY title ASC";
      for($i = 1; $i < count($words); $i++) {
        $word = $words[$i];
        $query .= "AND (title LIKE '%$word%')";
      }
      $query .= "ORDER BY title ASC";
      $movies = $db->query($query) or die(mysqli_error());
      while ($row = $movies->fetch_assoc()) {
        echo "<a href=\"show_movie_info.php?id=" . $row["id"] . "\">" . $row["title"] . " (" . $row["year"] . ")</a><br>";
      }
      $movies->free();
    }
    $db->free();
?>
