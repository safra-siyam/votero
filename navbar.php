<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Votero - Voting and Elections</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        /* Navbar styles */
        .navbar {
            background-color: #2563eb;
            color: #fff;
            padding: 20px 0;
        }

        .navbar h1 {
            font-size: 1.8rem;
            margin: 0;
            padding: 0;
        }

        .navbar ul {
            margin: 0;
            padding: 0;
            list-style: none;
        }

        .navbar ul li {
            display: inline-block;
            margin-left: 20px;
        }

        .navbar ul li a {
            color: #fff;
            text-decoration: none;
        }

        .navbar ul li a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar">
        <div class="container mx-auto flex justify-between items-center">
            <h1 class="font-bold text-xl">Votero</h1>
            <ul class="flex space-x-4">
                <li>
                    <a href="#" class="hover:underline">
                        <i class="fas fa-user-circle mr-2 text-lg"></i>
                        <?php 
                            session_start(); // Start the session
                            if(isset($_SESSION['username'])) { // Check if the username is set in the session
                                echo $_SESSION['username']; // Display the username
                            } else {
                                echo "My Account"; // If not logged in, display default text
                            }
                        ?>
                    </a>
                </li>
            </ul>
        </div>
    </nav>

</body>

</html>
