<!DOCTYPE html>
<html>
<head>
    <title>Property Cards</title>
    <style>
        .card {
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 10px;
            margin-bottom: 20px;
            width: 300px;
            display: inline-block;
        }
        .card img {
            width: 100%;
            height: auto;
            margin-bottom: 10px;
        }
        .card .title {
            font-weight: bold;
        }
        .card .details {
            margin-bottom: 10px;
        }
        .card .button {
            text-align: center;
            margin-top: 10px;
        }
    </style>
</head>
<body>
<?php
// Assuming you have retrieved the property data from the database
$properties = [
    [
        'property_name' => 'Property 1',
        'price' => 1000,
        'city' => 'City A',
        'uploaded_by' => 'John Doe',
        'images' => ['path/to/image1.jpg', 'path/to/image2.jpg', 'path/to/image3.jpg']
    ],
    [
        'property_name' => 'Property 2',
        'price' => 2000,
        'city' => 'City B',
        'uploaded_by' => 'Jane Smith',
        'images' => ['path/to/image4.jpg', 'path/to/image5.jpg']
    ]
];

foreach ($properties as $property) {
    ?>
    <div class="card">
        <?php foreach ($property['images'] as $image) { ?>
            <img src="<?php echo $image; ?>" alt="Property Image">
        <?php } ?>
        <div class="title"><?php echo $property['property_name']; ?></div>
        <div class="details">
            <div>Price: <?php echo $property['price']; ?></div>
            <div>City: <?php echo $property['city']; ?></div>
            <div>Uploaded By: <?php echo $property['uploaded_by']; ?></div>
        </div>
        <div class="button">
            <button onclick="viewDetails()">View Details</button>
        </div>
    </div>
    <?php
}
?>
<script>
    function viewDetails() {
        // Add your logic for handling the "View Details" button click
        // For example, redirect to a property details page
        // window.location.href = 'property_details.php';
    }
</script>
</body>
</html>
