<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document Upload</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
        }

        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        form {
            max-width: 400px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        input[type="file"] {
            width: calc(100% - 20px);
            margin-bottom: 20px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        button[type="submit"] {
            background-color: #4caf50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
        }

        button[type="submit"]:hover {
            background-color: #45a049;
        }

        #uploadStatus {
            text-align: center;
            margin-top: 20px;
            color: #333;
        }
    </style>
</head>
<body>
    <h1>Upload Village Officer Document</h1>
<<<<<<< HEAD
    <form action="upload.php" method="post" enctype="multipart/form-data">
        <input type="file" name="officerDocument" accept="application/pdf" required>
=======
    <form id="uploadForm" enctype="multipart/form-data">
        <input type="file" id="officerDocument" accept="application/pdf" required>
>>>>>>> 97b4e2eefeefbf477caa18b905abe6993816aadd
        <button type="submit">Upload Document</button>
    </form>

    <div id="uploadStatus"></div>

    <script>
        const uploadForm = document.getElementById('uploadForm');
        const officerDocumentInput = document.getElementById('officerDocument');
        const uploadStatus = document.getElementById('uploadStatus');

        uploadForm.addEventListener('submit', async (event) => {
            event.preventDefault();

            const formData = new FormData();
            formData.append('officerDocument', officerDocumentInput.files[0]);

            try {
                const response = await fetch('/upload-village-officer-doc', {
                    method: 'POST',
                    body: formData
                });

                if (response.ok) {
                    uploadStatus.textContent = 'Village officer document uploaded successfully.';
                } else {
                    uploadStatus.textContent = 'Failed to upload village officer document.';
                }
            } catch (error) {
                console.error('Error uploading village officer document:', error);
                uploadStatus.textContent = 'An error occurred while uploading village officer document.';
            }
        });
    </script>
</body>
</html>
