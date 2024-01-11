<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>File Upload</title>
    <style>
        body{
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            min-height: 100vh;
        }
    </style>
</head>
<body>
    <?php if(isset($_GET['error'])):?>
        <p><?php echo $_GET['error'];?></p>
    <?php endif ?>
    <form action="upload.php" method="post" enctype="multipart/form-data">
        <label for="file">Choose an image:</label>
        <input type="file" name="file" id="file" accept=".jpg, .jpeg, .png" required>
        <br>
        <input type="submit" style="background-color:powderblue" value="Upload">
    </form>
</body>
</html>