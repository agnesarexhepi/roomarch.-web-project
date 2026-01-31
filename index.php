<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RoomArch - Database Connection</title>
    <style>
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: 'Arial', sans-serif;
            background-color: #f7f5f2;
            color: #1c1c1c;
        }
        .container {
            text-align: center;
            background: #fff;
            padding: 30px 40px;
            border-radius: 12px;
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            width: 90%;
        }
        h1 {
            color: #D99873;
            margin-bottom: 15px;
        }
        .success {
            color: #4CAF50;
            font-weight: bold;
        }
        .error {
            color: #FF4C4C;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
        <?php
        require "classes/Database.php";

        try {
            $db = new Database();
            $conn = $db->connect();
        } catch (Exception $e) {
            error_log($e->getMessage());
            echo "<h1 class='error'>An error occurred. Please try again later.</h1>";
        }
        ?>
    </div>
</body>
</html>
