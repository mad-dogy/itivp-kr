<?php
require_once 'config.php';

if ($_POST) {
    $title = trim($_POST['title']);
    $description = trim($_POST['description']);

    if (empty($title)) {
        $error = "Название сериала обязательно!";
    } else {
        $stmt = $pdo->prepare("INSERT INTO serias (title, description, seasons, current_episode) VALUES (?, ?, ?, ?)");
        $stmt->execute([$title, $description]);
        header("Location: index.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Добавить сериал</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <h1>Добавить новый сериал</h1>
    <?php if (isset($error)): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <form method="POST">
        <div class="mb-3">
            <label for="title" class="form-label">Название сериала</label>
            <input type="text" class="form-control" id="title" name="title" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Описание (необязательно)</label>
            <textarea class="form-control" id="description" name="description" rows="3"></textarea>
        </div>
        <div class="mb-3">
            <label for="seasons" class="form-label">Количество сезонов</label>
            <input type="number" class="form-control" id="seasons" name="seasons" required>
        </div>
         <div class="mb-3">
            <label for="current_episode" class="form-label">Текущая серия</label>
            <input type="number" class="form-control" id="current_episode" name="current_episode">
        </div>
        <button type="submit" class="btn btn-primary">Сохранить</button>
        <a href="index.php" class="btn btn-secondary">Отмена</a>
    </form>
</div>
</body>
</html>