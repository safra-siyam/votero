<?php

if($_SERVER["REQUEST_METHOD"] == "POST") 
{
    
    $id = isset($_POST['txtId']) ? $_POST['txtId'] : '';
    $name = isset($_POST['txtName']) ? $_POST['txtName'] : '';
    $date=isset($_POST['txtDate']) ?$_POST['txtDate'] : '';
    $division = isset($_POST['txtDivision']) ? $_POST['txtDivision'] : '';
    



    
    $servername = "localhost:3308";
    $dbUsername = "root"; 
    $dbPassword = "  ";
    $dbname = "votero_db";

    $connection = new mysqli($servername, $dbUsername, $dbPassword, $dbname);

    
    if($connection->connect_error) 
    {
      die("Connection failed: " . $connection->connect_error);
    }

    
    $stmt = $connection->prepare("INSERT INTO election (Election_ID, Election_Name, Election_Date) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $id, $name, $date);

    
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
    <title>Add Election</title>
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
    <!-- Navbar -->
    <!-- <nav class="bg-blue-500 p-4">
        <div class="container mx-auto flex justify-between items-center">
            <h1 class="text-white font-bold text-xl">Votero</h1>
            <ul class="flex space-x-4">
                <li><a href="#" class="text-white hover:underline"></a></li>
                <li><a href="#" class="text-white hover:underline"></a></li>
                <li><a href="login.php" class="text-white hover:underline">Logout</a></li>
            </ul>
        </div>
    </nav> -->

    <?php include 'navbar.php'; ?>


    <!-- Hero Section -->
   

   
    <main class="container mx-auto px-4 py-8">
        <h2 class="text-2xl font-bold mb-4">Add Upcoming Elections</h2>
        <form name="frmAddElection" method="post" action="#">
            <table class="w-full mb-6">
                <tr>
                    <td class="pb-2 pr-2 w-1/4">
                        <label for="txtId" class="block text-gray-700 text-sm font-bold">Election ID:</label>
                    </td>
                    <td class="pb-2">
                        <input type="text" name="txtId" id="txtId" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Election ID">
                    </td>
                </tr>
                <tr>
                    <td class="pb-2 pr-2">
                        <label for="name" class="block text-gray-700 text-sm font-bold">Election Name:</label>
                    </td>
                    <td class="pb-2">
                        <input type="text" name="txtName" id="txtName" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Election Name">
                    </td>
                </tr>

                <tr>
                    <td class="pb-2 pr-2">
                        <label for="txtEmail" class="block text-gray-700 text-sm font-bold">Election Date:</label>
                    </td>
                    <td class="pb-2">
                        <input type="Date" name="txtDate" id="txtDate" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Date">
                    </td>
                </tr>
                
                <tr>
                    <td class="pb-2 pr-2">
                        <label for="txtDivision" class="block text-gray-700 text-sm font-bold">Division:</label>
                    </td>
                    <td class="pb-2">
                        <input type="text" name="txtDivision" id="txtDivision" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Division">
                    </td>
                </tr>
               
            </table>
            <button type="submit" name="btnAdd" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Add Now</button>
        </form>
    </main>


    <?php include '../include/footer.php'; ?>


</body>
</html>