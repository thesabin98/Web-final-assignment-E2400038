<?php
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'coffeshop';

$conn = new mysqli($host, $user, $password, $database);
session_start();
if($conn->connect_error)
{
    die("Connection Error: ". $conn->connect_error);
}


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
}


if(isset($_POST['login']))
{
    $username = $_POST['username'];
    $password = $_POST['password'];

    $qry = "SELECT * FROM users WHERE username='$username' AND 
            password='$password'";

    $data = $conn->query($qry);
    if($data->num_rows > 0)
    {
        $user = $data->fetch_assoc();
        $_SESSION['username'] = $user['username'];
        $_SESSION['usertype'] = $user['type'];
        header('location: index.php');
        echo '<script>alert("User Logged in Successfully!!!")</script>';

    }
    else
    {
        echo "<script>alert('Wrong Credentials!!!')</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coffee Hug</title>

    
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

     
      <link rel="stylesheet" href="style.css">

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

    



    
    <section class="home" id="home">

        <div class="content">
            <h3>morning hug with a coffee mug.</h3>
            <p>Savor the Story in Every Cup: We Brew Narratives, Not Just Coffee !</p>
            <a href="#" class="btn">get yours now</a>
        </div>

        
        <!-- <form action="#">
            <h3>log in</h3>
            <div class="inputbox">
                <span class="fas fa-envelope"></span>
                <input type="text" placeholder="Email..">
            </div>
            <div class="inputbox">
                <span class="fas fa-key"></span>
                <input type="password" placeholder="Password">
            </div>
            <div class="forget">
                <label><input type="checkbox">Remember me</label>
                <a href="#">Forget password ?</a>
            </div>
            <input type="submit" value="Login" class="btn">
            <div class="register">
                <p>Not a member ? &nbsp; &nbsp;<a href="#">Sign up now</a></p>
            </div>
        </form> -->
        

    </section>
   
    <section class="about" id="about">

        <h1 class="heading"> <span>about</span> us </h1>

        <div class="row">

            <div class="image">
                <img src="Images/aboutus1.jpg" alt="">
            </div>

            <div class="content">
                <h3>what makes our coffee special ?</h3>
                <p>At our newly opened coffee shop,
                    what makes our coffee truly special is the dedication to quality and the care
                     we put into every cup. We source our beans from sustainable farms,
                      ensuring each one is rich in flavor and ethically produced.</p>
                <p>Our expert baristas craft each brew with precision, bringing out the unique notes that make 
                    every sip an experience. Whether you're enjoying a smooth espresso or a creamy 
                    latte, you wll taste the difference that comes from our passion for perfection.</p>
                <a href="#" class="btn">learn more</a>
            </div>
        </div>

    </section>


    <section class="menu" id="menu">

        <h1 class="heading"> Our <span>menu</span></h1>

        <div class="box-container">

            <div class="box">
                <img src="Images/menu1.jpg" alt="">
                <h3>Latte macchiato</h3>
                <div class="price">NPR 359 <span>NPR 399</span></div>
                <a href="product-form.php" class="btn">Buy now</a>
            </div>

            <div class="box">
                <img src="Images/menu3.jpg" alt="">
                <h3>creamy espresso</h3>
                <div class="price">NPR 399 <span>NPR 499</span></div>
                <a href="product-form.php" class="btn">Buy now</a>
            </div>

            <div class="box">
                <img src="Images/menu7.jpg" alt="">
                <h3>classic doppio</h3>
                <div class="price">NPR 399 <span>NPR 499</span></div>
                <a href="product-form.php" class="btn">Buy now</a>
            </div>

            <div class="box">
                <img src="Images/menu4.jpg" alt="">
                <h3>oreo shot</h3>
                <div class="price">NPR 499 <span>NPR 449</span></div>
                <a href="product-form.php" class="btn">Buy now</a>
            </div>

            <div class="box">
                <img src="Images/menu5.jpg" alt="">
                <h3>masala chaai</h3>
                <div class="price">NPR 149 <span>NPR 169</span></div>
                <a href="product-form.php" class="btn">Buy now</a>
            </div>

            <div class="box">
                <img src="Images/menu6.jpg" alt="">
                <h3>mushroom omelet</h3>
                <div class="price">NPR 599 <span>NPR 699</span></div>
                <a href="product-form.php" class="btn">Buy now</a>
            </div>

            <div class="box">
                <img src="Images/menu8.jpg" alt="">
                <h3>Fresh crossants</h3>
                <div class="price">NPR 249 <span>NPR 299</span></div>
                <a href="product-form.php" class="btn">Buy now</a>
            </div>

            <div class="box">
                <img src="Images/menu9.jpg" alt="">
                <h3>exclusive pastries</h3>
                <div class="price">NPR 599 <span>NPR 799</span></div>
                <a href="product-form.php" class="btn">Buy now</a>
            </div>

        </div>

    </section>
    
<section class="products" id="products">

    <h1 class="heading"> our <span>products</span> </h1>

    <div class="box-container">

        <div class="box">
            <div class="icons">
                <a href="#" class="fas fa-shopping-cart"></a>
                <a href="#" class="fas fa-heart"></a>
                <a href="#" class="fas fa-eye"></a>
            </div>
            <div class="image">
                <img src="Images/product1.jpg" alt="">
            </div>
            <div class="content">
                <h3>arabica beans bag</h3>
                <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star-half-alt"></i>
                </div>
                <div class="price">NPR 4999/- <span>NPR 5499/-</span></div>
            </div>
        </div>

        <div class="box">
            <div class="icons">
                <a href="#" class="fas fa-shopping-cart"></a>
                <a href="#" class="fas fa-heart"></a>
                <a href="#" class="fas fa-eye"></a>
            </div>
            <div class="image">
                <img src="Images/product3.jpg" alt="">
            </div>
            <div class="content">
                <h3>Coffee Mugs</h3>
                <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star-half-alt"></i>
                </div>
                <div class="price">NPR 499/- <span>NPR 799/-</span></div>
            </div>
        </div>

        <div class="box">
            <div class="icons">
                <a href="#" class="fas fa-shopping-cart"></a>
                <a href="#" class="fas fa-heart"></a>
                <a href="#" class="fas fa-eye"></a>
            </div>
            <div class="image">
                <img src="Images/product4.jpg" alt="">
            </div>
            <div class="content">
                <h3>Stickers collection Box</h3>
                <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star-half-alt"></i>
                </div>
                <div class="price">NPR 899/- <span>NPR 1199/-</span></div>
            </div>
        </div>

    </div>

</section>

<section class="review" id="review">

    <h1 class="heading"> customer's <span>review</span> </h1>

    <div class="box-container">

        <div class="box">
            <img src="Images/quote1.png" alt="" class="quote">
            <p>"I've finally found my go-to coffee spot! The atmosphere is cozy, the staff is incredibly friendly,
                 and the coffee is simply exceptional. Whether I’m grabbing a quick espresso or lingering over a
                  latte, the quality is consistently top-notch. The attention to detail in every cup really sets this place apart.
                   Highly recommended!"</p>
            <img src="Images/user1.jpg" alt="" class="user">
            <h3>Sabin Budhathoki</h3>
            <div class="stars">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star-half-alt"></i>
            </div>
        </div>

        <div class="box">
            <img src="Images/quote1.png" alt="" class="quote">
            <p>"I absolutely love this coffee shop! The atmosphere is cozy and inviting,
                 and the staff are always friendly and attentive. The coffee is consistently
                  excellent—rich, flavorful, and expertly brewed. Whether I'm grabbing a quick cup
                   to go or sitting down to enjoy a latte with a friend, it's always a great experience.
                   </p>
            <img src="Images/user2.jpeg" alt="" class="user">
            <h3>Samir Baniya</h3>
            <div class="stars">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star-half-alt"></i>
            </div>
        </div>

        <div class="box">
            <img src="Images/quote1.png" alt="" class="quote">
            <p>"Absolutely love this coffee shop! The atmosphere is cozy and welcoming, perfect for
                 a relaxing break or catching up with friends. The coffee is top-notch, brewed to 
                 perfection with rich, bold flavors that keep me coming back. The staff is friendly and
                  always makes you feel at home. Highly recommend their lattes and freshly baked pastries!"</p>
            <img src="Images/user3.jpg" alt="" class="user">
            <h3>Lionel Andrés Messi</h3>
            <div class="stars">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star-half-alt"></i>
            </div>
        </div>

    </div>
</section>


<section class="contact" id="contact">

    <h1 class="heading"> <span>Contact</span> us </h1>


    <div class="row">

        <iframe class="map" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3532.0736105257297!2d85.
        30969617611393!3d27.715013425152208!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.
        1!3m3!1m2!1s0x39eb18fcb77fd4bd%3A0x58099b1deffed8d4!2sThamel%2C%20Kathmandu%2044600!5e0!3m2!1sen!2snp!4v1723725894736!5m2!1sen!2snp" 
        allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>

        <form action="#">
            <h3>get in touch</h3>
            <div class="inputbox">
                <span class="fas fa-user"></span>
                <input type="text" placeholder="name">
            </div>
            <div class="inputbox">
                <span class="fas fa-envelope"></span>
                <input type="email" placeholder="email">
            </div>
            <div class="inputbox">
                <span class="fas fa-phone"></span>
                <input type="number" placeholder="number">
            </div>
            <input type="submit" value="contact now" class="btn">
        </form>

    </div>

</section>

<section class="footer">

    <div class="share">
        <a href="#" class="fab fa-facebook-f"></a>
        <a href="#" class="fab fa-instagram"></a>
        <a href="#" class="fab fa-pinterest"></a>
        <a href="#" class="fab fa-tiktok"></a>
    </div>

    <div class="links">
        <a href="#home">home</a>
        <a href="#about">about</a>
        <a href="#menu">menu</a>
        <a href="#products">products</a>
        <a href="#review">review</a>
        <a href="#contact">contact</a>
        <a href="#">Login/Signup </a>
    </div>

    <div class="credit">created by <span>dai haru</span> | all rights reserved</div>

</section>


    
    







    
     <script src="script.js"></script>
</body>
</html>