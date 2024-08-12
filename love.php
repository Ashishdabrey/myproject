<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "photo_shop_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Photo Upload Handling
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['photo'])) {
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["photo"]["name"]);
    move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file);

    $caption = $_POST['caption'];
    $upload_date = date('Y-m-d');
    $sql = "INSERT INTO photos (photo_path, caption, upload_date) VALUES ('$target_file', '$caption', '$upload_date')";
    $conn->query($sql);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400;700&display=swap">

    <title>Photo Album</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            text-align: center;
        }

        h1, h2 {
            color: #333;
            font-family: 'Dancing Script', cursive;
        }
h2{
    font-size: 60px;
}
        form {
            margin: 20px auto;
            padding: 10px;
            background: #fff;
            border: 1px solid #ddd;
            display: flex;
            flex-direction: column;
            padding: 0;
            width: 30%;
            justify-items: center;
        }

        .photo-gallery {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
        }

        .photo {
            border: 1px solid #ccc;
            padding: 10px;
            background: #fff;
        }

        .photo img {
            max-width: 200px;
            max-height: 200px;
            object-fit: cover;
        }
        h1{
            font-size: 80px;
            font-family: 'Dancing Script', cursive;
        }
    </style>
</head>
<body>
    <h1>Ashish ❤️ Anjali</h1>
    <form action="" method="post" enctype="multipart/form-data">
        
        <div>
        <label for="photo">Upload Photo:</label>
        <input type="file" name="photo" id="photo" required>
        </div>
        <div>
        <label for="caption">Caption:</label>
        <input type="text" name="caption" id="caption" required>
        </div>
        <div>
        <button type="submit">Save Photo</button>
        </div>
    </form>

    <h2>Your Memories</h2>
    <div class="photo-gallery">
        <?php
        $sql = "SELECT * FROM photos ORDER BY upload_date DESC";
        $result = $conn->query($sql);
        while ($row = $result->fetch_assoc()) {
            echo "<div class='photo'>";
            echo "<img src='" . $row['photo_path'] . "' alt='Photo'>";
            echo "<p>" . $row['caption'] . "</p>";
            echo "</div>";
        }
        ?>
    </div>
</body>
</html>
