<?php
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'coffeshop';

$conn = new mysqli($host, $user, $password, $database);

if($conn->connect_error)
{
    die("Connection Error: ". $conn->connect_error);
}

session_start();

if(!isset($_SESSION['username']))
{
    header('location: signin.php');
}

if(isset($_POST['order']))
{
    $first_name = $_POST['fname'];
    $last_name = $_POST['lname'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $address = $_POST['address'];
    $quantity = $_POST['quantity'];
    $order_notes = $_POST['order-notes'];
    $status = "requested";


    $qry = "INSERT INTO orders (pid, firstname, lastname, email, mobile, address, quantity, ordernotes, status) 
        VALUES (NULL, '$first_name', '$last_name', '$email', '$mobile', '$address', $quantity, '$order_notes', '$status')";


    if(!$conn->query($qry))
    {
        die('Error: '. $conn->error);
    }

    echo '<script>alert("Your order has been requested Successfully")</script>';
    echo '<script>window.location.href="index.php"</script>';
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="style.css" rel="stylesheet">
    <link rel="stylesheet" href="product.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
<header class="header">

<a href="#" class="logo">
    <img src="Images/logo.png" alt="">
</a>

<nav class="navbar">
    <a href="#home">home</a>
    <a href="#about">about</a>
    <a href="#menu">menu</a>
    <a href="#products">products</a>
    <a href="#review">review</a>
    <a href="#contact">contact</a>
    <!-- <button class="btnLogin-popup">Login</button> -->
    
    
    <?php 
    if(isset($_SESSION['username'])) {
    ?>   
    <a href="profile.php"><button class="btnLogin-popup">Profile</button></a>
    <a href="logout.php"><button class="btnRegister-popup">Log Out</button></a>

    <?php } else { ?>
    <a href="signin.php"><button class="btnLogin-popup">Login</button></a>
    <a href="register.php"><button class="btnRegister-popup">Register</button></a>
    <?php } ?>
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

<div class="cart-items-container">
    <div class="cart-item">
        <span class="fas fa-times"></span>
        <img src="Images/cart-item-1.jpg" alt="">
        <div class="content">
            <h3>arabica beans</h3>
            <div class="price">NPR 4999/-</div>
        </div>
    </div>
    <div class="cart-item">
        <span class="fas fa-times"></span>
        <img src="Images/cart-item-2.jpg" alt="">
        <div class="content">
            <h3>robusta beans</h3>
            <div class="price">NPR 2999/-</div>
        </div>
    </div>
    <div class="cart-item">
        <span class="fas fa-times"></span>
        <img src="Images/cart-item-3.jpg" alt="">
        <div class="content">
            <h3>liberica beans</h3>
            <div class="price">NPR 1999/-</div>
        </div>
    </div>
    <div class="cart-item">
        <span class="fas fa-times"></span>
        <img src="Images/cart-item-4.jpg" alt="">
        <div class="content">
            <h3>excelsa beans</h3>
            <div class="price">NPR 3999/-</div>
        </div>
    </div>
    <a href="#" class="btn">checkout now</a>
</div>
</header>

    <div class="container">  
        <section class="row">
        <form method="post" class="col-md-4 offset-md-4" style="margin-top: 100px;">
                
                <h3 class="text-center mb-3">Billing Details</h3>

                <div class="form-group mb-3">
                    <label for="">First-Name</label>
                    <input type="text" class="form-control" name="fname" required>
                </div>

                <div class="form-group mb-3">
                    <label for="">Last-Name</label>
                    <input type="text" class="form-control" name="lname" required>
                </div>

                <div class="form-group mb-3">
                    <label for="">Email</label>
                    <input type="email" class="form-control" name="email" required>
                </div>

                <div class="form-group mb-3">
                    <label for="">Mobile</label>
                    <input type="text" class="form-control" name="mobile" required maxlength="15">
                </div>

                <div class="form-group mb-3">
                    <label for="">Address</label>
                    <input type="text" class="form-control" name="address" required maxlength="100">
                </div>

                <div class="form-group mb-3">
                <label for="quantity">Quantity:</label>
                <input type="number" class="form-control"  name="quantity" value="1" min="1" required>
                </div>

                <div class="form-group mb-3">
                    <label for="">Order notes</label>
                    <textarea name="order-notes" class="form-control"></textarea>
                </div>

                <div class="form-group mb-3">
                    <input type="submit" class="btn btn-primary" 
                    name="order" value="Request for order" onclick="return confirm('Do you want to confirm your order?')">
                </div>

                

            </form>
            
        </section>

        <footer class="row bg-body-tertiary">
            <div class="col-12">
                <p class="text-center pt-3">
                    Copyright &copy Reserved 
                    <?php echo date('Y'); ?>
                </p>
            </div>
        </footer>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>