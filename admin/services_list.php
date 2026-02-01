<?php
session_start();
require_once '../models/Service.php';

// Siguria: Vetem admini
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../login.php");
    exit();
}

$serviceModel = new Service();
$services = $serviceModel->getAllServices();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Services - RoomArch</title>
    <link rel="stylesheet" href="../services.css">
    <style>
        .admin-table { width: 90%; margin: 50px auto; border-collapse: collapse; background: white; }
        .admin-table th, .admin-table td { padding: 15px; border: 1px solid #ddd; text-align: left; }
        .admin-table th { background: #111; color: white; }
        .action-btns a { padding: 5px 10px; text-decoration: none; color: white; border-radius: 3px; font-size: 13px; }
        .btn-edit { background: #b59a6a; }
        .btn-delete { background: #c0392b; }
        .add-new { display: block; width: 200px; margin: 20px auto; text-align: center; padding: 10px; background: #111; color: white; text-decoration: none; }
    </style>
</head>
<body>

    <h2 style="text-align: center; margin-top: 30px;">Service Management</h2>
    <a href="add_service.php" class="add-new">+ Add New Service</a>

    <table class="admin-table">
        <thead>
            <tr>
                <th>Image</th>
                <th>Title</th>
                <th>Style</th>
                <th>Created By (ID)</th> <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row = $services->fetch_assoc()): ?>
            <tr>
                <td><img src="../<?php echo $row['image_path']; ?>" width="80"></td>
                <td><?php echo $row['title']; ?></td>
                <td><?php echo $row['color_class']; ?></td>
                <td><?php echo $row['created_by']; ?></td>
                <td class="action-btns">
                    <a href="edit_service.php?id=<?php echo $row['id']; ?>" class="btn-edit">Edit</a>
                    <a href="delete_service.php?id=<?php echo $row['id']; ?>" class="btn-delete" onclick="return confirm('A jeni i sigurt?')">Delete</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</body>
</html>