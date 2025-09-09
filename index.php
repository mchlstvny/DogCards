<?php
echo "index.php";
// Include DB connection
require 'db.php';

// Fetch dogs from database
try {
    $stmt = $conn->query("SELECT * FROM dogs");
    $dogs = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Query failed: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dog List</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .dog-card {
            border: 1px solid #ccc;
            padding: 12px;
            margin: 12px;
            width: 250px;
            display: inline-block;
            vertical-align: top;
            text-align: center;
            border-radius: 8px;
            box-shadow: 0px 2px 6px rgba(0,0,0,0.1);
        }
        img {
            max-width: 100%;
            height: auto;
            border-radius: 6px;
        }
    </style>
</head>
<body>
    <h1>Dog List</h1>

    <?php if ($dogs): ?>
        <?php foreach ($dogs as $dog): ?>
            <div class="dog-card">
              
                <img src="img/<?php echo htmlspecialchars($dog['image']); ?>" alt="Dog image">

                <h2><?php echo htmlspecialchars($dog['name']); ?></h2>
                <p><strong>Age:</strong> <?php echo htmlspecialchars($dog['age']); ?></p>
                <p><strong>Breed:</strong> <?php echo htmlspecialchars($dog['breed']); ?></p>
                <p><strong>Color:</strong> <?php echo htmlspecialchars($dog['color']); ?></p>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>No dogs found in the database.</p>
    <?php endif; ?>
</body>
</html>
