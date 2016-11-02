<?php
    // Establish connection with mysql

    $db = new mysqli('localhost', 'cs143', '', 'CS143');
    if($db->connect_errno > 0){
        die('Unable to connect to database [' . $db->connect_error . ']');
    }

    // TODOs
    // Record all user inputs into variables
    // $is_actor, $first_name, $last_name, $gender, etc.

    // TODOs
    // Validation of user inputs
    // Some variables should not be empty based on the shema of the tables.
    // i.e. $first_name and $last_name should not be empty and if they are empty
    // should print out error message telling the user what is wrong


    // Sample code for the queries
    // if($is_actor){
    //   $insert_query = $db->query("INSERT INTO Actor (id, last, first, sex, dob, dod) VALUES ($newMaxID, '$last_name', '$first_name', '$gender', '$dob', '$dod')") or die(mysqli_error($db));
    // }
    // else{
    //   $insert_query = $db->query("INSERT INTO Director (id, last, first, dob, dod) VALUES ('$newMaxID', '$last_name', '$first_name', '$dob', '$dod')") or die(mysqli_error($db));
    // }
    // $update_query = $db->query("UPDATE MaxPersonID SET id=$newMaxID WHERE id=$oldMaxID") or die(mysqli_error($db));
    //
    // echo "Added";
    // $insert_query->free();
    // $update_query->free();
?>
