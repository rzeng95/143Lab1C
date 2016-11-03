<!DOCTYPE html>
<html>

<head>
    <title>BMDb</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="styles/bootstrap/bootstrap.min.css" >
    <link rel="stylesheet" type="text/css" href="styles/main.css" >

    <script type="text/javascript" src="styles/js/jquery-3.1.1.min.js"></script>
    <script type="text/javascript" src="styles/js/bootstrap.min.js"></script>

    <script type="text/javascript" src="styles/js/bootstrap-multiselect.js"></script>
    <link rel="stylesheet" href="styles/bootstrap/bootstrap-multiselect.css" type="text/css"/>

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
              $maxId = $db->query("SELECT id FROM MaxMovieID") or die(mysqli_error($db));

              $maxIdArr = mysqli_fetch_array($maxId);
              $cur = $maxIdArr[0];
              $new = $cur + 1;

              $newMovie = $db->query("INSERT INTO Movie (id, title, year, rating, company) VALUES ('$new', '$title', '$year', '$rating', '$company')") or die(mysqli_error($db));
          		$updateMaxMovieID = $db->query("UPDATE MaxMovieID SET id=$new WHERE id=$cur") or die(mysqli_error($db));
          		for ($i = 0; $i < count($genres); $i++) {

          			$genre = $db->query("INSERT INTO MovieGenre (mid, genre) VALUES ('$new', '$genres[$i]')") or die(mysqli_error($db));
          		}
          		echo "Thank you for your contribution! ". $title . " has been added to our database!";
            }

            $maxId->free();
            $newMovie->free();
            $updateMaxMovieID->free();
            $genre->free();
            $db->close();


        ?>


    </div>


    </div>

</div>

</body>

</html>
