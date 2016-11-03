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

        <h4 style="text-align:center"><b><i>Contribute to the biggest movie database in the world!</b></i></h4>

        <br />
        <h3>Add a Movie</h3>
        <form class="form-inline" method="get" action="add_movie.php">

            <div class="form-group">
                <label for="title">Title:</label>
                <input id="title" name="title" class="form-control" placeholder="The Avengers" style="border-radius:0;width:125px;">
            </div>
            <div class="form-group">
                <label for="year">Year:</label>
                <input id="year" name="year" class="form-control" placeholder="2012" style="border-radius:0;width:80px;">
            </div>
            <div class="form-group">
                <label for="company">Company:</label>
                <input id="company" name="company" class="form-control" placeholder="Marvel Studios" style="border-radius:0;width:125px;" >
            </div>
            <div class="form-group">
                <label for="rating">Rating:</label>
                <select id="rating" name="rating" class="form-control" style="border-radius:0;">
                    <option select="selected" value="PG-13">PG-13</option>
                    <option value="G">G</option>
                    <option value="PG">PG</option>
                    <option value="R">R</option>
                    <option value="NC-17">NC-17</option>
                </select>
            </div>
            <div class="form-group">
                <label for="genre">Genre:</label>
                <select id="genre" name="genre" class="form-control" style="border-radius:0;" multiple="multiple">
                    <option value="Action">Action</option>
                    <option value="Adult">Adult</option>
                    <option value="Adventure">Adventure</option>
                    <option value="Comedy">Comedy</option>
                    <option value="Crime">Crime</option>
                    <option value="Documentary">Documentary</option>
                    <option value="Drama">Drama</option>
                    <option value="Family">Family</option>
                    <option value="Fantasy">Fantasy</option>
                    <option value="Horror">Horror</option>
                    <option value="Musical">Musical</option>
                    <option value="Mystery">Mystery</option>
                    <option value="Romance">Romance</option>
                    <option value="Sci-Fi">Sci-Fi</option>
                    <option value="Short">Short</option>
                    <option value="Thriller">Thriller</option>
                    <option value="War">War</option>
                    <option value="Western">Western</option>
                </select>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-success" style="border-radius:0;">Submit</button>
            </div>

        </form>
        <h3>Add a Person</h3>
        <form class="form-inline" method="get" action="add_actor_director.php">
            <div class="form-group">
                <label for="type">Type:</label>
                <select id="type" name="type" class="form-control" style="border-radius:0;">
                    <option select="selected" value="actor">Actor</option>
                    <option value="director">Director</option>
                </select>
            </div>
            <div class="form-group">
                <label for="sex">Gender:</label>
                <select id="sex" name="sex" class="form-control" style="border-radius:0;">
                    <option select="selected" value="male">Male</option>
                    <option value="female">Female</option>
                </select>
            </div>
            <div class="form-group">
                <label for="firstname">First Name:</label>
                <input id="firstname" name="firstname" class="form-control" placeholder="Leonardo" style="border-radius:0;width:100px;">
            </div>
            <div class="form-group">
                <label for="lastname">Last Name:</label>
                <input id="lastname" name="lastname" class="form-control" placeholder="DiCaprio" style="border-radius:0;width:100px;">
            </div>
            <div class="form-group">
                <label for="birthdate">Date of Birth:</label>
                <input id="birthdate" name="birthdate" class="form-control" placeholder="[YYYY-MM-DD]" style="border-radius:0;width:125px;">
            </div>
            <div class="form-group">
                <label for="deathdate">Date of Death:</label>
                <input id="deathdate" name="deathdate" class="form-control" placeholder="[Leave blank if alive]" style="border-radius:0;width:155px;">
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-success" style="border-radius:0;">Submit</button>
            </div>

        </form>
        <h3>Add an Actor to a Movie</h3>
        <form class="form-inline" method="get" action="add_actor_movie.php">
            <div class="form-group">
                <label for="actor">Actor:</label>
                <select id="actor" name="actor" class="form-control" style="border-radius:0;width:160px;">
                    <<?php
                        $db = new mysqli('localhost', 'cs143', '', 'CS143');
                        if($db->connect_errno > 0){
                            die('Unable to connect to database [' . $db->connect_error . ']');
                        }
                        $actors = $db->query("SELECT id, CONCAT(first,' ', last) FROM Actor");
                        while ($row = $actors->fetch_assoc()) {
                            $aid = $row["id"];
                            $name = $row["CONCAT(first,' ', last)"];
                            echo "<option value=\"$aid\">$name</option>";
                        }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="movie">Movie:</label>
                <select id="movie" name="movie" class="form-control" style="border-radius:0;width:160px;">
                    <<?php
                        $db = new mysqli('localhost', 'cs143', '', 'CS143');
                        if($db->connect_errno > 0){
                            die('Unable to connect to database [' . $db->connect_error . ']');
                        }
                        $movies = $db->query("SELECT id, title FROM Movie");
                        while ($row = $movies->fetch_assoc()) {
                            $mid = $row["id"];
                            $title = $row["title"];
                            echo "<option value=\"$mid\">$title</option>";
                        }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="role">Role:</label>
                <input id="role" name="role" class="form-control" placeholder="Tony Stark" style="border-radius:0;width:155px;">
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-success" style="border-radius:0;">Submit</button>
            </div>

        </form>

        <h3>Add a Director to a Movie</h3>
        <form class="form-inline" method="get" action="add_director_movie.php">

            <div class="form-group">
                <label for="director">Actor:</label>
                <select id="director" name="director" class="form-control" style="border-radius:0;width:160px;">
                    <<?php
                        $db = new mysqli('localhost', 'cs143', '', 'CS143');
                        if($db->connect_errno > 0){
                            die('Unable to connect to database [' . $db->connect_error . ']');
                        }
                        $directors = $db->query("SELECT id, CONCAT(first,' ', last) FROM Director");
                        while ($row = $directors->fetch_assoc()) {
                            $did = $row["id"];
                            $name = $row["CONCAT(first,' ', last)"];
                            echo "<option value=\"$did\">$name</option>";
                        }
                    ?>
                </select>
            </div>

            <div class="form-group">
                <label for="movie">Movie:</label>
                <select id="movie" name="movie" class="form-control" style="border-radius:0;width:160px;">
                    <<?php
                        $db = new mysqli('localhost', 'cs143', '', 'CS143');
                        if($db->connect_errno > 0){
                            die('Unable to connect to database [' . $db->connect_error . ']');
                        }
                        $movies = $db->query("SELECT id, title FROM Movie");
                        while ($row = $movies->fetch_assoc()) {
                            $mid = $row["id"];
                            $title = $row["title"];
                            echo "<option value=\"$mid\">$title</option>";
                        }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-success" style="border-radius:0;">Submit</button>
            </div>
        </form>
    </div>


    </div>

</div>

<script type="text/javascript">
    $(document).ready(function() {
        $('#genre').multiselect();
    });
</script>

</body>

</html>
