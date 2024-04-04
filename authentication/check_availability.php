<?php 
require_once("connect.php");

$emailExists = false;
$nicExists = false;
$usernameExists = false;

if (!empty($_POST["email"])) {
    $email = $_POST["email"];
    $result = mysqli_query($con, "SELECT Email FROM voter WHERE Email='$email'");
    $count = mysqli_num_rows($result);
    if ($count > 0) {
        echo "<span style='color:red'> Email already exists .</span>";
        $emailExists = true;
    } else {
        echo "<span style='color:green'> Email available for Registration .</span>";
    }
}

if (!empty($_POST["nic"])) {
    $nic = $_POST["nic"];
    $result = mysqli_query($con, "SELECT Voter_NIC FROM voter WHERE Voter_NIC='$nic'");
    $count = mysqli_num_rows($result);
    if ($count > 0) {
        echo "<span style='color:red'> NIC already exists .</span>";
        $nicExists = true;
    } else {
        echo "<span style='color:green'> NIC available for Registration .</span>";
    }
}

if (!empty($_POST["username"])) {
    $username = $_POST["username"];
    $result = mysqli_query($con, "SELECT Voter_Username FROM voter WHERE Voter_Username='$username'");
    $count = mysqli_num_rows($result);
    if ($count > 0) {
        echo "<span style='color:red'> User Name already exists .</span>";
        $usernameExists = true;
    } else {
        echo "<span style='color:green'> User Name available for Registration .</span>";
    }
}

if ($emailExists || $nicExists || $usernameExists) {
    echo "<script>$('#submit').prop('disabled', true).css({'background-color': '#d3d3d3', 'color': '#555'});</script>";
} else {
    echo "<script>$('#submit').prop('disabled', false).css({'background-color': '', 'color': ''});</script>";
}
?>
