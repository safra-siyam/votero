<!DOCTYPE html>
<html>
<head>
    <title>Register for Election</title>
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
    </nav>

    <!-- Hero Section -->
   

   
    <main class="container mx-auto px-4 py-8">
        <h2 class="text-2xl font-bold mb-4">Register for Upcoming Election</h2>
        <form name="frmRegisterElection" method="post" action="#">
            <table class="w-full mb-6">
                <tr>
                    <td class="pb-2 pr-2">
                        <label for="name" class="block text-gray-700 text-sm font-bold">Name:</label>
                    </td>
                    <td class="pb-2">
                        <input type="text" name="name" id="name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Name according to NIC">
                    </td>
                </tr>
                <tr>
                    <td class="pb-2 pr-2">
                        <label for="name" class="block text-gray-700 text-sm font-bold">NIC Number:</label>
                    </td>
                    <td class="pb-2">
                        <input type="text" name="name" id="name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Enter the NIC Number">
                    </td>
                </tr>

                <tr>
                    <td class="pb-2 pr-2">
                        <label for="txtGender" class="block text-gray-700 text-sm font-bold">Gender:</label>
                    </td>
                    <td class="pb-2">
                        <input type="text" name="txtGender" id="txtGender" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Male/Female/Other">
                    </td>
                </tr>

                <tr>
                    <td class="pb-2 pr-2">
                        <label for="txtdob" class="block text-gray-700 text-sm font-bold">Date Of Birth:</label>
                    </td>
                    <td class="pb-2">
                        <input type="Date" name="txtdob" id="txtdob" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Date Of Birth">
                    </td>
                </tr>

                <tr>
                    <td class="pb-2 pr-2">
                        <label for="name" class="block text-gray-700 text-sm font-bold">Full Name of the Chief Occupant:</label>
                    </td>
                    <td class="pb-2">
                        <input type="text" name="name" id="name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Chief Occupant Detail">
                    </td>
                </tr>

                <tr>
                    <td class="pb-2 pr-2">
                        <label for="name" class="block text-gray-700 text-sm font-bold">NIC of the Chief Occupant:</label>
                    </td>
                    <td class="pb-2">
                        <input type="text" name="name" id="name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Chief Occupant Detail">
                    </td>
                </tr>
                <tr>
                    <td class="pb-2 pr-2">
                        <label for="name" class="block text-gray-700 text-sm font-bold">Relationship to the Chief Occupant:</label>
                    </td>
                    <td class="pb-2">
                        <input type="text" name="name" id="name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Chief Occupant Detail">
                    </td>
                </tr>

                <tr>
                    <td class="pb-2 pr-2 w-1/4">
                        <label for="txtId" class="block text-gray-700 text-sm font-bold">Home ID:</label>
                    </td>
                    <td class="pb-2">
                        <input type="text" name="txtId" id="txtId" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Home ID">
                    </td>
                </tr>

                <tr>
                    <td class="pb-2 pr-2 w-1/4">
                        <label for="txtId" class="block text-gray-700 text-sm font-bold">Address:</label>
                    </td>
                    <td class="pb-2">
                        <input type="text" name="txtId" id="txtId" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Address">
                    </td>
                </tr>
                
                <tr>
                    <td class="pb-2 pr-2">
                        <label for="txtDivision" class="block text-gray-700 text-sm font-bold">Grama Niladari Division:</label>
                    </td>
                    <td class="pb-2">
                        <input type="text" name="txtDivision" id="txtDivision" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Grama Niladari Division">
                    </td>
                </tr>

                <tr>
                    <td class="pb-2 pr-2">
                        <label for="txtDate" class="block text-gray-700 text-sm font-bold">Date:</label>
                    </td>
                    <td class="pb-2">
                        <input type="Date" name="txtDate" id="txtDate" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Date">
                    </td>
                </tr>
               
            </table>
            <button type="submit" name="btnAdd" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Register Now</button>
        </form>
    </main>




    <footer class="bg-gray-900 text-white py-4">
        <div class="container mx-auto text-center">
            <p>&copy; 2024 Votero. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>