<?php
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'coffeshop';

$conn = new mysqli($host, $user, $password, $database);
session_start();

if (
    !isset($_SESSION['username']) ||
    $_SESSION['usertype'] !== 'admin'
) {
    header('location: ../login.php');
}

$qry = "SELECT * from orders WHERE pid=". $_GET['gid'];
$data = $conn->query($qry);
$order = $data->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>

    <div class="continer-fluid">
        <header class="row bg-dark">
            <div class="col-12">
                <h1 class="text-center text-light">
                    ADA dashboard
                </h1>
            </div>
        </header>

        <div class="row">
            <div class="col-md-3" style="border-right: 1px dotted grey;">
                <div class="list-group">
                    <a href="#" class="list-group-item list-group-item-action active" aria-current="true">
                        Dashboard
                    </a>
                    <!-- <a href="grounds.php" class="list-group-item list-group-item-action">Products</a> -->
                    <a href="ordered-products.php" class="list-group-item list-group-item-action">ordered Products</a>
                    <!-- <a href="#" class="list-group-item list-group-item-action">Users</a> -->
                    <a href="logout.php" class="list-group-item list-group-item-action">Logout</a>

                </div>
            </div>

            <div class="col-md-9">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <h3 class="text-center mt-3">order</h3>
                        </div>
                    </div>

                    <div class="row">
                        
                    </div><form method="post" class="col-md-4 offset-md-4 mt-5">
                
                <h3 class="text-center mb-3">Billing Details</h3>

                <div class="form-group mb-3">
                    <label for="">First-Name</label>
                    <input type="text" class="form-control" name="fname" required value="<?php echo $order['firstname']?>">
                </div>

                <div class="form-group mb-3">
                    <label for="">Last-Name</label>
                    <input type="text" class="form-control" name="lname" required value="<?php echo $order['lastname']?>">
                </div>

                <div class="form-group mb-3">
                    <label for="">Email</label>
                    <input type="email" class="form-control" name="email" required value="<?php echo $order['email']?>">
                </div>

                <div class="form-group mb-3">
                    <label for="">Mobile</label>
                    <input type="text" class="form-control" name="mobile" required maxlength="15" value="<?php echo $order['mobile']?>">
                </div>

                <div class="form-group mb-3">
                    <label for="">Address</label>
                    <input type="text" class="form-control" name="address" required maxlength="100" value="<?php echo $order['address']?>">
                </div>

                <div class="form-group mb-3">
                <label for="quantity">Quantity:</label>
                <input type="number" class="form-control"  name="quantity" value="1" min="1" required value="<?php echo $order['quantity']?>">
                </div>

                <div class="form-group mb-3">
                    <label for="">Order notes</label>
                    <textarea name="order-notes" class="form-control" value="<?php echo $order['ordernotes']?>"></textarea>
                </div>

                <div class="form-group mb-3">
                    <input type="submit" class="btn btn-primary" 
                    name="order" value="Confirm order" onclick="return confirm('Do you want to confirm your order?')">
                </div>

                

            </form>
            
                </div>
            </div>

        </div>

        <footer class="row bg-secondary">
            <div class="col-12">
                <p class="text-center pt-3 text-light">
                    Copyright &copy Reserved
                    <?php echo date('Y'); ?>
                </p>
            </div>
        </footer>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>

</html>