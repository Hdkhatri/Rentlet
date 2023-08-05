<?php
include("config.php");
$p_id = $_GET['id'];

// Delete from the "images" table
// $sql_images = "DELETE FROM images WHERE p_id = {$p_id}";
// $result_images = mysqli_query($con, $sql_images);

// Update flag= 0 from the "property" table
$sql_property = "UPDATE property SET flag = 2 WHERE p_id = {$p_id}";
$result_property = mysqli_query($con, $sql_property);

if ( $result_property) {
    $msg = "<p class='alert alert-success'>Property Rentout</p>";
    header("Location: feature.php?msg=$msg");
} else {
    $msg = "<p class='alert alert-warning'>Property Not Rentout</p>";
    header("Location: feature.php?msg=$msg");
}

mysqli_close($con);
?>
