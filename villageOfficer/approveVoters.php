

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/@emailjs/browser@4/dist/email.min.js"></script>
    <script type="text/javascript">
        (function() {
            // Initialize EmailJS
            emailjs.init({
                publicKey: "ksA7gbXtFyQmSOK7u",
            });
        })();

        function sendEmailAndConfirm(to_email,id,elStatus,uName) {
            sendEmail(to_email,id,elStatus,uName);
            // You can add additional functionality here if needed
        }

        function sendEmail(to_email,id,elStatus,uName) {
            console.log('Sending email to:', to_email);
            emailjs.send("service_3lzb6jn","template_kst6e8d",{
                to_name: uName,
                nic: id,
                elegibility_status: elStatus,
                to_email: to_email,
                })
                .then(function(response) {
                    console.log('Email sent successfully:', response);
                    alert('Email sent successfully!');
                    window.location.href = 'ManageVoters.php';
                    
                }, function(error) {
                    console.error('Email sending failed:', error);
                    alert('Email sending failed. Please try again later.');
                });
        }
    </script>
</head>
<body>
    

</body>
</html>

<?php
include('../include/connect.php');

if(isset($_GET['id'])) {
    $id = intval($_GET['id']);

    $sql = mysqli_query($con, "UPDATE registration SET elegibility_status = 'Eligible' WHERE rId = $id");

    if($sql) {
        // header('location:ManageVoters.php');
        // exit; // Add exit to prevent further execution
    } else {
        echo "Error: " . mysqli_error($con);
    }

    // Fetch email from voter table
    $sqlRead = mysqli_query($con,"SELECT voter.Email, voter.Voter_Name FROM voter INNER JOIN registration ON registration.rNIC = voter.Voter_NIC WHERE registration.rId = '$id'");
    if ($sqlRead->num_rows > 0) {
        $row = $sqlRead->fetch_assoc();
        $to_email = $row["Email"];
        $voterName = $row["Voter_Name"];
    } 

    // Fetch NIC from registration table
    $sqlRead1 = mysqli_query($con,"SELECT rNIC FROM registration WHERE rId = '$id'");
    if ($sqlRead1->num_rows > 0) {
        $row = $sqlRead1->fetch_assoc();
        $nic = $row["rNIC"];
    }
    $elStatus ='Eligible';
    // echo '<script>sendEmailAndConfirm("' . $to_email . '", "' . $nic . '",  "' . $elStatus . '", ,  "' . $voterName . '");</script>';
    echo '<script>sendEmailAndConfirm("' . $to_email . '", "' . $nic . '",  "' . $elStatus . '", "' . $voterName . '");</script>';


    //header('location:ManageVoters.php');
} 

else if(isset($_GET['delete'])) {
    $id = intval($_GET['delete']);

    $sql = mysqli_query($con, "UPDATE registration SET elegibility_status = 'Ineligible' WHERE rId = $id");

    if($sql) {
        // header('location:ManageVoters.php');
        // exit; // Add exit to prevent further execution

           // Fetch email from voter table
    $sqlRead = mysqli_query($con,"SELECT voter.Email, voter.Voter_Name FROM voter INNER JOIN registration ON registration.rNIC = voter.Voter_NIC WHERE registration.rId = '$id'");
    if ($sqlRead->num_rows > 0) {
        $row = $sqlRead->fetch_assoc();
        $to_email = $row["Email"];
        $voterName = $row["Voter_Name"];
    } 

    // Fetch NIC from registration table
    $sqlRead1 = mysqli_query($con,"SELECT rNIC FROM registration WHERE rId = '$id'");
    if ($sqlRead1->num_rows > 0) {
        $row = $sqlRead1->fetch_assoc();
        $nic = $row["rNIC"];
    }
    $elStatus ='Ineligible';
    // echo '<script>sendEmailAndConfirm("' . $to_email . '", "' . $nic . '",  "' . $elStatus . '", ,  "' . $voterName . '");</script>';
    echo '<script>sendEmailAndConfirm("' . $to_email . '", "' . $nic . '",  "' . $elStatus . '", "' . $voterName . '");</script>';

    } else {
        echo "Error: " . mysqli_error($con);
    }
} else {
    echo "Error: ID parameter not provided.";
}
?>