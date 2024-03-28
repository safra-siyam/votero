<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Votero - Voting and Elections</title>
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

<body>

    <?php include 'hero_section.php'; ?>

    <!-- Main Content Section -->
    <div class="main-content">
        <div class="container mx-auto grid grid-cols-1 md:grid-cols-2 gap-8">
            <div class="card flex items-center">
                <div class="mr-4">
                    <i class="fas fa-address-card text-blue-500 text-3xl"></i>
                </div>
                <div>
                    <h3 class="text-xl font-semibold mb-2">Register to Vote</h3>
                    <p class="mb-4">Ensure your voice is heard in the democratic process.</p>
                    <a href="#" class="text-blue-500 hover:underline">Register to Vote &rarr;</a>
                </div>
            </div>
            <div class="card flex items-center">
                <div class="mr-4">
                    <i class="fas fa-user-check text-blue-500 text-3xl"></i>
                </div>
                <div>
                    <h3 class="text-xl font-semibold mb-2">Check Voter Registration Status</h3>
                    <p class="mb-4">Verify your voter registration status.</p>
                    <a href="#" class="text-blue-500 hover:underline">Check Registration &rarr;</a>
                </div>
            </div>
            <div class="card flex items-center">
                <div class="mr-4">
                    <i class="fas fa-vote-yea text-blue-500 text-3xl"></i>
                </div>
                <div>
                    <h3 class="text-xl font-semibold mb-2">Download Voting Cards</h3>
                    <p class="mb-4">Explore voting options in Sri Lanka.</p>
                    <a href="#" class="text-blue-500 hover:underline">Download  &rarr;</a>
                </div>
            </div>
            <div class="card flex items-center">
                <div class="mr-4">
                    <i class="far fa-calendar-alt text-blue-500 text-3xl"></i>
                </div>
                <div>
                    <h3 class="text-xl font-semibold mb-2">Election Dates</h3>
                    <p class="mb-4">Stay informed about upcoming election dates and deadlines to ensure you don't miss your chance to vote.</p>
                    <a href="#" class="text-blue-500 hover:underline">View Election Calendar &rarr;</a>
                </div>
            </div>
        </div>
    </div>
    <?php include 'footer.php'; ?>

</body>

</html>