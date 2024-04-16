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

    function validate_email($email) {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    if(isset($_POST["nicVO"], $_POST["name"], $_POST["emailVO"], $_POST["division"], $_POST["usernameVO"], $_POST["password"], $_POST["dob"], $_POST["gender"], $_POST["contactnumber"], $_POST["address"])) {
        $VOnic = sanitize_input($_POST["nicVO"]);
        $VOname = sanitize_input($_POST["name"]);
        $VOemail = sanitize_input($_POST["emailVO"]);
        $VOdivision = sanitize_input($_POST["division"]);
        $VOusername = sanitize_input($_POST["usernameVO"]);
        $VOpassword = sanitize_input($_POST["password"]);
        $VOdob = sanitize_input($_POST["dob"]);
        $VOgender = sanitize_input($_POST["gender"]);
        $VOphone = sanitize_input($_POST["contactnumber"]);
        $VOaddress = sanitize_input($_POST["address"]);
        $adminId = 01;     
        $st = "Pending";  
        $query=mysqli_query($conn,"INSERT INTO villageofficer (VillageOfficer_NIC, VillageOfficer_Name, Email, Division, VillageOfficer_Username, VillageOfficer_Password,Date_of_Birth,Gender,Contact_Number,Address,status) 
        values('$VOnic', '$VOname', '$VOemail', '$VOdivision', '$VOusername', '$VOpassword','$VOdob','$VOgender','$VOphone','$VOaddress','$st')");
        if($query)
        {
            echo "Record inserted";
        }
        else{
            echo "Record NOT inserted";
        }
        header('Location:adminDashboard.html');
    }
    
} catch (Exception $e) {
    echo "error|" . $e->getMessage(); // Return error message
?>
<script>
    var errorMessage = "<?php echo "error|" . $e->getMessage(); ?>";
    //alert(errorMessage);
</script>
<?php
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
  <title>Add Village Officer Votero</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  <style>
    body {
      overflow-y: auto; 
    }

    .container {
      display: auto;
      /* flex-direction: column; */
      align-items: center;
      justify-content: center;
      min-height: 100vh;
    }


  </style>
  </head>

  <body class="bg-gradient-to-br from-blue-200 to-blue-400 min-h-screen flex items-center justify-center">

<div class="container mx-auto">

  <form class="login-form bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4" id="villageOfficerForm" method="post" action="#">
    
    <h2 class="text-3xl text-gray-900 font-bold mb-6">Add Village Officer</h2>
    <div class="mb-4">
      <label for="nic" class="block text-gray-700 text-sm font-bold mb-2">NIC Number:</label>
      <input id="nicVO" name="nicVO" type="text" placeholder="Enter NIC number" onBlur="voValidate()" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
      <span id="user-availability-statusVONIC" style="font-size:12px;"></span>
    </div>
    <div class="mb-4">
      <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Name:</label>
      <input id="name" name="name" type="text" placeholder="Enter name" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
    </div>
    <div class="mb-4">
      <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email address:</label>
      <input id="emailVO" name="emailVO" type="email" placeholder="name@example.com" onBlur="voValidate()" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
      <span id="user-availability-statusVOEmail" style="font-size:12px;"></span>
    
    </div>
    <div class="mb-4">
      <label for="division" class="block text-gray-700 text-sm font-bold mb-2">Division:</label>
      <input id="division" name="division" type="text" placeholder="Enter division" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
    </div>
    <div class="mb-4">
      <label for="username" class="block text-gray-700 text-sm font-bold mb-2">Username:</label>
      <input id="usernameVO" name="usernameVO" type="text" placeholder="Enter username" onBlur="voValidate()" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
      <span id="user-availability-statusVOUN" style="font-size:12px;"></span>
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

    <div class="mb-4">
      <label for="address" class="block text-gray-700 text-sm font-bold mb-2">Address:</label>
      <textarea id="address" name="address" placeholder="Enter address" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"></textarea>
    </div>
    <button type="submit" id = "voSubmitButton" name = "voSubmitButton" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline w-full" >Register</button>
    </form>
    <script>

  function voValidate(){
    VOEmailAvailability();
    VONicAvailability();
    VOUNAvailability();
  }
function VONicAvailability() 
	{
		$("#loaderIcon").show();
		jQuery.ajax
		({
			url: "check_availabilityVO.php",
			data:'nicVO='+$("#nicVO").val(),
			type: "POST",
			success:function(data){
			$("#user-availability-statusVONIC").html(data);
			$("#loaderIcon").hide();
			},
			error:function (){}
		});
	}
  function VOEmailAvailability() 
	{
		$("#loaderIcon").show();
		jQuery.ajax
		({
			url: "check_availabilityVO.php",
			data:'emailVO='+$("#emailVO").val(),
			type: "POST",
			success:function(data){
			$("#user-availability-statusVOEmail").html(data);
			$("#loaderIcon").hide();
			},
			error:function (){}
		});
	}

  function VOUNAvailability() 
	{
		$("#loaderIcon").show();
		jQuery.ajax
		({
			url: "check_availabilityVO.php",
			data:'usernameVO='+$("#usernameVO").val(),
			type: "POST",
			success:function(data){
			$("#user-availability-statusVOUN").html(data);
			$("#loaderIcon").hide();
			},
			error:function (){}
		});
	}
</script>
  </div>
</div>

</body>

</html>
