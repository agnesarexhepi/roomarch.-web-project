<?php
session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../login.php");
    exit();
}

require_once '../Classes/Database.php'; 
require_once '../models/Service.php';

$database = new Database();
$db = $database->connect();
$message = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    
    $title = htmlspecialchars(strip_tags($_POST['title']));
    $desc = htmlspecialchars(strip_tags($_POST['description']));
    $color = $_POST['block_color']; 
    $price = htmlspecialchars(strip_tags($_POST['price'])); 
    $plan = htmlspecialchars(strip_tags($_POST['plan_name']));
    $admin_id = $_SESSION['user_id']; 

    $target_dir = "../uploads/";
    if (!file_exists($target_dir)) {
        mkdir($target_dir, 0777, true);
    }

    $file_name = time() . "_" . basename($_FILES["image"]["name"]);
    $target_file = $target_dir . $file_name;
    $db_path = "uploads/" . $file_name; 

    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if($check !== false) {
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            
            $serviceModel = new Service($db); 
            if ($serviceModel->addService($title, $desc, $db_path, $color, $price, $plan, $admin_id)) {
                $message = "<p style='color: green;'>Sherbimi u shtua me sukses!</p>";
            } else {
                $message = "<p style='color: red;'>Gabim gjate ruajtjes ne DB. Kontrollo kolonat!</p>";
            }
        } else {
            $message = "<p style='color: red;'>Gabim gjate upload-it te fotos.</p>";
        }
    } else {
        $message = "<p style='color: red;'>Skedari nuk eshte imazh.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Service - Admin Dashboard</title>
    <style>
        body { font-family: 'Segoe UI', sans-serif; background: #f4f4f4; }
        .admin-form-container { max-width: 600px; margin: 50px auto; padding: 30px; background: #fff; border-radius: 8px; box-shadow: 0 0 15px rgba(0,0,0,0.1); }
        h2 { text-align: center; color: #111; }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; font-weight: bold; color: #555; }
        input, textarea, select { width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 4px; box-sizing: border-box; }
        .btn-submit { background: #b59a6a; color: white; border: none; cursor: pointer; padding: 15px; font-size: 16px; width: 100%; border-radius: 4px; margin-top: 10px; }
        .btn-submit:hover { background: #111; }
        .back-link { display:block; text-align:center; margin-top:15px; color:#666; text-decoration: none; }
    </style>
</head>
<body>

<div class="admin-form-container">
    <h2>Add New Service</h2>
    <?php echo $message; ?>
    
    <form action="add_service.php" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label>Service Title</label>
            <input type="text" name="title" required placeholder="psh. Full Home Renovation">
        </div>

        <div class="form-group">
            <label>Plan Name</label>
            <input type="text" name="plan_name" required placeholder="psh. Digital Package">
        </div>

        <div class="form-group">
            <label>Price</label>
            <input type="text" name="price" required placeholder="psh. $999/start">
        </div>

        <div class="form-group">
            <label>Description</label>
            <textarea name="description" rows="4" required></textarea>
        </div>

        <div class="form-group">
            <label>Image</label>
            <input type="file" name="image" accept="image/*" required>
        </div>

        <div class="form-group">
            <label>Background Style</label>
            <select name="block_color">
                <option value="brown">Brown (Gold)</option>
                <option value="dark">Dark (Black)</option>
            </select>
        </div>

        <button type="submit" name="submit" class="btn-submit">Save Service</button>
        <a href="dashboard.php" class="back-link">← Back to Dashboard</a>
    </form>
</div>

</body>
</html>