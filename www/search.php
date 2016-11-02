<?php

$db = new mysqli('localhost', 'cs143', '', 'CS143');
if($db->connect_errno > 0){
    die('Unable to connect to database [' . $db->connect_error . ']');
}

$search = $_GET['search'];
$search = $db->real_escape_string($search);
$queryType = $_GET['type'];

$words = explode(' ', $search);
$d2 = $queryType;

if (trim($search) == '') {
      // Do Nothing because no search query
    } else {

          if ($queryType == "actors") {
              echo "<h3><strong> Matching actors are: </strong></h3>";
              $query = "SELECT CONCAT(first,' ',last), dob FROM Actor WHERE (first LIKE '%$words[0]%' OR last LIKE '%$words[0]%')";
              for($i = 1; $i < count($words); $i++) {
                $word = $words[$i];
                $query .= "AND (first LIKE '%$word%' OR last LIKE '%$word%')";
              }
              $query .= "ORDER BY first ASC";

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
              echo "<h3><strong> Matching movies are: </strong></h3>";
              $query = "SELECT title, year FROM Movie WHERE (title LIKE '%$words[0]%')";
              for($i = 1; $i < count($words); $i++) {
                $word = $words[$i];
                $query .= "AND (title LIKE '%$word%')";
              }
              $query .= "ORDER BY title ASC";

              if (!($rs = $db->query($query))) {
                  $output = $db->error;
              } else {
                  $finfo = $rs->fetch_fields();
                  $tableHeader = "<tr>";
                  foreach($finfo as $val) {
                      $tmp = $val->name;

                      if ($tmp == 'title') {
                          $tmp = 'title';
                      } elseif ($tmp == 'year') {
                          $tmp = 'year';
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
          } else {

            echo "<h3><strong> Matching actors are: </strong></h3>";
            $query = "SELECT CONCAT(first,' ',last), dob FROM Actor WHERE (first LIKE '%$words[0]%' OR last LIKE '%$words[0]%')";
            for($i = 1; $i < count($words); $i++) {
              $word = $words[$i];
              $query .= "AND (first LIKE '%$word%' OR last LIKE '%$word%')";
            }
            $query .= "ORDER BY first ASC";

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

            echo "<h3><strong> Matching movies are: </strong></h3>";
            $query = "SELECT title, year FROM Movie WHERE (title LIKE '%$words[0]%')";
            for($i = 1; $i < count($words); $i++) {
              $word = $words[$i];
              $query .= "AND (title LIKE '%$word%')";
            }
            $query .= "ORDER BY title ASC";

            if (!($rs = $db->query($query))) {
                $output = $db->error;
            } else {
                $finfo = $rs->fetch_fields();
                $tableHeader = "<tr>";
                foreach($finfo as $val) {
                    $tmp = $val->name;

                    if ($tmp == 'title') {
                        $tmp = 'title';
                    } elseif ($tmp == 'year') {
                        $tmp = 'year';
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
          }
        }
$d1 = $query;


?>
