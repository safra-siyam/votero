<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "votero";

$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $stmt = $conn->prepare("INSERT INTO registration (electionType,rName, rNIC, rgender, rDateOfBirth, rChiefOccupantName, rChiefOccupantNIC, rChiefOccupantRelationship, rHome_id, rAddress, rGramaNiladhariDivision, rRegistrationDate) VALUES (?,?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssssssss", $electionType, $name, $nic, $gender, $dob, $chief_name, $chief_nic, $relationship, $home_id, $address, $grama_division, $registration_date);

    $electionType = $_POST['electiontype'];
    $name = $_POST['name'];
    $nic = $_POST['nic'];
    $gender = $_POST['gender'];
    $dob = $_POST['dob'];
    $chief_name = $_POST['chief_name'];
    $chief_nic = $_POST['chief_nic'];
    $relationship = $_POST['relationship'];
    $home_id = $_POST['home_id'];
    $address = $_POST['address'];
    $grama_division = $_POST['grama_division'];
    $registration_date = $_POST["date"]; 

    if ($stmt->execute()) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register for Election</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Votero - Voting and Elections</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        html,
        body {
            height: 100%;
        }

        .flex-grow {
            flex-grow: 1;
        }
        main {
            flex-grow: 1;
        }
    </style>
</head>
<body class="bg-gray-100"">


    <?php include 'navbar.php'; ?>


    <!-- Hero Section -->
    <main class="container mx-auto px-4 py-8">
        <h2 class="text-2xl font-bold mb-4"style="font-size: 24px;">Register for Upcoming Election</h2>
        <form name="frmRegisterElection" method="post" action="#">
            <table class="w-full mb-6">
                <tr>
                    <td class="pb-2 pr-2">
                        <!-- <label for="electiontype" class="block text-gray-700 text-sm font-bold">Election Type:</label>
                     -->
                     <label for="electiontype" class="block text-gray-700 text-sm font-bold" style="font-size: 16px;">Election Type:</label>

                    </td>
                    <td class="pb-2 pr-2">
                    <select name="electiontype" id="electiontype" required onchange="toggleForm()" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            <option value="" disabled selected>Select Election</option>
                            <option value="presidential_Election">Presidential Election</option>
                            <option value="parliamentary_Election">Parliamentary Election</option>
                            <option value="Local_Government_Elections">Local Government Elections</option>
                    </select>
                    </td>
                </tr>
                <tr>
                    <td class="pb-2 pr-2">
                        <label for="name" class="block text-gray-700 text-sm font-bold"style="font-size: 16px;">Name:</label>
                    </td>
                    <td class="pb-2">
                        <input type="text" name="name" id="name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Name according to NIC">
                    </td>
                </tr>
                <tr>
                    <td class="pb-2 pr-2">
                        <label for="nic" class="block text-gray-700 text-sm font-bold"style="font-size: 16px;">NIC Number:</label>
                    </td>
                    <td class="pb-2">
                        <input type="text" name="nic" id="nic" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Enter the NIC Number">
                    </td>
                </tr>
                <tr>
                    <td class="pb-2 pr-2">
                        <label for="email" class="block text-gray-700 text-sm font-bold"style="font-size: 16px;">Email:</label>
                    </td>
                    <td class="pb-2">
                        <input type="email" name="email" id="email" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="jhonabc13@gmail.com">
                    </td>
                </tr>

                <tr>
                    <td class="pb-2 pr-2">
                        <label for="gender" class="block text-gray-700 text-sm "style="font-size: 16px;">Gender:</label>
                    </td>
                    <td class="pb-2">
                        <input type="text" name="gender" id="gender" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Male/Female/Other">
                    </td>
                </tr>

                <tr>
                    <td class="pb-2 pr-2">
                        <label for="dob" class="block text-gray-700 text-sm font-bold"style="font-size: 16px;">Date Of Birth:</label>
                    </td>
                    <td class="pb-2">
                        <input type="date" name="dob" id="dob" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Date Of Birth">
                    </td>
                </tr>

                <tr>
                    <td class="pb-2 pr-2">
                        <label for="chief_name" class="block text-gray-700 text-sm font-bold"style="font-size: 16px;">Full Name of the Chief Occupant:</label>
                    </td>
                    <td class="pb-2">
                        <input type="text" name="chief_name" id="chief_name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Chief Occupant Detail">
                    </td>
                </tr>

                <tr>
                    <td class="pb-2 pr-2">
                        <label for="chief_nic" class="block text-gray-700 text-sm font-bold"style="font-size: 16px;">NIC of the Chief Occupant:</label>
                    </td>
                    <td class="pb-2">
                        <input type="text" name="chief_nic" id="chief_nic" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Chief Occupant Detail">
                    </td>
                </tr>
                <tr>
                    <td class="pb-2 pr-2">
                        <label for="chief_email" class="block text-gray-700 text-sm font-bold"style="font-size: 16px;">Email of the Chief Occupant:</label>
                    </td>
                    <td class="pb-2">
                        <input type="email" name="chief_email" id="chief_email" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Chief Occupant Detail">
                    </td>
                </tr>
                <tr>
                    <td class="pb-2 pr-2">
                        <label for="relationship" class="block text-gray-700 text-sm font-bold"style="font-size: 16px;">Relationship to the Chief Occupant:</label>
                    </td>
                    <td class="pb-2">
                        <input type="text" name="relationship" id="relationship" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Chief Occupant Detail">
                    </td>
                </tr>

                <tr>
                    <td class="pb-2 pr-2 w-1/4">
                        <label for="home_id" class="block text-gray-700 text-sm font-bold"style="font-size: 16px;">Home ID:</label>
                    </td>
                    <td class="pb-2">
                        <input type="text" name="home_id" id="home_id" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Home ID">
                    </td>
                </tr>

                <tr>
                    <td class="pb-2 pr-2 w-1/4">
                        <label for="address" class="block text-gray-700 text-sm font-bold"style="font-size: 16px;">Address:</label>
                    </td>
                    <td class="pb-2">
                        <input type="text" name="address" id="address" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Address">
                    </td>
                </tr>
                
                <tr>
                    <td class="pb-2 pr-2">
                        <label for="grama_division" class="block text-gray-700 text-sm font-bold"style="font-size: 16px;">Grama Niladari Division:</label>
                    </td>
                    <td class="pb-2">
                        <input type="text" name="grama_division" id="grama_division" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Grama Niladari Division">
                    </td>
                </tr>

                <tr>
                    <td class="pb-2 pr-2">
                        <label for="date" class="block text-gray-700 text-sm font-bold"style="font-size: 16px;">Date:</label>
                    </td>
                    <td class="pb-2">
                        <input type="date" name="date" id="date" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Date">
                    </td>
                </tr>
                
                <tr>
                    <td class="pb-2 pr-2">
                        <input type="checkbox" name="agree" id="agree" class="mr-4" onchange="enableButton()"> 
                        <label for="agree" class="block text-gray-700 text-sm font-bold"style="font-size: 16px;">All the Above information is accurate.</label>
                    </td>
                    <td class="pb-2"></td>
                </tr>
            </table>
            <button type="submit" name="btnAdd" id="registrationButton" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" disabled>Register Now</button>
        </form>
    </main>
    <!-- JavaScript to enable/disable the registration button based on checkbox state -->
    <script>
        function enableButton() {
            var agreeCheckbox = document.getElementById("agree");
            var registrationButton = document.getElementById("registrationButton");
            registrationButton.disabled = !agreeCheckbox.checked;
        }
    </script>
    <div class="text-center mb-4">
        <a href="HomePage.php" class="text-blue-500 hover:underline">Go Back to Dashboard</a>
    </div>

    <footer class="bg-gray-900 text-white py-4">
        <div class="container mx-auto text-center">
            <p>&copy; 2024 Votero. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>
