<?php
//Accept HTML form data

$nic=$_POST["txtnic"];
$msg=$_POST["txtmsg"];



//create a connection with MYSQL Server
$connection=mysqli_connect("localhost:3308","root"," ");
//select database
mysqli_select_db($connection,"votero_db");
//perform SQL Operations
$sql="INSERT INTO Message(Message_Content,VillageOfficer_ID,Voter_NIC) VALUES('$msg','','$nic') ";

$retval = mysqli_query($connection, $sql);
if($retval > 0)
{
  echo '<script>alert("Successfully Registered")</script>'; 
  header("Location: villageOfficerDashboard.php");
  exit();
}
else
{
  echo "Could not enter data";
}


//Disconnect from server
mysqli_close($connection);





?>
