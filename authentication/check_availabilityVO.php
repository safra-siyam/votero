<?php 
require_once("connect.php");

$nicExists = false;
$emailExists = false;
$usernameExists = false;

if (!empty($_POST["nicVO"])) {
    $nicVO = $_POST["nicVO"];
    $result = mysqli_query($con, "SELECT villageOfficer_NIC FROM villageofficer WHERE villageOfficer_NIC='$nicVO'");
    $count = mysqli_num_rows($result);
    if ($count > 0) {
        echo "<span style='color:red'> NIC already exists .</span>";
        $nicExists = true;
    } else {
        echo "<span style='color:green'> NIC available for Registration .</span>";
		$nicExists = false;
    }
}

if (!empty($_POST["emailVO"])) {
    $emailVO = $_POST["emailVO"];
    $result = mysqli_query($con, "SELECT Email FROM villageofficer WHERE Email='$emailVO'");
    $count = mysqli_num_rows($result);
    if ($count > 0) {
        echo "<span style='color:red'> Email already exists .</span>";
        $emailExists = true;
    } else {
        echo "<span style='color:green'> Email available for Registration .</span>";
        $emailExists = false;

    }
}

if (!empty($_POST["usernameVO"])) {
    $uNameVO = $_POST["usernameVO"];
    $result = mysqli_query($con, "SELECT VillageOfficer_Username FROM villageofficer WHERE VillageOfficer_Username='$uNameVO'");
    $count = mysqli_num_rows($result);
    if ($count > 0) {
        echo "<span style='color:red'> User Name already exists .</span>";
        $usernameExists = true;
    } else {
        echo "<span style='color:green'> User Name available for Registration .</span>";
        $usernameExists = false;

    }
}

if ($nicExists || $emailExists || $usernameExists) {
    echo "<script>$('#voSubmitButton').prop('disabled', true).css({'background-color': '#d3d3d3', 'color': '#555'});</script>";
} else {
    echo "<script>$('#voSubmitButton').prop('disabled', false).css({'background-color': '', 'color': ''});</script>";
}
?>
