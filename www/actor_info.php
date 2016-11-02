
<!-- Select actor and display data -->
<?php
    $db = new mysqli('localhost', 'cs143', '', 'CS143');
    if($db->connect_errno > 0){
        die('Unable to connect to database [' . $db->connect_error . ']');
    }

    // get the actor id from outside
    $id = $_GET["id"];
    echo "$id";

    $actor = $db->query("SELECT last, first, sex, dob, dod FROM Actor WHERE id=$id") or die(mysqli_error());
    $movies = $db->query("SELECT title FROM Movie WHERE id IN (SELECT mid FROM MovieActor WHERE aid=$id)") or die(mysqli_error());

?>
