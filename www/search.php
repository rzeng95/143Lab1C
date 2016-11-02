<?php

$db = new mysqli('localhost', 'cs143', '', 'CS143');
if($db->connect_errno > 0){
    die('Unable to connect to database [' . $db->connect_error . ']');
}

$query = $_GET['search'];
$queryType = $_GET['type'];

$d2 = $queryType;

if ($queryType == "actors") {
    $query = "SELECT CONCAT(first,' ',last), dob FROM Actor WHERE first LIKE '%$query%' OR last LIKE '%$query%'";

    if (!($rs = $db->query($query))) {
        $output = $db->error;
    } else {
        $finfo = $rs->fetch_fields();
        $tableHeader = "<tr>";
        foreach($finfo as $val) {
            $tmp = $val->name;

            if ($tmp == 'CONCAT(first,\' \',last)') {
                $tmp = 'Name';
            } elseif ($tmp == 'dob') {
                $tmp = 'Birth Date';
            }
            $tableHeader = $tableHeader."<th>".$tmp."</th>";
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


} elseif ($queryType == "movies") {
    $query = "SELECT id, title, year, rating, company FROM Movie WHERE title LIKE '%$query%'";
} else {
    $query = "SELECT ";
}
$d1 = $query;


?>
