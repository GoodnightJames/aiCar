<?php
$db = new mysqli('localhost', 'root', '', 'aiCar');

if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}

// Delete existing records from the images table
$db->query("DELETE FROM images");

$directory = '/Applications/XAMPP/xamppfiles/htdocs/aiCar/images/';
$images = glob($directory . "*.{jpg,jpeg,png,gif}", GLOB_BRACE);

foreach ($images as $image) {
    $sql = "INSERT INTO images (image_path, votes, last_vote) VALUES (?, 0, NOW())";

    if ($stmt = $db->prepare($sql)) {
        $stmt->bind_param("s", $image);

        if ($stmt->execute()) {
            echo "Successfully inserted $image\n";
        } else {
            echo "Error inserting $image: " . $stmt->error . "\n";
        }

        $stmt->close();
    } else {
        echo "Error preparing statement: " . $db->error . "\n";
    }
}

$db->close();
?>
