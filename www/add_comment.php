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
            <h1><a href="<?php echo $_SERVER['PHP_SELF']; ?>">Bruin Movie Database</a></h1>

        </div>
        <div class="col-xs-2 col-md-2">
            <h4 style="padding-top:24px;padding-left:50px;"><a href="contribute.php">Contribute!</a></h4>
        </div>
        <div class="col-xs-5 col-md-5">
        <form class="navbar-form navbar-right" style="padding-top:15px" method="get" action="<?php echo $_SERVER['PHP_SELF']; ?>">
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

      <form class="form-inline" method="get" action="movie_info.php">
          <div class="form-group">
              <label for="comment_mid">Movie:</label>
              <select id="comment_mid" name="comment_mid" class="form-control" style="border-radius:0;width:160px;">
                  <?php
                      $db = new mysqli('localhost', 'cs143', '', 'CS143');
                      if($db->connect_errno > 0){
                          die('Unable to connect to database [' . $db->connect_error . ']');
                      }
                      $mid = $_GET['id'];
                      $movies = $db->query("SELECT id, title FROM Movie WHERE id=$mid");
                      while ($row = $movies->fetch_assoc()) {
                          $mid = $row["id"];
                          $title = $row["title"];
                          echo "<option value=\"$mid\">$title</option>";
                      }
                      $movies->free();
                      $db->close();
                  ?>
              </select>
          </div>
          <div class="form-group">
              <label for="comment-name">Name:</label>
              <input id="comment-name" name="comment-name" class="form-control" placeholder="Joe Bruin" style="border-radius:0;width:100px;">
          </div>
          <div class="form-group">
              <label for="comment-rating">Rating:</label>
              <select id="comment-rating" name="comment-rating" class="form-control" style="border-radius:0;">
                  <option select="selected" value="5">5</option>
                  <option value="4">4</option>
                  <option value="3">3</option>
                  <option value="2">2</option>
                  <option value="1">1</option>
                  <option value="0">0</option>
              </select>
          </div>
          <br>
          <br>
          <div class="form-group">
              <label for="comment">Comment:</label>
              <textarea id="comment" name="comment" class="form-control" rows="4" placeholder="Leave your comment here."></textarea>
          </div>

          <br>
          <br>
          <div class="form-group">
              <button type="submit" class="btn btn-success" style="border-radius:0;">Submit</button>
          </div>

      </form>


    </div>


    </div>

</div>


</body>

</htm>
