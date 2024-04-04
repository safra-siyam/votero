<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Village Officer Dashboard - Votero</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            background-color: #f3f4f6;
            color: #333;
        }

        a {
            color: #2563eb;
        }

        a:hover {
            text-decoration: underline;
        }

        .container {
            max-width: 960px;
            margin-left: auto;
            margin-right: auto;
        }

        .main-content {
            padding-top: 4rem;
            padding-bottom: 4rem;
        }

        .card {
            background-color: #fff;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            border-radius: 0.5rem;
            padding: 2rem;
        }
    </style>
</head>

<body class="bg-gray-100">
    <?php include 'navbar.php'; ?>

    <!-- Main Content Section -->
    <div class="main-content">
        
        <div>
            <div class="card flex items-center">
                <div class="mr-4">
                    <i class="fas fa-users text-blue-500 text-3xl"></i>
                </div>
                <div>
                    <h3 class="text-xl font-semibold mb-2">Manage Voters</h3>
                    <p class="mb-4">Access and manage voter information.</p>
                    <a href="ManageVoters.php" class="text-blue-500 hover:underline">Manage Voters &rarr;</a>
                </div>
            </div>
            <div class="card flex items-center">
                <div class="mr-4">
                    <i class="fas fa-poll text-blue-500 text-3xl"></i>
                </div>
                <div>
                    <h3 class="text-xl font-semibold mb-2">Conduct Surveys</h3>
                    <p class="mb-4">Create and conduct surveys in your village.</p>
                    <a href="#" class="text-blue-500 hover:underline">Conduct Surveys &rarr;</a>
                </div>
            </div>
            <div class="card flex items-center">
                <div class="mr-4">
                    <i class="fas fa-file-alt text-blue-500 text-3xl"></i>
                </div>
                <div>
                    <h3 class="text-xl font-semibold mb-2">Add Elections</h3>
                    <p class="mb-4">Manage the process of adding new elections, including setting up parameters and details.</p>
                    <a href="addElection.php" class="text-blue-500 hover:underline">Add Election &rarr;</a>
                </div>
            </div>
            <div class="card flex items-center">
                <div class="mr-4">
                    <i class="fas fa-bell text-blue-500 text-3xl"></i>
                </div>
                <div>
                    <h3 class="text-xl font-semibold mb-2">Notifications</h3>
                    <p class="mb-4">Stay updated with important notifications.</p>
                    <a href="#" class="text-blue-500 hover:underline">View Notifications &rarr;</a>
                </div>
            </div>
        </div>
    </div>
    <?php include '../include/footer.php'; ?>


</body>

</html>
