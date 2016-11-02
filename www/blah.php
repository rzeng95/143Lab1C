<!DOCTYPE html>
<html>

<head>
    <title>IMDb</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <style>
        a { color: inherit; }
        a:link { text-decoration: none; }
        a:hover { text-decoration: none; }
        a:visited { text-decoration: none; }
        a:active { text-decoration: none; }
    </style>
</head>

<?php
    if (isset($_GET['query'])) {
        $input = $_GET['query'];


        // Establish connection with mysql

        $db = new mysqli('localhost', 'cs143', '', 'TEST'); //toDo: change this to 'CS143'
        if($db->connect_errno > 0){
            die('Unable to connect to database [' . $db->connect_error . ']');
        }

        //$input = "SELECT * FROM Actor WHERE id=10 OR id=11";

        if (!($rs = $db->query($input))) {
            $output = $db->error;
        } else {
            // http://php.net/manual/en/mysqli-result.fetch-fields.php
            $finfo = $rs->fetch_fields();
            $tableHeader = "<tr>";
            foreach($finfo as $val) {
                $tableHeader = $tableHeader."<th>".$val->name."</th>";
            }
            $tableHeader = $tableHeader . "</tr>";
            unset($val);

            $tableBody = "";

            while($row = $rs->fetch_row()) {
                $tableRow = "<tr>";
                foreach($row as $val) {
                    if (empty($val)) $val="n/a";
                    $tableRow = $tableRow."<td>".$val."</td>";
                }
                $tableRow = $tableRow . "</tr>";

                $tableBody = "{$tableBody}{$tableRow}";
                unset($val);
                unset($tableRow);
            }

            $rs -> free();
        }

        // At the very end, close connection with db
        $db->close();
    }
?>

<div class="container">

    <h2><a href="<?php echo $_SERVER['PHP_SELF']; ?>">Project 1B: Web Query</a></h2>

    <br />
    <div class="row">
        <div class="col-sm-8">
            <form method="get" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <textarea
                class="form-control" rows="5"
                name="query" placeholder="SELECT * FROM Actor WHERE id=10"></textarea>
                <br>
                <span class="input-group-btn">
                    <button type="submit" class="btn btn-success">Query</button>
                </span>

            </form>
        </div>
    </div>
    <br /><br />
    <div class="row">
        <div class="col-sm-8">
            <input class="form-control" value="<?php echo "$input";?>" readonly>
        </div>

    </div>
    <div class="row">
        <div class="col-sm-8">
            <br>
            <i><?php echo "$output"?></i>
            <table class="table table-bordered table-striped">
                <thead>
                    <?php echo $tableHeader ?>
                </thead>
                <tbody>
                    <?php echo $tableBody ?>
                </tbody>
            </table>
        </div>
    </div>

</div>






</body>
</html>
