<?php
$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$database = "votero"; 

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to sanitize input data
function sanitize_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function validate_email($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize form data
    $nic = sanitize_input($_POST["nic"]);
    $name = sanitize_input($_POST["name"]);
    $email = sanitize_input($_POST["email"]);
    $username = sanitize_input($_POST["username"]);
    $type = sanitize_input($_POST["type"]);
    $password = sanitize_input($_POST["password"]);
    $repassword = sanitize_input($_POST["repassword"]);
    $phone = sanitize_input($_POST["phone"]);

    // Check if any field is empty
    if (empty($nic) || empty($name) || empty($email) || empty($username) || empty($type) || empty($password) || empty($repassword) || empty($phone)) {
        echo "All fields are required";
        exit;
    }

    if (!preg_match("/^[0-9]{10}$/", $phone)) {
      echo "Invalid phone number format. It should be 10 digits long.";
      exit;
  }
    if (!validate_email($email)) {
        echo "Invalid email format";
        exit;
    }

    if ($password !== $repassword) {
        echo "Passwords do not match";
        exit;
    }

     if ($type == "village_officer") {
      // Insert into VillageOfficer table
      $sql = "INSERT INTO VillageOfficer (VillageOfficer_ID, VillageOfficer_Name, Email, VillageOfficer_Username, VillageOfficer_Password, Admin_ID, Phone)
              VALUES ('$nic', '$name', '$email', '$username', '$password', 'admin_id_value', '$phone')"; // Replace 'admin_id_value' with the actual admin ID
  } elseif ($type == "voter") {
      // Insert into Voter table
      $sql = "INSERT INTO Voter (Voter_NIC, Voter_Name, Email, Voter_Username, Voter_Password, Voter_Type, Mobile_Number)
              VALUES ('$nic', '$name', '$email', '$username', '$password', 'voter', '$phone')";
  }

    // Execute the SQL query
    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sign up for Votero</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  <style>
    body {
      overflow-y: auto; 
    }

    .container {
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      min-height: 100vh;
    }

    .login-form {
      width: 95%;
      max-width: 500px;
      background-color: rgba(255, 255, 255, 0.8); 
      border-radius: 10px;
      padding: 30px;
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
    <h2 class="text-3xl text-gray-900 font-bold mb-6">Sign up for Votero</h2>
    <div class="mb-4">
      <label for="nic" class="block text-gray-700 text-sm font-bold mb-2">NIC Number:</label>
      <input id="nic" name="nic" type="text" placeholder="Enter your NIC number" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
    </div>
    <div class="mb-4">
      <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Name:</label>
      <input id="name" name="name" type="text" placeholder="Enter your name according to NIC" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
    </div>
    <div class="mb-4">
      <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email address:</label>
      <input id="email" name="email" type="email" placeholder="name@example.com" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
    </div>

    <div class="mb-4">
      <label for="username" class="block text-gray-700 text-sm font-bold mb-2">Username:</label>
      <input id="username" name="username" type="text" placeholder="Enter your username" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
    </div>

    <div class="mb-4">
      <label for="contactnumber" class="block text-gray-700 text-sm font-bold mb-2">Contact Number:</label>
      <input id="contactnumber" name="phone" type="text" placeholder="0778094534" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">

    </div>

    <div class="mb-3">
      <label for="type" class="block text-gray-700 text-sm font-bold mb-2">Type:</label>
      <select name="type" id="type" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        <option value="" disabled selected>Select type</option>
        <option value="admin">Admin</option>
        <option value="village_officer">Village Officer</option>
        <option value="voter">Voter</option>
      </select>
    </div>
    <div class="mb-6">
      <label for="password" class="block text-gray-700 text-sm font-bold mb-2">Password:</label>
      <input id="password" name="password" type="password" placeholder="Enter your password" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
    </div>
    <div class="mb-6">
      <label for="repassword" class="block text-gray-700 text-sm font-bold mb-2">Re-enter Password:</label>
      <input id="repassword" name="repassword" type="password" placeholder="Re-enter your password" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
    </div>
    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline w-full">Register</button>
    <div class="mt-4 text-center">
      <p class="text-gray-700 text-sm">Already have an account? <a href="login.html" class="text-blue-500 hover:text-blue-700 font-bold">Log in</a></p>
    </div>
  </form>
</div>

</body>
</html>
