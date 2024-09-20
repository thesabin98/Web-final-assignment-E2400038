<?php
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'coffeshop';

$conn = new mysqli($host, $user, $password, $database);
session_start();

if(!isset($_SESSION['username']) || 
    $_SESSION['usertype'] !== 'admin')
{
    header('location: signin.php');
}


$qry = "SELECT * FROM orders";
$result = $conn->query($qry);


if(isset($_GET['did']))
{
    $qry = "DELETE FROM orders WHERE pid=". $_GET['did'];
    if(!$conn->query($qry))
    {
        die('Error: '. $conn->error);
    }

    echo '<script>alert("Ground deleted Successfully")</script>';
}

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
                    Coffee Hug Dashboard
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
                            <h3 class="text-center mt-3">Ordered Products</h3>
                        </div>
                    </div>

                    <div class="row">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>PID</th>
                                        <th>firstname</th>
                                        <th>lastname</th>
                                        <th>email</th>
                                        <th>mobile</th>
                                        <th>address</th>
                                        <th>quantity</th>
                                        <th>ordernotes</th>
                                        <th>Status</th>
                                        <th>Select</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php
                                    if($result->num_rows > 0) {
                                        while($row = $result->fetch_assoc()) {
                                            echo "<tr>";
                                            echo "<td>" . $row['pid'] . "</td>";
                                            echo "<td>" . $row['firstname'] . "</td>";
                                            echo "<td>" . $row['lastname'] . "</td>";
                                            echo "<td>" . $row['email'] . "</td>";
                                            echo "<td>" . $row['mobile'] . "</td>";
                                            echo "<td>" . $row['address'] . "</td>";
                                            echo "<td>" . $row['quantity'] . "</td>";
                                            echo "<td>" . $row['ordernotes'] . "</td>";
                                            echo "<td>" . $row['status'] . "</td>";
                                            echo "<td><a href='edit-ordered-products.php?gid=". $row['pid'] ."'>Edit</a></td>
                                                    <td><a href='ordered-products.php?did=". $row['pid'] ."' 
                                                    onclick='return confirm(`Do you want to delete this data?`)'>
                                                    Delete</a></td>";
                                            echo "</tr>";
                                        }
                                    }
                                    else
                                    {
                                        echo "<tr><td colspan='6' class='text-center'>
                                                No Data Available</td></tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
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