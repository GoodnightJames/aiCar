<?php
$db = new mysqli('localhost', 'root', '', 'aiCar');

if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $imageId = $_POST['imageId'];

    // Update the vote count for the selected image
    $updateSql = "UPDATE images SET votes = votes + 1, last_vote = NOW() WHERE id = $imageId";
    $db->query($updateSql);

    // Fetch the updated image data
    $selectSql = "SELECT id, votes FROM images WHERE id = $imageId";
    $result = $db->query($selectSql);
    $imageData = $result->fetch_assoc();

    // Return the updated vote count as JSON response
    echo json_encode(['votes' => $imageData['votes']]);
} else {
    // Invalid request method, return error
    http_response_code(400);
    echo 'Invalid request method.';
}

$db->close();
?>
