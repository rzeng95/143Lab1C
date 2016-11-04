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
        $aid = $_GET['id'];
        $db = new mysqli('localhost', 'cs143', '', 'CS143');
        if($db->connect_errno > 0){
            die('Unable to connect to database [' . $db->connect_error . ']');
        }

        if ($aid == "") {
            echo "<h4>Blank search detected: use the search bar above!</h4>";
        } else {
            $actor = $db->query("SELECT CONCAT(first,' ', last), sex, dob, dod FROM Actor WHERE id=$aid") or die(mysqli_error());
            $row = $actor->fetch_assoc();

            $name = $row["CONCAT(first,' ', last)"];
            $sex = $row["sex"];
            $dob = $row["dob"];
            if (empty($row["dod"])) {
                $dod = "Still Alive";
            } else {
                $dod = $row["dod"];
            }

            echo "<h3>Actor Information:</h3>";
            echo "
            <table class=\"table table-bordered table-striped\">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Sex</th>
                        <th>Date of Birth</th>
                        <th>Date of Death</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>$name</td>
                        <td>$sex</td>
                        <td>$dob</td>
                        <td>$dod</td>
                    </tr>
                </tbody>
            </table>
            ";
            echo "<h3>Actor Movies:</h3>";
            echo "
            <table class=\"table table-bordered table-striped\">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Role</th>
                    </tr>
                </thead>
                <tbody>
            ";
            $movies = $db->query("SELECT id, title, role FROM Movie m, MovieActor ma WHERE ma.aid = '$aid' AND m.id = ma.mid") or die(mysqli_error());
            while ($row = $movies->fetch_assoc()) {
                echo "<tr>";
                $id = $row["id"];
                $title = $row["title"];
                $role = $row["role"];
                echo "<td><a href=\"movie_info.php?id=$id\">$title</a></td>";
                echo "<td>$role</td>";

                echo "</tr>";
            }

            echo "</tbody></table>";
        }

    ?>
    </div>


    </div>

</div>


</body>

</html>
