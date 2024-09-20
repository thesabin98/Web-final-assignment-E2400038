<?php
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'coffeshop';

$conn = new mysqli($host, $user, $password, $database);


if(isset($_POST['register']))
{
    $name = $_POST['name'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $cpassword = $_POST['c-password'];

    $qry = "INSERT INTO users VALUES (null, '$name', '$email', '$mobile', '$username', '$password', 'customer', 1)";

    if(!$conn->query($qry))
    {
        die('Error: '. $conn->error);
    }

    echo '<script>alert("User Registered Successfully")</script>';
    echo '<script>window.location.href="index.php"</script>';
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coffee Hug</title>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
     
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header class="header">

        <a href="index.php" class="logo">
            <img src="Images/logo.png" alt="">
        </a>

        <nav class="navbar">
            <a href="index.php" class="text-decoration-none">home</a>
            <a href="index.php #about" class="text-decoration-none">about</a>
            <a href="index.php #menu" class="text-decoration-none">menu</a>
            <a href="index.php #products" class="text-decoration-none">products</a>
            <a href="index.php #review" class="text-decoration-none">review</a>
            <a href="index.php #contact" class="text-decoration-none">contact</a>
            <!-- <button class="btnLogin-popup">Login</button> -->
            
            <!-- <a href="#login"><button class="btnLogin-popup">Login</button></a> -->
            <a href="signin.php" class="text-decoration-none"><button class="btnRegister-popup">Login</button></a>
        </nav>

        <div class="icons">
            <div class="fas fa-search" id="search-btn"></div>
            <div class="fas fa-shopping-cart" id="cart-btn"></div>
            <div class="fas fa-bars" id="menu-btn"></div>
        </div>

        <div class="search-form">
            <input type="search" id="search-box" placeholder="search here....">
            <label for="search-box" class="fas fa-search"></label>
        </div>

    </header>
    <section class="home" id="home">
        <form method="post" class="col-md-4 offset-md-4" style="margin-top: 100px;">
                
                <h3 class="text-center mb-3 text-light">User Registration</h3>

                <div class="form-group mb-3 text-light">
                    <label for="" class="fs-2">Name</label>
                    <input type="text" class="form-control" name="name" required>
                </div>

                <div class="form-group mb-3 text-light">
                    <label for="" class="fs-2">Email</label>
                    <input type="email" class="form-control" name="email" required>
                </div>

                <div class="form-group mb-3 text-light">
                    <label for="" class="fs-2">Mobile</label>
                    <input type="text" class="form-control" name="mobile" required>
                </div>

                <div class="form-group mb-3 text-light">
                    <label for="" class="fs-2">Username</label>
                    <input type="text" class="form-control" name="username" required maxlength="10">
                </div>

                <div class="form-group mb-3 text-light">
                    <label for="" class="fs-2">Password</label>
                    <input type="password" class="form-control" name="password" required minlength="6">
                </div>

                <div class="form-group mb-3 text-light">
                    <label for="" class="fs-2">Confirm - Password</label>
                    <input type="password" class="form-control" name="c-password" required>
                </div>

                <div class="form-group mb-3">
                    <input type="submit" class="btn btn-light" 
                    name="register" value="Register">
                </div>

                

            </form>
    </section>
    <section class="footer">

        <div class="share">
            <a href="#" class="fab fa-facebook-f text-decoration-none"></a>
            <a href="#" class="fab fa-instagram text-decoration-none"></a>
            <a href="#" class="fab fa-pinterest text-decoration-none"></a>
            <a href="#" class="fab fa-tiktok text-decoration-none"></a>
        </div>
    
        <div class="links">
            <a href="#home" class="text-decoration-none">home</a>
            <a href="#about" class="text-decoration-none">about</a>
            <a href="#menu" class="text-decoration-none">menu</a>
            <a href="#products" class="text-decoration-none">products</a>
            <a href="#review" class="text-decoration-none">review</a>
            <a href="#contact" class="text-decoration-none">contact</a>
            <a href="signin.html" class="text-decoration-none">Login/Signup </a>
        </div>
    
        <div class="credit">created by <span>dai haru</span> | all rights reserved</div>
    
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>