<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Voters</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        /* Additional custom styles can be added here */
    </style>
</head>
<body class="bg-gray-100">
<?php include 'navbar.php'; ?>
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Manage Voters</h1>
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
        $sql = "SELECT * FROM registration";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<table id='voters-table' class='w-full border-collapse border border-gray-200'>";
            echo "<thead class='bg-gray-200'>";
            echo "<tr>";
            echo "<th class='p-2'>Name</th>";
            echo "<th class='p-2'>NIC</th>";
            echo "<th class='p-2'>Gender</th>";
            echo "<th class='p-2'>Date of Birth</th>";
            echo "<th class='p-2'>Chief Occupant Name</th>";
            echo "<th class='p-2'>Chief Occupant NIC</th>";
            echo "<th class='p-2'>Chief Occupant Relationship</th>";
            echo "<th class='p-2'>Home ID</th>";
            echo "<th class='p-2'>Address</th>";
            echo "<th class='p-2'>Grama Niladhari Division</th>";
            echo "<th class='p-2'>Registration Date</th>";
            echo "</tr>";
            echo "</thead>";
            echo "<tbody id='voters-list'>";
            // Output data of each row
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["rName"] . "</td>";
                echo "<td>" . $row["rNIC"] . "</td>";
                echo "<td>" . $row["rgender"] . "</td>";
                echo "<td>" . $row["rDateOfBirth"] . "</td>";
                echo "<td>" . $row["rChiefOccupantName"] . "</td>";
                echo "<td>" . $row["rChiefOccupantNIC"] . "</td>";
                echo "<td>" . $row["rChiefOccupantRelationship"] . "</td>";
                echo "<td>" . $row["rHome_id"] . "</td>";
                echo "<td>" . $row["rAddress"] . "</td>";
                echo "<td>" . $row["rGramaNiladhariDivision"] . "</td>";
                echo "<td>" . $row["rRegistrationDate"] . "</td>";
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

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="manage_voters.js"></script>
    <script>
        $(document).ready(function(){
            // Filter voters who are eligible to vote (age >= 18)
            var today = new Date();
            var eighteenYearsAgo = new Date(today.getFullYear() - 18, today.getMonth(), today.getDate());

            $("#voters-list tr").each(function(){
                var dob = new Date($(this).find("td:eq(3)").text());
                if (dob <= eighteenYearsAgo) {
                    $(this).addClass("bg-green-100");
                } else {
                    $(this).addClass("bg-red-100");
                }
            });
        });
    </script>
</body>
</html>