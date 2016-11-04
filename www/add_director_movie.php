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

          // TODOs
          // Record all user inputs into variables
          // $is_actor, $first_name, $last_name, $gender, etc.

          $mid = $_GET["movie"];
          $did = $_GET["director"];

          // Validation of user inputs
          // Some variables should not be empty based on the shema of the tables.
          // i.e. $first_name and $last_name should not be empty and if they are empty
          // should print out error message telling the user what is wrong

          if($mid == "" || $did == "") {
            echo "Please select a movie and a director.";
          } else {
            $newMovieDirector = $db->query("INSERT INTO MovieDirector (mid, did) VALUES ('$mid', '$did')") or die(mysqli_error($db));
            echo "Thank you for your contribution!";
          }

          $newMovieDirector->free();
          $db->close();
        ?>


    </div>


    </div>

</div>

</body>

</html>
