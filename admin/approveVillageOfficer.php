

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
        function sendEmailAndConfirm(to_email,id,uName) {
            sendEmail(to_email,id,uName);
            // You can add additional functionality here if needed
        }
        function sendEmail(to_email,id,uName) {
            console.log('Sending email to:', to_email);
                emailjs.send("service_3lzb6jn","template_u0678f9",{
                to_name: uName,
                nic: id,
                to_email: to_email,
                })
                .then(function(response) {
                    console.log('Email sent successfully:', response);
                    alert('Email sent successfully!');
                    window.location.href = 'viewPdf.php';
                    
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
    $sql = mysqli_query($con, "UPDATE villageofficer SET status = 'Approved' WHERE villageOfficer_NIC  = $id");
    if($sql) {
    } else { echo "Error: " . mysqli_error($con);}
   $sqlRead = mysqli_query($con,"SELECT * from villageofficer where villageOfficer_NIC = '$id'");   
    if ($sqlRead->num_rows > 0) {
        $row = $sqlRead->fetch_assoc();
        $to_email = $row["Email"];
        $villageOfficerName = $row["VillageOfficer_Name"];
        $nic = $row["villageOfficer_NIC"];
    } 
    echo '<script>sendEmailAndConfirm("' . $to_email . '", "' . $nic . '", "' . $villageOfficerName . '");</script>';

} 




else if(isset($_GET['delete'])) {
    $id = intval($_GET['delete']);

    $sql = mysqli_query($con, "UPDATE villageofficer SET status = 'Rejected' WHERE villageOfficer_NIC  = $id");
    if($sql) {
    } else { echo "Error: " . mysqli_error($con);}
   $sqlRead = mysqli_query($con,"SELECT * from villageofficer where villageOfficer_NIC = '$id'");   
    if ($sqlRead->num_rows > 0) {
        $row = $sqlRead->fetch_assoc();
        $to_email = $row["Email"];
        $villageOfficerName = $row["VillageOfficer_Name"];
        $nic = $row["villageOfficer_NIC"];
    } 
    // echo '<script>sendEmailAndConfirm("' . $to_email . '", "' . $nic . '", "' . $villageOfficerName . '");</script>';
    echo "<script>window.location.href = 'viewPdf.php';</script>";



} 


else {
    echo "Error: ID parameter not provided.";
}
?>
