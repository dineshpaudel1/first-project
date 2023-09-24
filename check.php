<?php
$connect = mysqli_connect("localhost", "root", "", "gym");
if (isset($_POST["user_name"])) {
    $username = mysqli_real_escape_string($connect, $_POST["user_name"]);
    $query = "SELECT * FROM gym_user WHERE username = '" . $username . "'";
    $result = mysqli_query($connect, $query);
    echo mysqli_num_rows($result);
}

if (isset($_POST["user_phone"])) {
    $phone = mysqli_real_escape_string($connect, $_POST["user_phone"]);
    $query = "SELECT * FROM gym_user WHERE phone = '" . $phone . "'";
    $result = mysqli_query($connect, $query);
    echo mysqli_num_rows($result);
}
if (isset($_POST["user_email"])) {
    $email = mysqli_real_escape_string($connect, $_POST["user_email"]);
    $query = "SELECT * FROM gym_user WHERE email = '" . $email . "'";
    $result = mysqli_query($connect, $query);
    echo mysqli_num_rows($result);
}
?>