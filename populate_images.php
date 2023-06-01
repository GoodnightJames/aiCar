<?php
$db = new mysqli('localhost', 'root', '', 'aiCar');

if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}

// Define the image data
$images = [
    [
        'image_path' => 'image1.jpg',
        'votes' => 0
    ],
    [
        'image_path' => 'image2.jpg',
        'votes' => 0
    ],
    [
        'image_path' => 'image3.jpg',
        'votes' => 0
    ],
    [
        'image_path' => 'image4.jpg',
        'votes' => 0
    ]
    // Add more image data as needed
];

// Prepare and execute the SQL statement to insert the image data
$stmt = $db->prepare("INSERT INTO images (image_path, votes) VALUES (?, ?)");
$stmt->bind_param("si", $imagePath, $votes);

foreach ($images as $image) {
    $imagePath = $image['image_path'];
    $votes = $image['votes'];
    $stmt->execute();
}

$stmt->close();
$db->close();
?>
