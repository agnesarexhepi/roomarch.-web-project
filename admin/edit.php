<?php
require_once '../Classes/Database.php';
require_once '../models/Project.php';

$db = (new Database())->connect();
$repo = new ProjectRepository($db);

$id = $_GET['id'];
$project = $repo->getProjectById($id);

if(isset($_POST['update_project'])) {
    $title = $_POST['title'];
    $location = $_POST['location'];
    $description = $_POST['description'];
    
    // Logjika për update (mund të mbash foton e vjetër nëse nuk ngarkohet e re)
    if($repo->updateProject($id, $title, $location, $description)) {
        header("Location: products.php");
    }
}
?>

<div style="max-width: 500px; margin: auto; padding: 20px; font-family: sans-serif;">
    <h2>Edito Projektin</h2>
    <form method="POST">
        <label>Titulli:</label><br>
        <input type="text" name="title" value="<?php echo $project['title']; ?>" style="width:100%; padding:8px; margin:10px 0;"><br>
        
        <label>Lokacioni:</label><br>
        <input type="text" name="location" value="<?php echo $project['location']; ?>" style="width:100%; padding:8px; margin:10px 0;"><br>
        
        <label>Përshkrimi:</label><br>
        <textarea name="description" style="width:100%; padding:8px; margin:10px 0;"><?php echo $project['description']; ?></textarea><br>
        
        <button type="submit" name="update_project" style="background: #111; color: white; padding: 10px; border: none; cursor: pointer;">Përditëso</button>
        <a href="products.php">Anulo</a>
    </form>
</div>