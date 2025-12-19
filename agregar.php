<?php
session_start();
require 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty(trim($_POST['tarea']))) {
    $stmt = $pdo->prepare("INSERT INTO tareas (tarea, usuario_id) VALUES (?, ?)");
    $stmt->execute([$_POST['tarea'], $_SESSION['user_id']]);
}
header("Location: principal.php");
?>