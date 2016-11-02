<?php

    $db = new mysqli('localhost', 'cs143', '', 'CS143');
    if($db->connect_errno > 0){
        die('Unable to connect to database [' . $db->connect_error . ']');
    }

    // get the movie id from outside, as seen in the last line of code in add_comment.php
    $id = $_GET["id"];
    echo "$id";
    // sample code for queries
    $movie = $db->query("SELECT title, year, rating, company FROM Movie WHERE id=$id") or die(mysqli_error());
    $directors = $db->query("SELECT D.first, D.last FROM Director D, MovieDirector MD WHERE MD.mid=$id AND MD.did=D.id") or die(mysqli_error());
    $genres = $db->query("SELECT genre FROM MovieGenre WHERE $id=mid") or die(mysqli_error());
    $actors = $db->query("SELECT A.id, A.first, A.last, MA.role FROM Actor A, MovieActor MA WHERE $id=MA.mid AND MA.aid=A.id") or die(mysqli_error());
    $ratings = $db->query("SELECT AVG(rating), COUNT(rating) FROM Review WHERE mid=$id") or die(mysqli_error());
    $reviews = $db->query("SELECT name, rating, time, comment FROM Review WHERE mid=$id ORDER BY time DESC") or die(mysqli_error());


    // TODOs
    // Basic UI to display above data
?>
