<?php
$db = new mysqli('localhost', 'root', '', 'aiCar');

if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}

// Retrieve the existing image paths from the database
$sql = "SELECT id, image_path FROM images";
$result = $db->query($sql);

$images = [];
while ($row = $result->fetch_assoc()) {
    $id = $row['id'];
    $imagePath = 'images/' . basename($row['image_path']); // Assuming the images are stored in the 'images' folder
    $images[] = [
        'id' => $id,
        'image_path' => $imagePath
    ];
}

// Update the image paths in the database
foreach ($images as $image) {
    $id = $image['id'];
    $imagePath = $image['image_path'];
    $updateSql = "UPDATE images SET image_path = '$imagePath' WHERE id = $id";
    $db->query($updateSql);
}

$db->close();
?>
