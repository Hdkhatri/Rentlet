<?php
include("config.php");
// Fetch areas based on the selected city
if (isset($_GET['city'])) {
    $selectedCity = $_GET['city'];
    $query = "SELECT area FROM City WHERE city = '$selectedCity'";
    $result = mysqli_query($con, $query);
    $options = "";
    while ($row = mysqli_fetch_assoc($result)) {
        $options .= "<option value='" . $row['area'] . "'>" . $row['area'] . "</option>";
    }
    echo $options;
}
?>
