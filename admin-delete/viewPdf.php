<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Documents</title>
    <style>
        table {
            border-collapse: collapse;
            width: 70%;
            border: 1px solid black;
            margin: 0 auto; /* Center the table horizontally */
        }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

</head>
<body>
    <h1>View Documents</h1>

    <?php
    // Include database connection
    include_once "../include/connect.php"; // Assuming this file contains your database connection code

    // Fetch all documents from the database
    $selectQuery = "SELECT * FROM villageofficer";
    $result = $con->query($selectQuery);

    $documents = [];
    if ($result) {
        // Fetch associative array
        while ($row = $result->fetch_assoc()) {
            $documents[] = $row;
        }
    }
    ?>

    <?php if (empty($documents)) : ?>
        <p>No documents found.</p>
    <?php else : ?>
        <table>
            <tr style="background-color: #f2f2f2;">
            <th style="border: 1px solid black; padding: 8px; width: 20%;">Village Officer NIC</th>
                <th style="border: 1px solid black; padding: 8px; width: 25%;">Village Officer Name</th>
                <th style="border: 1px solid black; padding: 8px; width: 20%;">Contact Number</th>
                <th style="border: 1px solid black; padding: 8px; width: 20%;">Email</th>
                <th style="border: 1px solid black; padding: 8px; width: 35%;">Status</th>
                <th style="border: 1px solid black; padding: 8px; width: 35%;">File Name</th>
                <th style="border: 1px solid black; padding: 8px; width: 35%;">Action</th>

            </tr>

            <?php foreach ($documents as $document) : ?>
                <tr>
                    <td style="border: 1px solid black; padding: 8px;"><?php echo $document['villageOfficer_NIC']; ?></td>
                    <td style="border: 1px solid black; padding: 8px;"><?php echo $document['VillageOfficer_Name']; ?></td>
                    <td style="border: 1px solid black; padding: 8px;"><?php echo $document['Contact_Number']; ?></td>
                    <td style="border: 1px solid black; padding: 8px;"><?php echo $document['Email']; ?></td>
                    <td style="border: 1px solid black; padding: 8px;"><?php echo $document['status']; ?></td>

                    <td style="border: 1px solid black; padding: 8px;"><a href="<?php echo $document['file_path']; ?>" target="_blank"><?php echo $document['file_name']; ?></a></td>
                    
                    <td class='text-center'>
                        <a href='approveVillageOfficer.php?id=<?php echo $document['villageOfficer_NIC']; ?>' class='inline-block border border-transparent text-xs rounded-md py-1 px-2 bg-transparent hover:bg-blue-500 text-blue-500 hover:text-white hover:border-transparent' tooltip-placement='top' title='Approve'>
                            <i class='fa fa-check'></i> Approve
                        </a>
                        <a href='approveVillageOfficer.php?delete=<?php echo $document['villageOfficer_NIC']; ?>&del=delete' onClick='return confirm("Are you sure you want to make the user Ineligible?")' class='inline-block border border-transparent text-xs rounded-md py-1 px-2 bg-transparent hover:bg-red-500 text-red-500 hover:text-white hover:border-transparent transition-colors duration-300 ease-in-out' tooltip-placement='top' title='Reject'>
                            <i class='fa fa-times mr-1'></i> Rejection
                        </a>
                    </td>
             </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
</body>
</html>
