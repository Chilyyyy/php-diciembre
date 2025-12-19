<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mi To-Do List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .completada { text-decoration: line-through; color: gray; }
    </style>
</head>
<body class="bg-light">
<nav class="navbar navbar-dark bg-dark mb-4">
    <div class="container">
        <a class="navbar-brand" href="principal.php">Gestión de Tareas</a>
        <?php if(isset($_SESSION['user_id'])): ?>
            <span class="navbar-text">Hola, <?= $_SESSION['user_nombre'] ?> | <a href="logout.php" class="btn btn-sm btn-outline-danger">Salir</a></span>
        <?php endif; ?>
    </div>
</nav>
<div class="container">