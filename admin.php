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
    header('location: ../login.php');
}
// if($_SESSION['usertype'] !== 'admin')
// {
//     header('location: ../login.php');
// }

if(isset($_POST['add_ground']))
{
    $title = $_POST['title'];
    $size = $_POST['size'];
    $capacity = $_POST['capacity'];
    $features = $_POST['features'];
    $status = $_POST['status'];

    $image = $_FILES['image']['name'];
    $img_type = $_FILES['image']['type'];
    $img_size = $_FILES['image']['size'];
    $temp_name = $_FILES['image']['tmp_name'];

    if($img_type !== 'image/jpeg' && $img_type !== 'image/png'
        && $img_type !== 'image/gif')
    {
        die ("Invalid file format!");
    }
    if($img_size > (1024*1024))
    {
        die ("File size limit exceeds! (Max size is 1MB)");
    }

    $qry = "INSERT INTO grounds VALUES (null, '$title', '$size', 
            '$capacity', '$features', $status, '$image')";

    if(!$conn->query($qry))
    {
        die('Error: '. $conn->error);
    }

    move_uploaded_file($temp_name, '../media/'. $image);
    echo '<script>alert("Ground added Successfully")</script>';
}   

if(isset($_GET['gid']))
{
    $qry = "SELECT * FROM grounds WHERE id=".$_GET['gid'];
    $ground_data = $conn->query($qry);
    $ground = $ground_data->fetch_assoc();
    // print_r($ground);
}

if(isset($_POST['update_ground']))
{
    $title = $_POST['title'];
    $size = $_POST['size'];
    $capacity = $_POST['capacity'];
    $features = $_POST['features'];
    $status = $_POST['status'];

    if($_FILES['image']['name'] !== '')
    {
        $image = $_FILES['image']['name'];
        $img_type = $_FILES['image']['type'];
        $img_size = $_FILES['image']['size'];
        $temp_name = $_FILES['image']['tmp_name'];

        if($img_type !== 'image/jpeg' && $img_type !== 'image/png'
            && $img_type !== 'image/gif')
        {
            die ("Invalid file format!");
        }
        if($img_size > (1024*1024))
        {
            die ("File size limit exceeds! (Max size is 1MB)");
        }

        move_uploaded_file($temp_name, '../media/'. $image);
    }
    else
        $image = $ground['image'];

    $qry = "UPDATE grounds SET title='$title', size='$size', 
            capacity='$capacity', features='$features', 
            status=$status, image='$image' WHERE id=". $_GET['gid'];

    if(!$conn->query($qry))
    {
        die('Error: '. $conn->error);
    }

    header('location: grounds.php');
}   

if(isset($_GET['did']))
{
    $qry = "DELETE FROM grounds WHERE id=". $_GET['did'];
    if(!$conn->query($qry))
    {
        die('Error: '. $conn->error);
    }

    echo '<script>alert("Order deleted Successfully")</script>';
}

$qry_select = "SELECT * FROM users";
$grounds = $conn->query($qry_select);

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
                     Coffee Hug Admin Panel
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
                            <h3 class="text-center mt-3">Coffee Hug Dashboard</h3>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 offset-lg-3 mt-5 mb-5">
                            <!-- <form method="post" enctype="multipart/form-data">
                                <div class="form-group mb-3">
                                    <label for="">Title</label>
                                    <input type="text" name="title" class="form-control" 
                                    value="<?php if(isset($_GET['gid']))echo $ground['title']; ?>">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="">Capacity</label>
                                    <input type="text" name="capacity" class="form-control" 
                                    value="<?php if(isset($_GET['gid']))echo $ground['capacity']; ?>">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="">Size</label>
                                    <input type="text" name="size" class="form-control" 
                                    value="<?php if(isset($_GET['gid']))echo $ground['size']; ?>">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="">Image</label>
                                    <input type="file" name="image" class="form-control">
                                    <?php 
                                    if(isset($_GET['gid']))
                                        echo '<img src="../media/'. $ground['image'] .'" alt="" style="height: 100px; width: 100px">';
                                    ?>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="">Features</label>
                                    <textarea name="features" 
                                    class="form-control"><?php if(isset($_GET['gid'])) echo $ground['features'] ?></textarea>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="">Status</label>
                                    <input type="radio" name="status" value="1" id="active" 
                                    <?php if(isset($_GET['gid']) && $ground['status'] == 1) echo 'checked'; ?>>
                                    <label for="active">Active</label>
                                    <input type="radio" name="status" value="0" id="inactive" 
                                    <?php if(isset($_GET['gid']) && $ground['status'] == 0) echo 'checked'; ?>>
                                    <label for="inactive">Inactive</label>
                                </div>
                                <div class="form-group mb-3">
                                    <?php 
                                    if(isset($_GET['gid']))   
                                        echo '<input type="submit" name="update_ground" value="Update Ground"
                                        class="btn btn-primary">';
                                    else
                                        echo '<input type="submit" name="add_ground" value="Add Ground"
                                        class="btn btn-primary">';
                                    ?>
                                </div>
                            </form> -->
                        </div>
                    </div>

                    <div class="row">
                        <div class="table-responsive">
                            
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