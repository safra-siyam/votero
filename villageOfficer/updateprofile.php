

<!DOCTYPE html>
<html>
<head>
    <title>Display and Update User Information</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        form {
            max-width: 400px;
            margin: 20px auto; 
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        label {
            display: block;
            font-size: 16px;
            font-weight: bold;
            color: #555; 
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="password"] {
            width: calc(100% - 22px);
            padding: 10px;
            font-size: 16px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            color: #333; 
        }

        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            padding: 12px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            width: 100%;
            transition: background-color 0.3s;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

<?php
include '../include/connect.php';
include 'navbar.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nic = $_POST['nic'];
    $name = $_POST['name'];
    $contact = $_POST['contact'];
    $password = $_POST['password'];

    $update_query = "UPDATE villageofficer SET VillageOfficer_Name = '$name', Contact_Number = '$contact', VillageOfficer_Password = '$password' WHERE villageOfficer_NIC = '$nic'";
    
    $update_result = mysqli_query($con, $update_query);

    if ($update_result) {
        echo "Data updated successfully!";
    } else {
        die('Update failed: ' . mysqli_error($con));
    }
}

$query = "SELECT * FROM villageofficer WHERE VillageOfficer_Username = '$username'";
$result = mysqli_query($con, $query);

if (!$result) {
    die('Query failed: ' . mysqli_error($con));
}


$row = mysqli_fetch_assoc($result);

mysqli_close($con);
?>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <label for="nic">NIC:</label>
    <input type="text" id="nic" name="nic" value="<?php echo $row['villageOfficer_NIC']; ?>" style="width: 300px; padding: 10px; font-size: 16px;" readonly><br><br>

    <label for="name">Name:</label>
    <input type="text" id="name" name="name" value="<?php echo $row['VillageOfficer_Name']; ?>" style="width: 300px; padding: 10px; font-size: 16px;" required><br><br>

    <label for="contact">Contact:</label>
    <input type="text" id="contact" name="contact" value="<?php echo $row['Contact_Number']; ?>" style="width: 300px; padding: 10px; font-size: 16px;" required><br><br>

    <label for="text">Password:</label>
    <input type="text" id="password" name="password" value="<?php echo $row['VillageOfficer_Password']; ?>" style="width: 300px; padding: 10px; font-size: 16px;" required><br><br>

    <input type="submit" name="submit" value="Update">
</form>

</body