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

        $db = new mysqli('localhost', 'cs143', '', 'CS143');
        if($db->connect_errno > 0){
            die('Unable to connect to database [' . $db->connect_error . ']');
        }

        // update comment
        $comment_name = $_GET["comment-name"];
        $comment_rating = $_GET["comment-rating"];
        $comment = $_GET["comment"];
        $comment_mid = $_GET["comment_mid"];

        if ($comment_name == "") {
            $comment_name = "Anonymous";
        } elseif ($comment == "") {
            $comment = "N/A";
        }

        if($comment_mid != ""){
            $mid = $comment_mid;
            $newReview = $db->query("INSERT INTO Review (name, time, mid, rating, comment) VALUES ('$comment_name',NULL, '$comment_mid','$comment_rating','$comment')") OR die(mysqli_error($db));
            echo "<h4> Thank you for your contribution! </h4>";
        }



        if($mid == ""){
            $mid = $_GET['id'];
        }

        if ($mid == "") {
            echo "<h4>Blank search detected: use the search bar above!</h4>";
        } else {

            $movie = $db->query("SELECT id, title, year, rating, company FROM Movie WHERE id='$mid'") or die(mysqli_error($db));
            $actors = $db->query("SELECT A.id, CONCAT(A.first,' ',A.last), MA.role FROM Actor A, MovieActor MA WHERE $mid=MA.mid AND MA.aid=A.id") or die(mysqli_error($db));
            $director = $db->query("SELECT CONCAT(D.first,' ',D.last) FROM Director D, MovieDirector MD WHERE MD.mid=$mid AND MD.did=D.id") or die(mysqli_error($db));
            $genres = $db->query("SELECT genre FROM MovieGenre WHERE $mid=mid") or die(mysqli_error($db));
            $reviews = $db->query("SELECT name, rating, time, comment FROM Review WHERE mid=$mid ORDER BY time DESC") or die(mysqli_error($db));
            $row = $movie->fetch_assoc();
            // $rowd = $director->fetch_assoc();

            $id = $row["id"];
            $title = $row["title"];
            $year = $row["year"];
            $rating = $row["rating"];
            $company = $row["company"];


            if($rating == "") {
              $rating = "N\A";
            }
            if($company == "") {
              $company = "N\A";
            }

            echo "<h3>Movie Information:</h3>";
            echo "
            <h4><b>Title: $title</b></h4>
            <h5>Year: $year </h5>
            <h5>MPAA Rating: $rating </h5>
            <h5>Producer: $company </h5>
            <h5>Director:
            ";

            $isDirEmpty = true;
            while ($row = $director->fetch_array()) {
              $isDirEmpty = false;
              echo $row["CONCAT(D.first,' ',D.last)"];
              echo " ";
            }

            if($isDirEmpty) {
              echo "N\A";
            }
            echo "</h5>";

            echo "<h5>Genre(s): ";
            $isgenEmpty = true;
            while ($row = $genres->fetch_array()) {
              $isgenEmpty = false;
              echo $row["genre"];
              echo " ";
            }

            if($isgenEmpty) {
              echo "N\A";
            }
            echo "</h5>";

            echo "<br>";
            echo "<br>";
            echo "<h4><strong>Cast members:</strong></h4>";
            $finfo = $actors->fetch_fields();
            $tableHeader = "<tr>";
            foreach($finfo as $val) {
                $tmp = $val->name;
                if ($tmp == 'CONCAT(A.first,\' \',A.last)') {
                    $tableHeader = $tableHeader."<th>Name</th>";
                } elseif ($tmp == 'role') {
                    $tableHeader = $tableHeader."<th>Role</th>";
                } elseif ($tmp == 'id') {
                  continue;
                }
                // $tableHeader = $tableHeader."<th>".$tmp."</th>";
            }
            $tableHeader = $tableHeader . "</tr>";
            unset($val);

            $tableBody = "";

            while($row = $actors->fetch_assoc()) {
                $tableRow = "<tr>";
                // $tableRow = $tableRow."<td>".$row["id"]."</td>";
                $tableRow = $tableRow."<td>"."<a href=\"actor_info.php?id=" . $row["id"] . "\">". $row["CONCAT(A.first,' ',A.last)"] . "</a>"."</td>";
                $tableRow = $tableRow."<td>".$row["role"]."</td>";
                $tableRow = $tableRow . "</tr>";

                $tableBody = "{$tableBody}{$tableRow}";
                unset($val);
                unset($tableRow);
            }


            $movie->free();
            $actors -> free();
            $director->free();
            $genres->free();
            $reviews->free();


            echo '
            <div class="row">
                <div class="col-sm-12">
                    <table class="table table-bordered table-striped">
                                <thead>
                                    '.$tableHeader.'
                                </thead>
                                <tbody>
                                    '.$tableBody.'
                                </tbody>
                    </table>
                </div>
            </div>
            ';



            // Review Section
            echo "<br>";
            echo "<h4><strong>Average rating:</strong></h4>";

            $avgRating = $db->query("SELECT AVG(rating) FROM Review WHERE mid=$mid") or die(mysqli_error($db));
            // echo $avgRating;
            $avg = $avgRating->fetch_assoc();
            $rating = $avg["AVG(rating)"];
            if($rating == ""){
              echo "No review has been recorded for this movie.";
            }
            else{
              echo "The average rating for this movie is ";
              echo round($rating, 1);
              echo "/5.";
            }

            echo "<br>";
            echo "<h5><a href=\"add_comment.php?id=$mid\">Click here to leave your comment and rating for <strong>$title</strong>!</a></h5>";

            echo "<br>";
            echo "<br>";
            echo "<h4><strong>Reviews:</strong></h4>";
            $reviews = $db->query("SELECT name, rating, comment, time FROM Review WHERE mid=$mid ORDER BY time DESC") or die(mysqli_error($db));

            $finfo = $reviews->fetch_fields();
            $tableHeader = "<tr>";
            foreach($finfo as $val) {
                $tmp = $val->name;

                if ($tmp == 'name') {
                    $tableHeader = $tableHeader."<th>Name</th>";
                } elseif ($tmp == 'rating') {
                    $tableHeader = $tableHeader."<th>Rating</th>";
                } elseif ($tmp == 'comment') {
                    $tableHeader = $tableHeader."<th>Comment</th>";
                } elseif ($tmp == 'time') {
                    $tableHeader = $tableHeader."<th>Time</th>";
                }
            }
            $tableHeader = $tableHeader . "</tr>";
            unset($val);

            $tableBody = "";

            while($row = $reviews->fetch_assoc()) {
                $tableRow = "<tr>";
                $tableRow = $tableRow."<td>".$row["name"]."</td>";
                $tableRow = $tableRow."<td>".$row["rating"]."</td>";
                $tableRow = $tableRow."<td>".wordwrap($row["comment"], 100, "<br />\n")."</td>";
                $tableRow = $tableRow."<td>".date("F j, Y, g:i a",$row["time"])."</td>";
                $tableRow = $tableRow . "</tr>";

                $tableBody = "{$tableBody}{$tableRow}";
                unset($tableRow);
            }


            $avgRating->free();
            $reviews->free();


        }

        $db->close();
        echo '
        <div class="row">
            <div class="col-sm-12">
                <table class="table table-bordered table-striped">
                      <thead>
                          '.$tableHeader.'
                      </thead>
                      <tbody>
                          '.$tableBody.'
                      </tbody>
                </table>
            </div>
        </div>
        ';
        $newReview->free();






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
