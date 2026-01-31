<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>RoomArch - Register</title>
<style>
    html, body {
        height: 100%;
        margin: 0;
        padding: 0;
        font-family: Arial, sans-serif;
        background-color: #f7f5f2;
        color: #1c1c1c;
    }

    body {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100%;
        padding: 50px 0;
        box-sizing: border-box;
    }

    .container {
        background: #fff;
        padding: 30px 40px;
        border-radius: 12px;
        box-shadow: 0 8px 15px rgba(0,0,0,0.1);
        width: 350px;
        max-width: 90%;
        text-align: center;
    }

    h2 {
        color: #483429;
        margin-bottom: 20px;
        
    }

    input {
        width: 90%;
        padding: 10px;
        margin: 8px 0;
        border-radius: 6px;
        border: 1px solid #ccc;
    }

    button {
        margin-top: 15px;
        margin-bottom: 10px;
        padding: 10px 20px;
        border: none;
        border-radius: 6px;
        background-color: #483429;
        color: white;
        font-weight: bold;
        cursor: pointer;
    }

    .success {
        color: #4CAF50;
        font-weight: bold;
        margin-top: 15px;
    }
</style>
</head>
<body>
<div class="container">
    <h2>Register</h2>
    <form method="POST">
        <input type="text" name="name" placeholder="Name" required><br>
        <input type="email" name="email" placeholder="Email" required><br>
        <input type="password" name="password" placeholder="Password" required><br>
        <button type="submit" name="register">Register</button>
    </form>

    <?php
    require "classes/Database.php";

    if (isset($_POST['register'])) {
        $db = new Database();
        $conn = $db->connect();

        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

        $sql = "INSERT INTO users (name, email, password) VALUES (?,?,?)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$name, $email, $password]);

        echo "<p class='success'>User registered successfully</p>";
    }
    ?>
</div>
</body>
</html>
