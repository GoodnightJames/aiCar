fetch('images.json')
    .then(response => response.json())
    .then(data => {
        const images = data;

        // Your logic to handle the images data

    })
    .catch(error => console.error(error));
