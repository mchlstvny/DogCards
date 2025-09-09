<?php
echo "addDog.php";
require 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name  = $_POST['name'];
    $age   = $_POST['age'];
    $breed = $_POST['breed'];
    $color = $_POST['color'];

    $image = $_FILES['image']['name'];
    $target = "img/" . basename($image);

    try {
        $stmt = $conn->prepare("INSERT INTO dogs (name, age, breed, color, image) 
                                VALUES (:name, :age, :breed, :color, :image)");
        $stmt->execute([
            ':name'  => $name,
            ':age'   => $age,
            ':breed' => $breed,
            ':color' => $color,
            ':image' => $image
        ]);

        if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
            echo "masuk sini"; die();
            header("Location: index.php"); // redirect after success
            exit; 
        } else {
            echo "Dog saved, but failed to upload image.";
        }

    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Dog</title>
</head>
<body>
    <h1>Add a New Dog</h1>
    <form method="POST" enctype="multipart/form-data">
        <label>Name: <input type="text" name="name" required></label><br>
        <label>Age: <input type="number" name="age" required></label><br>
        <label>Breed: <input type="text" name="breed" required></label><br>
        <label>Color: <input type="text" name="color" required></label><br>
        <label>Image: <input type="file" name="image" required></label><br><br>
        <button type="submit">Add Dog</button>
    </form>
</body>
</html>
