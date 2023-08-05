<?php
include("config.php");
// Fetch the state of the selected city
if (isset($_GET['city'])) {
    $selectedCity = $_GET['city'];
    $query = "SELECT state FROM City WHERE city = '$selectedCity' LIMIT 1";
    $result = mysqli_query($con, $query);
    if ($row = mysqli_fetch_assoc($result)) {
        echo $row['state'];
    }
}
?>
