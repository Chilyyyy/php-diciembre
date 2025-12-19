<?php
session_start();
require 'conexionphp';
if (!isset($_SESSION['user_id'])) { header("Location: index.php"); exit(); }

$user_id = $_SESSION['user_id'];


$filtro = $_GET['filtro'] ?? 'Todas';
$sql = "SELECT * FROM tareas WHERE usuario_id = ?";
if ($filtro == 'Pendiente') $sql .= " AND estado = 'Pendiente'";
if ($filtro == 'Completada') $sql .= " AND estado = 'Completada'";

$stmt = $pdo->prepare($sql);
$stmt->execute([$user_id]);
$tareas = $stmt->fetchAll();

include 'menu.php';
?>

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow p-4 mb-4">
            <form action="acciones/agregar.php" method="POST" class="d-flex">
                <input type="text" name="tarea" class="form-control me-2" placeholder="¿Qué tienes que hacer?" required>
                <button type="submit" class="btn btn-primary">Agregar</button>
            </form>
        </div>

        <div class="mb-3">
            <a href="?filtro=Todas" class="btn btn-sm btn-secondary">Todas</a>
            <a href="?filtro=Pendiente" class="btn btn-sm btn-warning">Pendientes</a>
            <a href="?filtro=Completada" class="btn btn-sm btn-success">Completadas</a>
        </div>

        <table class="table table-hover bg-white shadow-sm">
            <thead>
                <tr>
                    <th>Tarea</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($tareas as $t): ?>
                <tr>
                    <td class="<?= $t['estado'] == 'Completada' ? 'completada' : '' ?>">
                        <?= htmlspecialchars($t['tarea']) ?>
                    </td>
                    <td><span class="badge <?= $t['estado'] == 'Pendiente' ? 'bg-warning' : 'bg-success' ?>"><?= $t['estado'] ?></span></td>
                    <td>
                        <a href="acciones/estado.php?id=<?= $t['id'] ?>" class="btn btn-sm btn-outline-success">✓</a>
                        <a href="acciones/eliminar.php?id=<?= $t['id'] ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('¿Eliminar?')">🗑</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?php include 'includes/footer.php'; ?>