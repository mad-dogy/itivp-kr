<?php
require_once 'config.php';

$id = $_GET['id'] ?? null;

if (!$id || !is_numeric($id)) {
    die("Неверный ID сериала");
}

// Получаем задачу
$stmt = $pdo->prepare("SELECT * FROM serias WHERE id = ?");
$stmt->execute([$id]);
$task = $stmt->fetch();

if (!$task) {
    die("Сериал не найдена");
}

if ($_POST) {
    $title = trim($_POST['title']);
    $description = trim($_POST['description']);

    if (empty($title)) {
        $error = "Название сериала обязательно!";
    } else {
        $stmt = $pdo->prepare("UPDATE tasks SET title = ?, description = ?, seasons = ?, current_episode = ? WHERE id = ?");
        $stmt->execute([$title, $description, $id]);
        header("Location: index.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Редактировать сериал</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <h1>Редактировать сериал</h1>
    <?php if (isset($error)): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <form method="POST">
        <div class="mb-3">
            <label for="title" class="form-label">Название сериала</label>
            <input type="text" class="form-control" id="title" name="title" value="<?= htmlspecialchars($task['title']) ?>" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Описание</label>
            <textarea class="form-control" id="description" name="description" rows="3"><?= htmlspecialchars($task['description']) ?></textarea>
        </div>
         <div class="mb-3">
            <label for="seasons" class="form-label">Количество сезонов</label>
            <input class="form-control" type="number" id="seasons" name="seasons" ><?= htmlspecialchars($task['seasons']) ?></т>
        </div>
         <div class="mb-3">
            <label for="current_episode" class="form-label">Описание</label>
            <textarea class="form-control" id="description" name="description" rows="3"><?= htmlspecialchars($task['description']) ?></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Сохранить</button>
        <a href="index.php" class="btn btn-secondary">Отмена</a>
    </form>
</div>
</body>
</html>