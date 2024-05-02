<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["officerDocument"])) {
    // Include database connection
    include_once "../include/connect.php"; // This file should contain your database connection code

    // File upload directory
    $targetDir = "../admin/uploads/";

    // Get the uploaded file name
    $fileName = basename($_FILES["officerDocument"]["name"]);
    $targetFilePath = $targetDir . $fileName;
    $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

    // Check if file is a PDF
    if ($fileType != "pdf") {
        echo "Only PDF files are allowed.";
        exit;
    }

    // Move the uploaded file to the specified directory
    if (move_uploaded_file($_FILES["officerDocument"]["tmp_name"], $targetFilePath)) {
        // Insert file information into the database
        // $insertQuery = "INSERT INTO villageofficer (file_name, file_path) VALUES (?, ?) where villageOfficer_NIC = 1";
        $insertQuery = "UPDATE villageofficer SET file_name = ?, file_path = ? WHERE villageOfficer_NIC = 1;";

        

        // $stmt = $con->prepare($insertQuery);
        // $stmt->execute([$fileName, $targetFilePath]);


        $query = mysqli_query($con, "UPDATE villageofficer SET file_name = '$fileName', file_path = '$targetFilePath' WHERE villageOfficer_NIC = 1;") ;

        if($query)
        {
        echo "New record created successfully";
        }
        
        
        echo "File uploaded successfully.";
    } else {
        echo "Failed to upload file.";
    }
}
?>
