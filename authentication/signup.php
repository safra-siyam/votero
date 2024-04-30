<?php
include_once('connect.php');

$servername = "localhost";
$username = "root";
$password = "";
$database = "votero";

$error = "";

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
                    ?>
                    <script>
                        var recAdd = "<?php echo "New record created successfully"; ?>";
                        alert(recAdd);
                    </script>
                    <?php
                    //echo '<script>window.location.href = "login.php";</script>'; // Redirect to login page
                } else {
                    throw new Exception("Error: " . $sql . "<br>" . $conn->error);
                }                      
                $stmt->close();
            } else {
                throw new Exception("Error: Unable to prepare statement");
            }                
        } 
    }
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
      /*display: none;  Hide all forms by default */
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
  <h2 class="text-3xl text-gray-900 font-bold mb-6">Sign up for Votero</h2>

    <form class="login-form bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4" id="voterForm" method="post" action="#">
  
    <div class="mb-4">
      <label for="nic" class="block text-gray-700 text-sm font-bold mb-2">NIC Number:</label>
      <input id="nic" name="nic" type="text" placeholder="Enter your NIC number" onBlur="voterValidate()" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"> 
      <span id="user-availability-status2" style="font-size:12px;"></span>
    </div>
    <div class="mb-4">
      <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Name:</label>
      <input id="name" name="name" type="text" placeholder="Enter your name according to NIC" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
    </div>
    <div class="mb-4">
      <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email address:</label>

      <input id="email" name="email" type="email" placeholder="name@example.com" onBlur="voterValidate()"required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
      <span id="user-availability-status3" style="font-size:12px;"></span>

      

									 
    </div>

    <div class="mb-4">
      <label for="username" class="block text-gray-700 text-sm font-bold mb-2">Username:</label>
      <input id="username" name="username" type="text" placeholder="Enter your username" onBlur="voterValidate()"required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
      <span id="user-availability-status1" style="font-size:12px;">KKKKK</span>

    </div>


    <script>
  function voterValidate(){
			userAvailability();
			userNameAvailability();
      nicAvailability();
		}
	function userAvailability() 
	{
		$("#loaderIcon").show();
		jQuery.ajax
		({
			url: "check_availability.php",
			data:'email='+$("#email").val(),
			type: "POST",
			success:function(data){
			$("#user-availability-status3").html(data);
			$("#loaderIcon").hide();
			},
			error:function (){}
		});
	}
  function nicAvailability() 
	{
		$("#loaderIcon").show();
		jQuery.ajax
		({
			url: "check_availability.php",
			data:'nic='+$("#nic").val(),
			type: "POST",
			success:function(data){
			$("#user-availability-status2").html(data);
			$("#loaderIcon").hide();
			},
			error:function (){}
		});
	}

  function userNameAvailability() 
	{
		$("#loaderIcon").show();
		jQuery.ajax
		({
			url: "check_availability.php",
			data:'username='+$("#username").val(),
			type: "POST",
			success:function(data){
			$("#user-availability-status1").html(data);
			$("#loaderIcon").hide();
			},
			error:function (){}
		});
	}
	</script>	



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
    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline w-full" onclick="registerAndRedirect()" id="submit">Register</button>

    <div class="mt-4 text-center">
      <p class="text-gray-700 text-sm">Already have an account? <a href="login.php" class="text-blue-500 hover:text-blue-700 font-bold">Log in</a></p>
    </div>
  </form>
</div>
<script>
    function registerAndRedirect() {
        
        window.location.href = "login.php";
    }
</script>


<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<script src="vendor/modernizr/modernizr.js"></script>
<script src="vendor/jquery-cookie/jquery.cookie.js"></script>
<script src="vendor/perfect-scrollbar/perfect-scrollbar.min.js"></script>
<script src="vendor/switchery/switchery.min.js"></script>
<script src="vendor/jquery-validation/jquery.validate.min.js"></script>
<script src="assets/js/main.js"></script>
<script src="assets/js/login.js"></script>


</body>
</html>
