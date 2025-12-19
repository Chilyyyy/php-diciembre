<?php
session_start();
require 'conexion.php';

$id = $_GET['id'];
$user_id = $_SESSION['user_id'];


$stmt = $pdo->prepare("DELETE FROM tareas WHERE id = ? AND usuario_id = ?");
$stmt->execute([$id, $user_id]);

header("Location: principal.php");