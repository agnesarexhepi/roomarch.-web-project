<?php
require_once 'Classes/Database.php';
require_once 'models/User.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $db = (new Database())->connect();
    $userModel = new User($db);

    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    if ($userModel->register($name, $email, $password)) {
        echo "<script>alert('Llogaria u krijua! Mund të kyçeni tani.'); window.location='login.php';</script>";
    } else {
        echo "<script>alert('Gabim! Email mund të ekzistojë.'); window.location='login.php';</script>";
    }
}
?>