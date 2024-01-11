<?php
// Specify the directory to save the uploaded images
$uploadDirectory = "uploads/";
// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the file was uploaded without errors
    if (isset($_FILES["file"]) && $_FILES["file"]["error"] == 0) {
        include "_dbconn.php";
        // Validate file type
        $allowedTypes = ["image/jpg", "image/jpeg", "image/png"];
        if (in_array($_FILES["file"]["type"], $allowedTypes)) {
            // Validate file size (1MB limit in this example)
            if ($_FILES["file"]["size"] <= 1048576) {
                // Generate a unique filename
                $filename = uniqid() . "_" . $_FILES["file"]["name"];
                // Move the uploaded file to the specified directory
                move_uploaded_file($_FILES["file"]["tmp_name"], $uploadDirectory . $filename);
                // insert into database
                $sql = "INSERT INTO `images` (`img_url`) VALUES ('$filename')";
                mysqli_query($conn, $sql);
                header("Location: view.php");
                // Display the uploaded image on the webpage
                echo "<img src='$uploadDirectory$filename' alt='Uploaded Image'>";
            } else {
                echo "Error: File size exceeds the limit (1MB).";
            }
        } else {
            echo "Error: Only JPG, JPEG and PNG files are allowed.";
        }
    } else {
        echo "Error: File upload failed.";
    }
}
?>