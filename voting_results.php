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
        <div id="top-image-grid" class="image-grid">
            <!-- Images will be inserted here by JavaScript -->
        </div>
    </div>

    <div class="section">
        <h3 class="section-title">Bottom 10 Images</h3>
        <div id="bottom-image-grid" class="image-grid">
            <!-- Images will be inserted here by JavaScript -->
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script>
    <script>
        $(document).ready(function() {
            $.getJSON('images.json', function(data) {
                // Sort images based on votes
                data.sort(function(a, b) {
                    return b.votes - a.votes;
                });

                var topImages = data.slice(0, 10);
                var bottomImages = data.slice(-10);

                displayImages(topImages, 'top-image-grid');
                displayImages(bottomImages, 'bottom-image-grid');
            });

            function displayImages(images, containerId) {
                var imageContainer = document.getElementById(containerId);
                imageContainer.innerHTML = '';

                images.forEach(function(image) {
                    var imageWrapper = document.createElement('div');
                    imageWrapper.classList.add('image-grid-item');

                    var img = document.createElement('img');
                    img.src = image.imagePath;
                    img.alt = 'Image';

                    var caption = document.createElement('span');
                    caption.textContent = 'Votes: ' + image.votes;

                    imageWrapper.appendChild(img);
                    imageWrapper.appendChild(caption);
                    imageContainer.appendChild(imageWrapper);
                });
            }

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
