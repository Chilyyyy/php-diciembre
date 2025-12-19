<?php
session_start();
require 'conexion.php';

$id = $_GET['id'];
$user_id = $_SESSION['user_id'];


$stmt = $pdo->prepare("UPDATE tareas SET estado = IF(estado='Pendiente', 'Completada', 'Pendiente') WHERE id = ? AND usuario_id = ?");
$stmt->execute([$id, $user_id]);

header("Location: principal.php");