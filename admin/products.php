<?php
require_once '../Classes/Database.php';
require_once '../models/Project.php';

$db = (new Database())->connect();
$repo = new ProjectRepository($db);

// Fshirja
if(isset($_GET['del'])) {
    $repo->deleteProject($_GET['del']);
    header("Location: products.php");
}

$projects = $repo->getAllProjects();
?>
<div class="content">
    <h2>Lista e Projekteve</h2>
    <table border="1" width="100%" style="background: white; border-collapse: collapse;">
    <th>Created By</th>
    <tr style="background: #eee;">
            <th>Foto</th>
            <th>Titulli</th>
            <th>Lokacioni</th>
            <th>Veprime</th>
        </tr>
        <?php foreach($projects as $p): ?>
<tr>
    <td style="text-align: center;">
        <img src="../uploads/<?php echo htmlspecialchars($p['image']); ?>" width="60" style="border-radius: 5px;">
    </td>
    <td><?php echo htmlspecialchars($p['title']); ?></td>
    <td><?php echo htmlspecialchars($p['location']); ?></td>
    <td><?php echo htmlspecialchars($p['created_by'] ?? 'Admin'); ?></td> <td>
        <a href="edit.php?id=<?php echo $p['id']; ?>" style="color: blue; text-decoration: none;"><i class="fas fa-edit"></i> Edit</a> | 
        <a href="products.php?del=<?php echo $p['id']; ?>" style="color: red; text-decoration: none;" onclick="return confirm('A jeni të sigurt që dëshironi ta fshini këtë projekt?')"><i class="fas fa-trash"></i> Delete</a>
    </td>
</tr>
<?php endforeach; ?>
    </table>
</div>