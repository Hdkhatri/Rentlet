<?php
include("config.php");
$i_id = $_GET['id'];

// Retrieve p_id from images table
$sql_p_id = "SELECT p_id FROM images WHERE i_id = {$i_id}";
$result_p_id = mysqli_query($con, $sql_p_id);

if ($result_p_id && mysqli_num_rows($result_p_id) > 0) {
    $row = mysqli_fetch_assoc($result_p_id);
    $p_id = $row['p_id'];
    $s = "SELECT p_id,ep_id FROM property WHERE p_id = {$p_id}";
    $r = mysqli_fetch_assoc($s);
    $ep_id = $r['ep_id'];

    // Delete from the "images" table
    $sql_delete = "DELETE FROM images WHERE i_id = {$i_id}";
    $result_delete = mysqli_query($con, $sql_delete);

    if ($result_delete) {
        $msg = "<p class='alert alert-success'>Property Deleted</p>";
        header("Location: submitpropertyupdate.php?ep_id=$ep_id");
        exit();
    }
} else {
    // Handle error if the record does not exist or other errors
    $msg = "<p class='alert alert-danger'>Error retrieving p_id</p>";
}

mysqli_close($con);
?>
