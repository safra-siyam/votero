<!DOCTYPE html>
<html>
<head>
    <title>Upcoming Elections</title>
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
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: #fff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        th, td {
            padding: 15px;
            text-align: left;
        }

        th {
            background-color: #4CAF50;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #ddd;
        }

        td {
            border-bottom: 1px solid #ddd;
        }

        td:first-child {
            border-left: 1px solid #ddd;
        }

        td:last-child {
            border-right: 1px solid #ddd;
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
    </nav><br>

    <main class="container mx-auto px-4 py-8">

       <h2 class="text-2xl font-bold mb-4">Upcoming Elections</h2>

       <table>
          <tr>
            <th>Election ID</th>
            <th>Election Name</th>
            <th>Election Date</th>
            <th></th>
          </tr>

        <?php

          $servername = "localhost:3308";
          $dbUsername = "root";
          $dbPassword = "   ";
          $dbname = "votero_db";


          $connection = new mysqli($servername, $dbUsername, $dbPassword, $dbname);


          if($connection->connect_error) {
             die("Connection failed: " . $connection->connect_error);
          }


          $sql = "SELECT Election_ID,Election_Name,Election_Date FROM election";
          $result = $connection->query($sql);


          if ($result->num_rows > 0) 
          {
               while($row = $result->fetch_assoc()) 
               {
                  echo "<tr>";
                  echo "<td>" . $row["Election_ID"] . "</td>";
                  echo "<td>" . $row["Election_Name"] . "</td>";
                  echo "<td>" . $row["Election_Date"] . "</td>";
                  echo "</tr>";
               }
          } 
          else 
          {
             echo "<tr><td colspan='3'>No data found</td></tr>";
          }


          $connection->close();
        ?>

        
       
        </table>
    </main>


     <footer class="bg-gray-900 text-white py-4">
        <div class="container mx-auto text-center">
            <p>&copy; 2024 Votero. All rights reserved.</p>
        </div>
    </footer>
    
</body>
</html>