<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Voting Eligibilty</title>
</head>
<body class="bg-gray-100">
<?php 

include 'navbar.php';

$username;

include '../include/connect.php';





$sql=mysqli_query($con,"select registration.* 
                        from registration
                        inner JOIN
                        voter
                        on registration.rNIC = voter.Voter_NIC
                        where voter.Voter_Username = '$username'"
                      );

while($row=mysqli_fetch_array($sql))
{
?>

<h1>Voter Nic : <b><?php echo $row['rNIC'];?></b></h1>
<h1>Voter name :<b> <?php echo $row['rName'];?>  </b></h1>
<h1>Grama Niladhari Division :<b> <?php echo $row['rGramaNiladhariDivision'];?>  </b></h1>
<h1>Election :<b> <?php echo $row['electionType'];?>  </b></h1>
<h1>Date :<b> <?php echo $row['rRegistrationDate'];?>  </b></h1>
<h1>Eligibilty Status :<b> <?php echo $row['elegibility_status'];?>  </b></h1>

<?php
}
?>





<!-- <h1>Hello Safra You are eligible for voting</h1> -->

<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>

<form method="post" action="generate_pdf.php">
    <button type="submit" name="generate_pdf" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-4 px-8 rounded-lg text-xl">
        Generate Voting Card
    </button>
</form>




</body>

</html>