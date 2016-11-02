
<!-- Select actor and display data -->
<?php
    $db = new mysqli('localhost', 'cs143', '', 'CS143');
    if($db->connect_errno > 0){
        die('Unable to connect to database [' . $db->connect_error . ']');
    }

    // get the actor id from outside
    $id = $_GET["id"];
    if ($id == '') {
?>
    <!-- if id is empty then get the movie id from user selection -->
    <label for="search">Search for Actor Information:</label>
    <form class="form-group" action="search.php" method ="GET">
      <input type="text" id="search" placeholder="Search for Actor Information" name="search"><br>
      <input type="submit" value="Search!" class="btn btn-default"><br>
    </form>

<?php
    } else {
        // sample code for queries
        $actor = $db->query("SELECT last, first, sex, dob, dod FROM Actor WHERE id=$id") or die(mysqli_error());
        $movies = $db->query("SELECT title FROM Movie WHERE id IN (SELECT mid FROM MovieActor WHERE aid=$id)") or die(mysqli_error());
    }
?>
