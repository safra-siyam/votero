<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    if (isset($_POST['searchdata']) ){
    $searchdata = $_POST['searchdata'];

    // Establish connection to your database
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "votero";

    $con = new mysqli($servername, $username, $password, $dbname);

    if ($con->connect_error) {
        die("Connection failed: " . $con->connect_error);
    }

    $sql = "SELECT * FROM registration WHERE rNIC = '$searchdata'";
    $result = $con->query($sql);

    if ($result->num_rows > 0) {
        echo "<table id='voters-table' class='w-full border-collapse border border-gray-200'>";
        echo "<thead class='bg-gray-200'>";
        echo "<tr>";
        echo "<th class='px-12 py- text-center'>Name</th>";
        echo "<th class='px-12 py-4'>NIC</th>";
        echo "<th class='px-4 py-4'>Gender</th>";
        echo "<th class='px-8 py-4'>Date of Birth</th>";
        echo "<th class='px-6 py-4'>Chief Occupant Name</th>";
        echo "<th class='px-12 py-4'>Chief Occupant NIC</th>";
        echo "<th class='px-6 py-4'>Chief Occupant Relationship</th>";
        echo "<th class='px-4 py-4'>Home ID</th>";
        echo "<th class='px-12 py-4'>Address</th>";
        echo "<th class='px-6 py-4'>Grama Niladhari Division</th>";
        echo "<th class='px-4 py-4'>Registration Date</th>";
        echo "<th class='px-2 py-4'>Eligibility</th>";
        echo "<th class='px-4 py-4'>Actions</th>";
        echo "</tr>";
        echo "</thead>";
        echo "<tbody id='voters-list'>";
        // Output data of each row
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td class='text-center'>" . $row["rName"] . "</td>";
            echo "<td class='text-center'>" . $row["rNIC"] . "</td>";
            echo "<td class='text-center'>" . $row["rgender"] . "</td>";
            echo "<td class='text-center'>" . $row["rDateOfBirth"] . "</td>";
            echo "<td class='text-center'>" . $row["rChiefOccupantName"] . "</td>";
            echo "<td class='text-center'>" . $row["rChiefOccupantNIC"] . "</td>";
            echo "<td class='text-center'>" . $row["rChiefOccupantRelationship"] . "</td>";
            echo "<td class='text-center'>" . $row["rHome_id"] . "</td>";
            echo "<td class='text-center'>" . $row["rAddress"] . "</td>";
            echo "<td class='text-center'>" . $row["rGramaNiladhariDivision"] . "</td>";
            echo "<td class='text-center'>" . $row["rRegistrationDate"] . "</td>";
            echo "<td class='text-center'>" . $row["elegibility_status"] . "</td>";
            echo "<td class='text-center'>";
            echo "<a href='approveVoters.php?id=" . $row['rId'] . "' class='inline-block border border-transparent text-xs rounded-md py-1 px-2 bg-transparent hover:bg-blue-500 text-blue-500 hover:text-white hover:border-transparent' tooltip-placement='top' title='Approve'>";
            echo "<i class='fa fa-check'></i> Approve";
            echo "</a>";
            echo "<a href='approveVoters.php?delete=" . $row['rId'] . "&del=delete' onClick='return confirm(\"Are you sure you want to make the user Ineligible?\")' class='inline-block border border-transparent text-xs rounded-md py-1 px-2 bg-transparent hover:bg-red-500 text-red-500 hover:text-white hover:border-transparent transition-colors duration-300 ease-in-out' tooltip-placement='top' title='Reject'>";
            echo "<i class='fa fa-times mr-1'></i> Rejection";
            echo "</a>";
            echo "</td>";
            echo "</tr>";
        }
        echo "</tbody>";
        echo "</table>";
    } else {
        echo "<p>No results found.</p>";
    }
    $con->close();
    
    }

}
else{
    // header('Location:login.php');
    
}
?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Voters</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <!-- <style>
        .custom-table th,
        .custom-table td {
            padding: 10px;
            text-align: center;
        }

        .custom-table thead th {
            background-color: #f3f4f6;
        }

        .custom-table tbody tr:nth-child(even) {
            background-color: #f8fafc;
        }

        .custom-table tbody tr:hover {
            background-color: #e5e7eb;
        }
    </style> -->

    <style>
        /* Additional custom styles can be added here */
        table {
            border-collapse: collapse;
            width: 100%;
            margin-bottom: 20px;
            overflow-x: auto;
            display: block;
            overflow-y: hidden;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        th, td {
            padding: 12px 8px;
            text-align: center;
            border-bottom: 1px solid #e2e8f0;
        }

        th {
            background-color: #edf2f7;
            color: #4a5568;
            font-weight: 600;
        }

        td {
            background-color: #fff;
            color: #4a5568;
        }

        tbody tr:nth-child(even) {
            background-color: #f7fafc;
        }

        .action-buttons {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .action-buttons a {
            margin: 0 5px;
            padding: 8px 12px;
            border-radius: 4px;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }

        .action-buttons a:hover {
            background-color: #cbd5e0;
        }
    </style>
    
</head>
<body class="bg-gray-100">
<?php include 'navbar.php'; ?>
<div class="container mx-auto p-4" text-left>
    <h1 class="text-2xl font-bold mb-4">Manage Voters</h1>


    <form role="form" method="post" name="search" class="mb-4" action="#">
    <div class="flex items-center border-b border-b-2 border-blue-500 py-2">
    <input required type="text" name="searchdata" id="searchdata" placeholder="Search by Name/Mobile No." class="appearance-none bg-transparent border-none w-full text-gray-700 mr-3 py-2 px-4 leading-tight focus:outline-none" style="font-size: 16px; height: 40px;">
    <button type="submit" name="search" id="submit" class="flex-shrink-0 bg-blue-500 hover:bg-blue-700 border-blue-500 hover:border-blue-700 text-sm border-4 text-white py-2 px-4 rounded" style="font-size: 16px; height: 40px;">Search</button>
</div>

</form>

    <?php
    // Establish connection to your database
    $servername = "localhost";
    $usernames = "root";
    $password = "";
    $dbname = "votero";

    $conn = new mysqli($servername, $usernames, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Fetch data from the registration table
    // $sql = "SELECT * FROM registration";
    include_once('../include/connect.php');
    $sqlRead = mysqli_query($con,"select Division from villageofficer where VillageOfficer_Username = '$username'");
		$columnValue = '';
    if ($sqlRead->num_rows > 0) {
        $row = $sqlRead->fetch_assoc();
        $columnValue = $row["Division"];
        //$_SESSION['msg']=" $columnValue  Dispensary is Approved !!";
     
      } 

    $sqlRead = mysqli_query($con,"select Division from villageofficer where VillageOfficer_Username = '$username'");
		$columnValue = '';
    if ($sqlRead->num_rows > 0) {
        $row = $sqlRead->fetch_assoc();
        $columnValue = $row["Division"];
        //$_SESSION['msg']=" $columnValue  Dispensary is Approved !!";
     
      } 

    
    $sql = "SELECT registration.* from registration INNER join villageofficer on registration.rGramaNiladhariDivision = villageofficer.Division where villageofficer.Division = '$columnValue' ";


    
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // echo "<table id='voters-table' class='w-full border-collapse border border-gray-200'>";
        echo "<table id='voters-table' class='w-full border-collapse border border-gray-200' style='font-size: 16px;'>";

        echo "<thead class='bg-gray-200'>";
        echo "<tr>";
        echo "<th class='px-12 py- text-center'>Name</th>";
        echo "<th class='px-12 py-4'>NIC</th>";
        echo "<th class='px-4 py-4'>Gender</th>";
        echo "<th class='px-8 py-4'>Date of Birth</th>";
        echo "<th class='px-6 py-4'>Chief Occupant Name</th>";
        echo "<th class='px-12 py-4'>Chief Occupant NIC</th>";
        echo "<th class='px-6 py-4'>Chief Occupant Relationship</th>";
        echo "<th class='px-4 py-4'>Home ID</th>";
        echo "<th class='px-12 py-4'>Address</th>";
        echo "<th class='px-6 py-4'>Grama Niladhari Division</th>";
        echo "<th class='px-4 py-4'>Registration Date</th>";
        echo "<th class='px-2 py-4'>Eligibility</th>";
        echo "<th class='px-2 py-4'>Election Type</th>";
        echo "<th class='px-4 py-4'>Approve</th>";
        echo "</tr>";
        echo "</thead>";
        echo "<tbody id='voters-list'>";
        // Output data of each row
        while($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td class='text-center'>" . $row["rName"] . "</td>";
            echo "<td class='text-center'>" . $row["rNIC"] . "</td>";
            echo "<td class='text-center'>" . $row["rgender"] . "</td>";
            echo "<td class='text-center'>" . $row["rDateOfBirth"] . "</td>";
            echo "<td class='text-center'>" . $row["rChiefOccupantName"] . "</td>";
            echo "<td class='text-center'>" . $row["rChiefOccupantNIC"] . "</td>";
            echo "<td class='text-center'>" . $row["rChiefOccupantRelationship"] . "</td>";
            echo "<td class='text-center'>" . $row["rHome_id"] . "</td>";
            echo "<td class='text-center'>" . $row["rAddress"] . "</td>";
            echo "<td class='text-center'>" . $row["rGramaNiladhariDivision"] . "</td>";
            echo "<td class='text-center'>" . $row["rRegistrationDate"] . "</td>";
            echo "<td class='text-center'>" . $row["elegibility_status"] . "</td>";
            echo "<td class='text-center'>" . $row["electionType"] . "</td>";

            
            echo "<td class='text-center'>";
            echo "<a href='approveVoters.php?id=" . $row['rId'] . "' class='inline-block border border-transparent text-xs rounded-md py-2 px-4 bg-transparent hover:bg-blue-500 text-blue-500 hover:text-white hover:border-transparent' tooltip-placement='top' title='Approve' style='font-size: 16px;'>"; // Adjust font size as needed
            echo "<i class='fa fa-check'></i> Approve";
            echo "</a>";
            echo "<a href='approveVoters.php?delete=" . $row['rId'] . "&del=delete' onClick='return confirm(\"Are you sure you want to make the user Ineligible?\")' class='inline-block border border-transparent text-xs rounded-md py-2 px-4 bg-transparent hover:bg-red-500 text-red-500 hover:text-white hover:border-transparent transition-colors duration-300 ease-in-out' tooltip-placement='top' title='Reject' style='font-size: 16px;'>"; // Adjust font size as needed
            echo "<i class='fa fa-times mr-1'></i> Rejection";
            echo "</a>";
            echo "</td>";
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

