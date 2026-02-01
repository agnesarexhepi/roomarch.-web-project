<?php
require_once '../Classes/Database.php';
require_once '../models/Project.php';

$db = (new Database())->connect();
$repo = new ProjectRepository($db);

// Fshirja
if(isset($_GET['del'])) {
    $repo->deleteProject($_GET['del']);
    header("Location: products.php");
    exit();
}

$projects = $repo->getAllProjects();
?>

<div class="content" style="padding: 20px; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">
    <h2 style="color: #333;">Lista e Projekteve</h2>
    
    <table border="1" width="100%" style="background: white; border-collapse: collapse; box-shadow: 0 2px 10px rgba(0,0,0,0.1); border: 1px solid #ddd;">
        <thead>
            <tr style="background: #f4f4f4; text-align: left;">
                <th style="padding: 12px; border: 1px solid #ddd;">Foto</th>
                <th style="padding: 12px; border: 1px solid #ddd;">Titulli</th>
                <th style="padding: 12px; border: 1px solid #ddd;">Lokacioni</th>
                <th style="padding: 12px; border: 1px solid #ddd;">Veprime</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($projects as $p): ?>
            <tr>
                <td style="text-align: center; padding: 10px; border: 1px solid #ddd;">
                    <img src="../uploads/<?php echo htmlspecialchars($p['image']); ?>" width="80" style="border-radius: 5px; display: block; margin: auto;">
                </td>
                <td style="padding: 12px; border: 1px solid #ddd; font-weight: 500;">
                    <?php echo htmlspecialchars($p['title']); ?>
                </td>
                <td style="padding: 12px; border: 1px solid #ddd; color: #666;">
                    <?php echo htmlspecialchars($p['location']); ?>
                </td>
                <td style="padding: 12px; border: 1px solid #ddd; text-align: center;">
                    <a href="edit.php?id=<?php echo $p['id']; ?>" style="color: #3498db; text-decoration: none; font-weight: bold;">
                        <i class="fas fa-edit"></i> Edit
                    </a> 
                    <span style="color: #ddd; margin: 0 10px;">|</span>
                    <a href="products.php?del=<?php echo $p['id']; ?>" style="color: #e74c3c; text-decoration: none; font-weight: bold;" onclick="return confirm('A jeni të sigurt që dëshironi ta fshini këtë projekt?')">
                        <i class="fas fa-trash"></i> Delete
                    </a>
                </td>
            </tr>
            <?php endforeach; ?>
            
            <?php if(empty($projects)): ?>
            <tr>
                <td colspan="4" style="padding: 20px; text-align: center; color: #999;">Nuk ka projekte të shtuara.</td>
            </tr>
            <?php endif; ?>
        </tbody>
    </table>
    
    <div style="margin-top: 20px;">
        <a href="add_project.php" style="background: #333; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px;">+ Shto Projekt të Ri</a>
    </div>
</div>