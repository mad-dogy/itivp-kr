<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Series Manager</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <h1 class="mb-4">Список сериалов</h1>
    <a href="add.php" class="btn btn-success mb-3">Добавить сериал</a>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Название</th>
                <th>Описание</th>
                <th>Статус</th>
                <th>Кол-во сезонов</th>
                <th>Текущая серия</th>
                <th>Создан</th>
                <th>Действия</th>
            </tr>
        </thead>
        <tbody>
            <?php
            require_once 'config.php';

            $stmt = $pdo->query("SELECT * FROM serias ORDER BY created_at DESC");
            while ($series = $stmt->fetch()) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($series['id']) . "</td>";
                echo "<td>" . htmlspecialchars($series['title']) . "</td>";
                echo "<td>" . htmlspecialchars($series['description'] ?: '-') . "</td>";
                echo "<td>" . htmlspecialchars($series['status']) . "</td>";
                echo "<td>" . htmlspecialchars($series['seasons']) . "</td>";
                echo "<td>" . htmlspecialchars($series['current_episode']) . "</td>";
                echo "<td>" . htmlspecialchars($series['created_at']) . "</td>";
                echo "<td>";
                echo "<a href='edit.php?id={$series['id']}' class='btn btn-sm btn-warning'>Редактировать</a> ";
                echo "<a href='update_status.php?id={$series['id']}' class='btn btn-sm btn-info'>Отметить</a> ";
                echo "<a href='delete.php?id={$series['id']}' class='btn btn-sm btn-danger' onclick='return confirm(\"Удалить?\")'>Удалить</a>";
                echo "</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</div>
</body>
</html>