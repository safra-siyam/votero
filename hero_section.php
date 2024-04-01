<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Votero - Voting and Elections</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        /* Global styles */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            background-color: #f3f4f6;
            color: #333;
            margin: 0;
            padding: 0;
        }

        /* Container styles */
        .container {
            max-width: auto;
            margin-left: auto;
            margin-right: auto;
            padding-left: 20px;
            padding-right: 20px;
        }

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

        /* Hero section styles */
        .hero {
            background-color: #2563eb;
            color: #fff;
            padding-top: 4rem;
            padding-bottom: 4rem;
        }

        .hero h2 {
            font-size: 3rem;
            margin-bottom: 1rem;
        }

        .hero p {
            font-size: 1.5rem;
            margin-bottom: 2rem;
        }

        /* Main content styles */
        .main-content {
            padding-top: 2rem;
            padding-bottom: 2rem;
        }

        /* Footer styles */
        /* .footer {
            background-color: #333;
            color: #fff;
            padding-top: 2rem;
            padding-bottom: 2rem;
        } */
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


    <!-- Hero Section -->
    <div class="hero text-center">
        <div class="container mx-auto">
            <h2 class="text-4xl font-bold mb-4">Welcome to Votero</h2>
            <p class="text-lg">Empowering Sri Lankans to register and participate in elections.</p>
        </div>
    </div>

    <!-- Main Content Section -->
    <div class="container mx-auto">
        <form class="main-content" method="post" action="#">
            <!-- Your form content goes here -->
        </form>
    </div>

    <!-- Footer Section -->
    <!-- <div class="footer text-center">
        <p>&copy; 2024 Votero. All rights reserved.</p>
    </div> -->

</body>

</html>
