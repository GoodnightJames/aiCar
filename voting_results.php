<?php
$db = new mysqli('localhost', 'root', '', 'aiCar');

if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}

$sql = "SELECT id, image_path, votes FROM images";
$result = $db->query($sql);

$images = [];
while ($row = $result->fetch_assoc()) {
    $imagePath = "images/" . basename($row['image_path']); // Assuming the images are stored in the 'images' folder
    $votes = $row['votes'];

    $images[] = [
        'imagePath' => $imagePath,
        'votes' => $votes
    ];
}

// Sort images based on votes
usort($images, function($a, $b) {
    return $b['votes'] - $a['votes'];
});

$top10 = array_slice($images, 0, 10);
$bottom10 = array_slice($images, -10, 10);

$db->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Voting Results</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css">
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }

        .section {
            margin: 50px auto;
            text-align: center;
        }

        .section-title {
            font-size: 20px;
            font-weight: bold;
        }

        .image-grid {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 20px;
            justify-items: center;
            align-items: center;
            margin-top: 20px;
        }

        .image-grid-item {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .image-grid-item img {
            width: 200px;
            height: auto;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="section">
        <h3 class="section-title">Top 10 Images</h3>
        <div class="image-grid">
            <?php foreach ($top10 as $index => $image) : ?>
                <div class="image-grid-item">
                    <a href="<?php echo $image['imagePath']; ?>" data-fancybox="top-group" data-caption="Votes: <?php echo $image['votes']; ?>">
                        <img src="<?php echo $image['imagePath']; ?>" alt="Image">
                    </a>
                    <span>Votes: <?php echo $image['votes']; ?></span>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <div class="section">
        <h3 class="section-title">Bottom 10 Images</h3>
        <div class="image-grid">
            <?php foreach ($bottom10 as $index => $image) : ?>
                <div class="image-grid-item">
                    <a href="<?php echo $image['imagePath']; ?>" data-fancybox="bottom-group" data-caption="Votes: <?php echo $image['votes']; ?>">
                        <img src="<?php echo $image['imagePath']; ?>" alt="Image">
                    </a>
                    <span>Votes: <?php echo $image['votes']; ?></span>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script>
    <script>
        $(document).ready(function() {
            $('[data-fancybox="top-group"]').fancybox({
                infobar: true,
                buttons: [
                    'slideShow',
                    'fullScreen',
                    'thumbs',
                    'close'
                ],
                thumbs: {
                    autoStart: true
                }
            });

            $('[data-fancybox="bottom-group"]').fancybox({
                infobar: true,
                buttons: [
                    'slideShow',
                    'fullScreen',
                    'thumbs',
                    'close'
                ],
                thumbs: {
                    autoStart: true
                }
            });
        });
    </script>
</body>
</html>
