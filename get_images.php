<?php
$db = new mysqli('localhost', 'root', '', 'aiCar');

if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}

$sql = "SELECT id, image_path, votes, last_vote FROM images";
$result = $db->query($sql);

$images = [];
$current_time = time();
while ($row = $result->fetch_assoc()) {
    $votes = $row['votes'];
    $last_vote = strtotime($row['last_vote']);
    $time_difference = $current_time - $last_vote;

    // Calculate the decayed vote count
    $vote_decay = $votes * pow(0.5, $time_difference / 86400);  // Half-life of 1 day

    $row['votes'] = $vote_decay;
    $row['image_path'] = 'images/' . basename($row['image_path']); // Update the image path
    $images[] = $row;
}

// Sort the images array by the decayed vote count
usort($images, function ($a, $b) {
    return $a['votes'] <=> $b['votes'];
});

echo json_encode($images);

$db->close();
?>
