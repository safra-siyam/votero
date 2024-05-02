<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "votero";

$error = "";

try {
    $conn = new mysqli($servername, $username, $password, $database);

    if ($conn->connect_error) {
        throw new Exception("Connection failed: " . $conn->connect_error);
    }

    // Function to sanitize input data
    function sanitize_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if(isset($_POST["nic"], $_POST["type"], $_POST["username"], $_POST["password"])) {
            $nic = sanitize_input($_POST["nic"]);
            $type = sanitize_input($_POST["type"]);
            $username = sanitize_input($_POST["username"]); 
            $password = sanitize_input($_POST["password"]); 

            // Prepare SQL statement based on user type
            if ($type == "voter") {
                $sql = "SELECT * FROM Voter WHERE Voter_NIC = ? AND Voter_Username = ? AND Voter_Password = ?";
                $stmt = $conn->prepare($sql);
                if ($stmt) {
                    $stmt->bind_param("sss", $nic, $username, $password);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    
                    if ($result->num_rows == 1) {
                        // User found, you can proceed with login
                        // For example, you can set session variables to keep the user logged in
                        session_start();
                        $_SESSION['user'] = $result->fetch_assoc();
    
                        // Redirect to a dashboard or profile page
                        header("Location: ../voter/HomePage.php");
                        exit();
                    } else {
                        // User not found, display an error message
                        echo "<script>alert('Invalid credentials. Please try again.');</script>";
                    }
                } else {
                    echo "<script>alert('Error occurred. Please try again.');</script>";
                }
            }
            else if ($type == "village_officer") {
                $sql = "SELECT * FROM villageOfficer WHERE villageOfficer_NIC = ? AND VillageOfficer_Username = ? AND VillageOfficer_Password = ?";
                $stmt = $conn->prepare($sql);
                if ($stmt) {
                    $stmt->bind_param("sss", $nic, $username, $password);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    
                    if ($result->num_rows == 1) {
                        // User found, you can proceed with login
                        // For example, you can set session variables to keep the user logged in
                        session_start();
                        $_SESSION['user'] = $result->fetch_assoc();
    
                        // Redirect to a dashboard or profile page
                        header("Location: ../villageOfficer/villageofficerDashboard.php");
                        exit();
                    } else {
                        // User not found, display an error message
                        echo "<script>alert('Invalid credentials. Please try again.');</script>";
                    }
                } else {
                    echo "<script>alert('Error occurred. Please try again.');</script>";
                }
            }

            else if ($type == "admin") {
                $sql = "SELECT * FROM admin WHERE Admin_ID = ? AND Admin_Username = ? AND Admin_Password = ?";
                $stmt = $conn->prepare($sql);
                if ($stmt) {
                    $stmt->bind_param("sss", $nic, $username, $password);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    
                    if ($result->num_rows == 1) {
                        // User found, you can proceed with login
                        // For example, you can set session variables to keep the user logged in
                        session_start();
                        $_SESSION['user'] = $result->fetch_assoc();
    
                        // Redirect to a dashboard or profile page
                        header("Location: ../admin/adminDashboard.html");
                        // C:\wamp64\www\votero\admin\adminDashboard.html
                        exit();
                    } else {
                        // User not found, display an error message
                        echo "<script>alert('Invalid credentials. Please try again.');</script>";
                    }
                } else {
                    echo "<script>alert('Error occurred. Please try again.');</script>";
                }
            }
        }
    }
}
catch (Exception $e) {
    echo "<script>alert('An error occurred: " . $e->getMessage() . "');</script>"; // Return error message as a popup
}

if (isset($conn)) {
    $conn->close();
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login for Votero</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  <style>
    .container {
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      height: 100vh;
    }
    .login-form {
      width: 80%;
      max-width: 400px;
      background-color: rgba(255, 255, 255, 0.8); /* Transparent white background */
      border-radius: 10px;
      padding: 20px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .login-form button {
      transition: background-color 0.3s ease, transform 0.3s ease;
    }

    .login-form button:hover {
      background-color: #2c5282;
      transform: scale(1.05);
    }

  </style>
</head>
<body class="bg-gradient-to-br from-blue-200 to-blue-400 min-h-screen flex items-center justify-center">

<div class="container mx-auto">
  <form class="login-form bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4" method="post" action="#">
    <h2 class="text-3xl text-gray-900 font-bold mb-6">Login for Votero</h2>
    <div class="mb-4">
      <label for="nic" class="block text-gray-700 text-sm font-bold mb-2">NIC Number:</label>
      <input id="nic" name="nic" type="text" placeholder="Enter your NIC number" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
    </div>
    <!-- <div class="mb-4">
      <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Name:</label>
      <input id="name" name="name" type="text" placeholder="Enter your name" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
    </div> -->

    <div class="mb-3">
      <label for="type" class="block text-gray-700 text-sm font-bold mb-2">Type:</label>
      <select name="type" id="type" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        <option value="" disabled selected>Select User type</option>
        <option value="admin">Admin</option>
        <option value="village_officer">Village Officer</option>
        <option value="voter">Voter</option>
      </select>
    </div>
    <div class="mb-4">
      <label for="username" class="block text-gray-700 text-sm font-bold mb-2">Username:</label>
      <input id="username" name="username" type="text" placeholder="Enter your username" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
    </div>
    <div class="mb-6">
      <label for="password" class="block text-gray-700 text-sm font-bold mb-2">Password:</label>
      <input id="password" name="password" type="password" placeholder="Enter your password" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
    </div>
    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline w-full">Login</button>
    <div class="mt-4 text-center">
      <p class="text-gray-700 text-sm">Don't have an account? <a href="signup.php" class="text-blue-500 hover:text-blue-700 font-bold">Register</a></p>
    </div>
  </form>
</div>

</body>
</html>