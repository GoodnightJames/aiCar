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
