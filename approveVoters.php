<?php
include('connect.php');

if(isset($_GET['id'])) {
    $id = intval($_GET['id']);

    $sql = mysqli_query($con, "UPDATE registration SET elegibility_status = 'Eligible' WHERE rId = $id");

    if($sql) {
        header('location:ManageVoters.php');
        exit; // Add exit to prevent further execution
    } else {
        echo "Error: " . mysqli_error($con);
    }
} else {
    echo "Error: ID parameter not provided.";
}
?>
