<?php
$showAlert = false;
$showError = false;
if($_SERVER["REQUEST_METHOD"] == "POST"){
    include 'partials/_dbconnect.php';
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $cpassword = $_POST["cpassword"];
    
    //check whether the username already exists
    $existSql = "select * from users where username ='$username'";
    $result = mysqli_query($conn, $existSql);
    $numExistRows = mysqli_num_rows($result);

    //check whether the email already exists
    $existeSql = "select * from users where email = '$email'";
    $result2 = mysqli_query($conn, $existeSql);
    $numExistRows2 = mysqli_num_rows($result2);

    if($numExistRows >0){
        $showError = "Username Already exists";
    }
    elseif($numExistRows2 >0){
        $showError = "Email Already exists";
    }  
    else{
        if(($password == $cpassword)){
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO `users` (`username`,`email`,`password`) VALUES('$username','$email','$hash')";
            $result = mysqli_query($conn, $sql);
            if($result){
                $showAlert = true;
            }
        }
        else{
            $showError = "passwords do not match.";
        }
    }
}
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Authentication System</title>
</head>

<body>
    <?php require 'partials/_nav.php' ?>
    <?php
    if($showAlert){
        echo'<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> Your account is created and you can now login.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
    }
    if($showError){
        echo'<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Error!</strong> ' .$showError. '
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
    }
    ?>
    <div class="container my-4 col-md-4">
        <h1 class="text-center">Signup to our website</h1>
        <form action="/auth_system/signup.php" method="post">
            <div class="mb-3 ">
                <label for="Username" class="form-label">Username</label>
                <input type="text" class="form-control" maxlength="11" id="Username" name="username" required>
            </div>
            <div class="mb-3 ">
                <label for="Email" class="form-label">Email address</label>
                <input type="email" class="form-control" maxlength="60" id="Email" name="email" aria-describedby="emailHelp" required>
            </div>
            <div class="mb-3 ">
                <label for="Password" class="form-label">Password</label>
                <input type="password" class="form-control" id="Password" name="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>
            </div>
            <div class="mb-3 ">
                <label for="cPassword" class="form-label">Confirm Password</label>
                <input type="password" class="form-control" id="cPassword" name="cpassword" required>
            </div>
            <button type="submit" class="btn btn-primary col-md-12">Sign Up</button>
        </form>
    </div>
    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384
    C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>