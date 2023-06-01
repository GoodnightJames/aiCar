<?php
$db = new mysqli('localhost', 'root', '', 'aiCar');

if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}

$imagesPath = '/Applications/XAMPP/xamppfiles/htdocs/aiCar/images/';

$images = glob($imagesPath . '*.*');

// Reset the image_path field for all records
$sqlReset = "UPDATE images SET image_path = ''";
$db->query($sqlReset);

foreach ($images as $image) {
    $currentFileName = basename($image);
    $imageId = substr($currentFileName, 0, strpos($currentFileName, '.'));
    $newImagePath = 'images/' . $currentFileName;

    $sql = "UPDATE images SET image_path = ? WHERE id = ?";
    $stmt = $db->prepare($sql);
    $stmt->bind_param('si', $newImagePath, $imageId);
    $stmt->execute();
}

$stmt->close();
$db->close();
?>
