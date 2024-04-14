<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gazette of Election Date Announcement</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
        }

        textarea {
            width: 100%;
            height: 300px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            margin-bottom: 20px;
        }

        .button-container {
            text-align: center;
        }

        .display-container {
            border: 1px solid #ccc;
            padding: 10px;
            border-radius: 4px;
            background-color: #f9f9f9;
        }
    </style>
</head>
<body>
    <h1>Gazette of Election Date Announcement</h1>

    <textarea id="gazetteInput" placeholder="Type your gazette announcement here..."></textarea>

    <div class="button-container">
        <button onclick="displayGazette()">Display Gazette</button>
    </div>

    <div class="display-container" id="displayGazette"></div>

    <script>
        function displayGazette() {
            var gazetteInput = document.getElementById('gazetteInput').value;
            var displayGazette = document.getElementById('displayGazette');
            displayGazette.innerHTML = gazetteInput;
        }
    </script>
</body>
</html>
