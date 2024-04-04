<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upcoming Elections</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        /* Additional custom styles can be added here */
    </style>
</head>
<body class="bg-gray-100">
<?php include 'navbar.php'; ?>
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Upcoming Elections</h1>
        <div class="flex justify-center">
        <?php
        // Establish connection to your database
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "votero";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Fetch data from the registration table
        $sql = "SELECT * FROM Election";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<table id='voters-table' class='w-full border-collapse border border-gray-200'>";
            echo "<thead class='bg-gray-200'>";
            echo "<tr>";
            // echo "<th class='px-8 py-4'>Check</th>";
            echo "<th class='px-8 py-4'>Election ID</th>";
            echo "<th class='px-12 py-4'>Name of Election</th>";
            echo "<th class='px-8 py-4'>Date of Election</th>";
            echo "</tr>";
            echo "</thead>";
            echo "<tbody id='election-list'>";
            // Output data of each row
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                // echo "<th class='px-8 py-4'>Name</th>"; //to display it in centralized way
                //echo "<td class='px-8 py-4 text-center'><button class='toggle-eligible' data-id='" . $row['id'] . "'>Eligible</button></td>"; // Button to toggle eligibility
                echo "<td>" . $row["Election_ID"] . "</td>";
                echo "<td>" . $row["Election_Name"] . "</td>";
                echo "<td>" . $row["Election_Date"] . "</td>";
                echo "</tr>";
            }
            echo "</tbody>";
            echo "</table>";
        } else {
            echo "<p>0 results</p>";
        }
        $conn->close();
        ?>
    </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</body>
</html>
