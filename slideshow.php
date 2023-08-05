<!DOCTYPE html>
<html>
<head>
    <title>Slideshow Image</title>
    <style>
        /* Styles for the slideshow container */
        .slideshow-container {
            max-width: 500px;
            position: relative;
            margin: auto;
        }
        
        /* Styles for the slideshow images */
        .slideshow-container img {
            width: 100%;
            height: auto;
        }
        
        /* Styles for the previous and next buttons */
        .prev, .next {
            cursor: pointer;
            position: absolute;
            top: 50%;
            width: auto;
            padding: 16px;
            margin-top: -22px;
            color: white;
            font-weight: bold;
            font-size: 18px;
            transition: 0.6s ease;
            border-radius: 0 3px 3px 0;
            user-select: none;
        }
        
        /* Styles for the previous button */
        .prev {
            left: 0;
        }
        
        /* Styles for the next button */
        .next {
            right: 0;
            border-radius: 3px 0 0 3px;
        }
    </style>
</head>
<body>
    <h2>Slideshow Image</h2>
    
    <div class="slideshow-container">
        <?php
        include("config.php");
        
        // Query to retrieve image paths
        $sql = "SELECT image_path FROM images WHERE p_id = 3";
        $result = $con->query($sql);
        
        // Display slideshow images
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $imagePath = $row["image_path"];
                echo '<img src="' . $imagePath . '" class="slide" />';
            }
        } else {
            echo "No images found.";
        }
        
        // Close the connection
        $con->close();
        ?>
        
        <!-- Previous and Next buttons -->
        <a class="prev" onclick="changeSlide(-1)">&#10094;</a>
        <a class="next" onclick="changeSlide(1)">&#10095;</a>
    </div>

    <script>
        var slideIndex = 0;
        showSlide(slideIndex);
        
        function changeSlide(n) {
            showSlide(slideIndex += n);
        }
        
        function showSlide(index) {
            var slides = document.getElementsByClassName("slide");
            
            // Wrap around to the first slide if index exceeds the number of slides
            if (index >= slides.length) {
                slideIndex = 0;
            } else if (index < 0) {
                slideIndex = slides.length - 1;
            }
            
            // Hide all slides
            for (var i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";
            }
            
            // Display the current slide
            slides[slideIndex].style.display = "block";
        }
    </script>
</body>
</html>
