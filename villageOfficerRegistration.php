<?php

if($_SERVER["REQUEST_METHOD"] == "POST") 
{
    
    $id = isset($_POST['txtId']) ? $_POST['txtId'] : '';
    $name = isset($_POST['name']) ? $_POST['name'] : '';
    $email = isset($_POST['txtEmail']) ? $_POST['txtEmail'] : '';
    $division = isset($_POST['txtDivision']) ? $_POST['txtDivision'] : '';
    $username = isset($_POST['txtUsername']) ? $_POST['txtUsername'] : '';
    $password = isset($_POST['txtPassword']) ? $_POST['txtPassword'] : '';
    $adminId=1;




    
    $servername = "localhost:3308";
    $dbUsername = "root"; 
    $dbPassword = "      ";
    $dbname = "votero_db";

    $connection = new mysqli($servername, $dbUsername, $dbPassword, $dbname);

    
    if($connection->connect_error) 
    {
      die("Connection failed: " . $connection->connect_error);
    }

    
    $stmt = $connection->prepare("INSERT INTO villageofficer (VillageOfficer_ID, VillageOfficer_Name, Email, Division, VillageOfficer_Username, VillageOfficer_Password, Admin_ID) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssi", $id, $name, $email, $division, $username, $password, $adminId);

    
    if($stmt->execute())
    {
       echo '<script>alert("Successfully Registered")</script>';
       header("Location: villageOfficerDashboard.php");
       exit();
    } 
    else  
    {
       echo "Error: " . $stmt->error;
    }

    
    $stmt->close();
    $connection->close();
}
?>







<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
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
<body class="flex flex-col">
    <!-- Navbar -->
    <nav class="bg-blue-500 p-4">
        <div class="container mx-auto flex justify-between items-center">
            <h1 class="text-white font-bold text-xl">Votero</h1>
            <ul class="flex space-x-4">
                <li><a href="#" class="text-white hover:underline"></a></li>
                <li><a href="#" class="text-white hover:underline"></a></li>
                <li><a href="login.php" class="text-white hover:underline">Logout</a></li>
            </ul>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="bg-blue-500 py-20 text-center text-white">
        <h2 class="text-4xl font-bold mb-4">Welcome to Votero</h2>
        <p class="text-lg">Empowering Sri Lankans to register and participate in elections.</p>
    </div>

   
    <main class="container mx-auto px-4 py-8">
        <h2 class="text-2xl font-bold mb-4">Register Village Officers to Votero</h2>
        <form name="frmVillageOfficerRegistration" method="post" action="#">
            <table class="w-full mb-6">
                <tr>
                    <td class="pb-2 pr-2 w-1/4">
                        <label for="txtId" class="block text-gray-700 text-sm font-bold">Village Officer ID:</label>
                    </td>
                    <td class="pb-2">
                        <input type="text" name="txtId" id="txtId" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Village Officer ID">
                    </td>
                </tr>
                <tr>
                    <td class="pb-2 pr-2">
                        <label for="name" class="block text-gray-700 text-sm font-bold">Name:</label>
                    </td>
                    <td class="pb-2">
                        <input type="text" name="name" id="name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Name">
                    </td>
                </tr>

                <tr>
                    <td class="pb-2 pr-2">
                        <label for="txtEmail" class="block text-gray-700 text-sm font-bold">Email:</label>
                    </td>
                    <td class="pb-2">
                        <input type="email" name="txtEmail" id="txtEmail" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Email">
                    </td>
                </tr>

                <tr>
                    <td class="pb-2 pr-2">
                        <label for="division" class="block text-gray-700 text-sm font-bold">Division:</label>
                    </td>
                    <td class="pb-2">
                        <input type="text" name="txtDivision" id="txtDivision" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Division">
                    </td>
                </tr>

                
                <tr>
                    <td class="pb-2 pr-2">
                        <label for="txtUsername" class="block text-gray-700 text-sm font-bold">Username:</label>
                    </td>
                    <td class="pb-2">
                        <input type="text" name="txtUsername" id="txtUsername" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Username">
                    </td>
                </tr>
                <tr>
                    <td class="pb-2 pr-2">
                        <label for="txtPassword" class="block text-gray-700 text-sm font-bold">Password:</label>
                    </td>
                    <td class="pb-2">
                        <input type="password" name="txtPassword" id="txtPassword" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Password">
                    </td>
                </tr>
               
            </table>
            <button type="submit" name="btnSave" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Register</button>
        </form>
    </main>




    <footer class="bg-gray-900 text-white py-4">
        <div class="container mx-auto text-center">
            <p>&copy; 2024 Votero. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>