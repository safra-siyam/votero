<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "votero";

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

    function validate_email($email) {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if(isset($_POST["type"])) {
            $type = sanitize_input($_POST["type"]);

            if ($type == "voter") {
                if(isset($_POST["nic"], $_POST["name"], $_POST["email"], $_POST["username"], $_POST["password"], $_POST["phone"])) {
                    $voter_nic = sanitize_input($_POST["nic"]);
                    $voter_name = sanitize_input($_POST["name"]);
                    $voter_email = sanitize_input($_POST["email"]);
                    $voter_username = sanitize_input($_POST["username"]); 
                    $voter_password = sanitize_input($_POST["password"]); 
                    $voter_phone = sanitize_input($_POST["phone"]);

                    $sql = "INSERT INTO Voter (Voter_NIC, Voter_Name, Email, Voter_Username, Voter_Password, Mobile_Number)
                            VALUES (?, ?, ?, ?, ?, ?)";
                    $stmt = $conn->prepare($sql);
                    if ($stmt) {
                        $stmt->bind_param("ssssss", $voter_nic, $voter_name, $voter_email, $voter_username, $voter_password, $voter_phone);
                        if ($stmt->execute()) {
                            echo "New record created successfully";
                        } else {
                            throw new Exception("Error: " . $sql . "<br>" . $conn->error);
                        }
                        $stmt->close();
                    } else {
                        throw new Exception("Error: Unable to prepare statement");
                    }
                }
            } elseif ($type == "village_officer") {
                if(isset($_POST["nic"], $_POST["name"], $_POST["email"], $_POST["division"], $_POST["username"], $_POST["password"], $_POST["dob"], $_POST["gender"], $_POST["contactnumber"], $_POST["address"])) {
                    $VOnic = sanitize_input($_POST["nic"]);
                    $VOname = sanitize_input($_POST["name"]);
                    $VOemail = sanitize_input($_POST["email"]);
                    $VOdivision = sanitize_input($_POST["division"]);
                    $VOusername = sanitize_input($_POST["username"]);
                    $VOpassword = sanitize_input($_POST["password"]);
                    $VOdob = sanitize_input($_POST["dob"]);
                    $VOgender = sanitize_input($_POST["gender"]);
                    $VOphone = sanitize_input($_POST["contactnumber"]);
                    $VOaddress = sanitize_input($_POST["address"]);

                    $sql = "INSERT INTO VillageOfficer (villageOfficer_NIC, VillageOfficer_Name, Email, Division, VillageOfficer_Username, VillageOfficer_Password, Date_of_Birth, Gender, Contact_Number, Address)
                            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
                    $stmt = $conn->prepare($sql);
                    if ($stmt) {
                        $stmt->bind_param("ssssssssss", $VOnic, $VOname, $VOemail, $VOdivision, $VOusername, $VOpassword, $VOdob, $VOgender, $VOphone, $VOaddress);
                        if ($stmt->execute()) {
                            echo "New record created successfully";
                        } else {
                            throw new Exception("Error: " . $sql . "<br>" . $conn->error);
                        }
                        $stmt->close();
                    } else {
                        throw new Exception("Error: Unable to prepare statement");
                    }
                }
            }
        } else {
            echo "Type not set.";
        }
    }
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
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
      display: none; /* Hide all forms by default */
      width: 95%;
      max-width: 500px;
      background-color: rgba(255, 255, 255, 0.8); 
      border-radius: 10px;
      padding: 30px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .visible-form {
      display: block; /* Show only the form with the visible-form class */
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
  <div class="mb-3">
    <label for="type" class="block text-gray-700 text-sm font-bold mb-2">Type:</label>
    <select name="type" id="type" required onchange="toggleForm()" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
      <option value="" disabled selected>Select type</option>
      <option value="admin">Admin</option>
      <option value="village_officer">Village Officer</option>
      <option value="voter">Voter</option>
    </select>
  </div>

  <div class="container mx-auto">
  <h2 class="text-3xl text-gray-900 font-bold mb-6">Sign up for Votero</h2>

    <form class="login-form bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4" id="voterForm" method="post" action="#">
  
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
  <select name="type" id="type" required onchange="toggleForm()" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
    <option value="" disabled selected>Select type</option>
    <!-- <option value="admin">Admin</option>
    <option value="village_officer">Village Officer</option> -->
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

  <form class="login-form bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4" id="villageOfficerForm" method="post" action="#">
    <!-- Village Officer form elements -->
    <!-- This form will be displayed when "Village Officer" is selected -->
    <h2 class="text-3xl text-gray-900 font-bold mb-6">Sign up for Village Officer</h2>
    <div class="mb-4">
      <label for="nic" class="block text-gray-700 text-sm font-bold mb-2">NIC Number:</label>
      <input id="nic" name="nic" type="text" placeholder="Enter NIC number" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
    </div>
    <div class="mb-4">
      <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Name:</label>
      <input id="name" name="name" type="text" placeholder="Enter name" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
    </div>
    <div class="mb-4">
      <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email address:</label>
      <input id="email" name="email" type="email" placeholder="name@example.com" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
    </div>
    <div class="mb-4">
      <label for="division" class="block text-gray-700 text-sm font-bold mb-2">Division:</label>
      <input id="division" name="division" type="text" placeholder="Enter division" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
    </div>
    <div class="mb-4">
      <label for="username" class="block text-gray-700 text-sm font-bold mb-2">Username:</label>
      <input id="username" name="username" type="text" placeholder="Enter username" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
    </div>
    <div class="mb-4">
      <label for="password" class="block text-gray-700 text-sm font-bold mb-2">Password:</label>
      <input id="password" name="password" type="password" placeholder="Enter password" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
    </div>
    <div class="mb-4">
      <label for="dob" class="block text-gray-700 text-sm font-bold mb-2">Date of Birth:</label>
      <input id="dob" name="dob" type="date" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
    </div>
    <div class="mb-4">
      <label for="gender" class="block text-gray-700 text-sm font-bold mb-2">Gender:</label>
      <select id="gender" name="gender" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        <option value="" disabled selected>Select gender</option>
        <option value="Male">Male</option>
        <option value="Female">Female</option>
        <option value="Other">Other</option>
      </select>
    </div>
    <div class="mb-4">
      <label for="contactnumber" class="block text-gray-700 text-sm font-bold mb-2">Contact Number:</label>
      <input id="contactnumber" name="contactnumber" type="text" placeholder="Enter contact number" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
    </div>

    <select name="type" id="type" required onchange="toggleForm()" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
  <option value="" disabled selected>Select type</option>
  <!-- <option value="admin">Admin</option> -->
  <option value="village_officer">Village Officer</option>
  <!-- <option value="voter">Voter</option> -->
</select>

    <div class="mb-4">
      <label for="address" class="block text-gray-700 text-sm font-bold mb-2">Address:</label>
      <textarea id="address" name="address" placeholder="Enter address" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"></textarea>
    </div>
    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline w-full">Register</button>
    <div class="mt-4 text-center">
      <p class="text-gray-700 text-sm">Already have an account? <a href="login.html" class="text-blue-500 hover:text-blue-700 font-bold">Log in</a></p>
    </div>
    </form>
  </div>
</div>

<script>
  function toggleForm() {
    var type = document.getElementById("type").value;
    var voterForm = document.getElementById("voterForm");
    var villageOfficerForm = document.getElementById("villageOfficerForm");

    if (type === "voter") {
      voterForm.classList.add("visible-form"); // Display voter form
      villageOfficerForm.classList.remove("visible-form"); // Hide village officer form
    } else if (type === "village_officer") {
      voterForm.classList.remove("visible-form"); // Hide voter form
      villageOfficerForm.classList.add("visible-form"); // Display village officer form
    } else {
      // If admin or no option is selected, hide both forms
      voterForm.classList.remove("visible-form");
      villageOfficerForm.classList.remove("visible-form");
    }
  }
</script>

</body>
</html>

