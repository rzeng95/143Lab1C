<?php

    // $db = new mysqli('localhost', 'cs143', '', 'CS143');
    // if($db->connect_errno > 0){
    //     die('Unable to connect to database [' . $db->connect_error . ']');
    // }
    //
    // // get the movie id from outside, as seen in the last line of code in add_comment.php
    // $id = $_GET["id"];
    // echo "$id";
    // // sample code for queries
    // $movie = $db->query("SELECT title, year, rating, company FROM Movie WHERE id=$id") or die(mysqli_error());
    // $directors = $db->query("SELECT D.first, D.last FROM Director D, MovieDirector MD WHERE MD.mid=$id AND MD.did=D.id") or die(mysqli_error());
    // $genres = $db->query("SELECT genre FROM MovieGenre WHERE $id=mid") or die(mysqli_error());
    // $actors = $db->query("SELECT A.id, A.first, A.last, MA.role FROM Actor A, MovieActor MA WHERE $id=MA.mid AND MA.aid=A.id") or die(mysqli_error());
    // $ratings = $db->query("SELECT AVG(rating), COUNT(rating) FROM Review WHERE mid=$id") or die(mysqli_error());
    // $reviews = $db->query("SELECT name, rating, time, comment FROM Review WHERE mid=$id ORDER BY time DESC") or die(mysqli_error());


    // TODOs
    // Basic UI to display above data
?>

<!DOCTYPE html>
<html>

<head>
    <title>BMDb</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="styles/bootstrap/bootstrap.min.css" >
    <link rel="stylesheet" type="text/css" href="styles/main.css" >

</head>


<body>

<div class="container">
    <div id="with-filler">


    <div class="navbar navbar-default" style="background-color:#536889;color:#f2d326;min-height:80px;border-radius:0;">
        <div class="col-xs-5 col-md-5">
            <img src="assets/bruin.png" width=55 height=55 style="float:left; margin-right:10px;margin-top:13px;">
            <h1><a href="index.php">Bruin Movie Database</a></h1>

        </div>
        <div class="col-xs-2 col-md-2">
            <h4 style="padding-top:24px;padding-left:50px;"><a href="contribute.php">Contribute!</a></h4>
        </div>
        <div class="col-xs-5 col-md-5">
        <form class="navbar-form navbar-right" style="padding-top:15px" method="get" action="index.php">
            <div class="form-group">
                <input name="search" type="text" class="form-control" style="border-radius:0;" placeholder="Find Movies and Actors...">
            </div>

            <select class="form-control" style="border-radius:0;" name="type">
                <option select="selected" value="all">All</option>
                <option value="actors">Actors</option>
                <option value="movies">Movies</option>
            </select>

            <button type="submit" class="btn btn-default" style="border-radius:0;">
                <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
            </button>
        </form>
        </div>
    </div>

    <div id="scroll-list">

    <?php
        $mid = $_GET['id'];
        $db = new mysqli('localhost', 'cs143', '', 'CS143');
        if($db->connect_errno > 0){
            die('Unable to connect to database [' . $db->connect_error . ']');
        }

        if ($mid == "") {
            echo "<h4>Blank search detected: use the search bar above!</h4>";
        } else {
            $actor = $db->query("SELECT id, title, year, rating, company FROM Movie WHERE id='$mid'") or die(mysqli_error());
            $row = $actor->fetch_assoc();

            $id = $row["id"];
            $title = $row["title"];
            $year = $row["year"];
            $rating = $row["rating"];
            $company = $row["company"];


            echo "<h3>Movie Information:</h3>";
            echo "
            <h4><b>Title: $title</b></h4>
            <h5>Year: $year </h5>
            <h5>MPAA Rating: $rating </h5>
            <h5>Producer: $company </h5>
            <h5>Year: $year </h5>
            <h5>Director: $director</h5>
            <h5>Genre(s): $genres</h5>
            ";

            echo "<h3>Actors in this Movie:</h3>";
        }

    ?>
    </div>


    </div>

</div>


</body>

</html>


<!-- Select actor and display data -->
<?php
    // $db = new mysqli('localhost', 'cs143', '', 'CS143');
    // if($db->connect_errno > 0){
    //     die('Unable to connect to database [' . $db->connect_error . ']');
    // }
    //
    // // get the actor id from outside
    // $id = $_GET["id"];
    //
    // $actor = $db->query("SELECT last, first, sex, dob, dod FROM Actor WHERE id=$id") or die(mysqli_error());
    // $movies = $db->query("SELECT title FROM Movie WHERE id IN (SELECT mid FROM MovieActor WHERE aid=$id)") or die(mysqli_error());
    //
    //

    // TODOs
    // Basic UI to display above data
?>
