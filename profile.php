<?php
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'coffeshop';

$conn = new mysqli($host, $user, $password, $database);

session_start();

if(!isset($_SESSION['username']))
{
    header('location: login.php');
}

if(isset($_POST['update']))
{
    $name = $_POST['name'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $cpassword = $_POST['c-password'];

    $qry = "UPDATE users SET name='$name', 
    email='$email', mobile='$mobile', 
    password='$password' where username='". $_SESSION['username'] ."'";

    if(!$conn->query($qry))
    {
        die('Error: '. $conn->error);
    }

    echo '<script>alert("User profile updated Successfully")</script>';
    echo '<script>window.location.href="index.php"</script>';
}

$qry = "SELECT * FROM users 
        WHERE username='".$_SESSION['username']."'";
$data = $conn->query($qry);
$user = $data->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="style.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>

    <div class="container">
        <header class="row">
            <nav class="navbar navbar-expand-lg bg-body-tertiary">
                <div class="container-fluid">
                    <a class="navbar-brand" href="index.php">
                        Coffee Hug
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    
                </div>
            </nav>
        </header>

        <section class="row">
            <form method="post" class="col-md-4 offset-md-4 mt-5">
                
                <h3 class="text-center mb-3">Update Profile</h3>

                <div class="form-group mb-3">
                    <label for="">Name</label>
                    <input type="text" class="form-control" 
                    name="name" required 
                    value="<?php echo $user['name']; ?>">
                </div>

                <div class="form-group mb-3">
                    <label for="">Email</label>
                    <input type="email" class="form-control" 
                    name="email" required value="<?php echo $user['email']; ?>">
                </div>

                <div class="form-group mb-3">
                    <label for="">Mobile</label>
                    <input type="text" class="form-control" 
                    name="mobile" required value="<?php echo $user['mobile']; ?>">
                </div>

                <div class="form-group mb-3">
                    <label for="">Username</label>
                    <input type="text" class="form-control" 
                    name="username" required maxlength="10" readonly 
                    value="<?php echo $user['username']; ?>">
                </div>

                <div class="form-group mb-3">
                    <label for="">Password</label>
                    <input type="password" class="form-control" 
                    name="password" required minlength="6" 
                    value="<?php echo $user['password']; ?>">
                </div>

                <div class="form-group mb-3">
                    <label for="">Confirm - Password</label>
                    <input type="password" class="form-control" 
                    name="c-password" required value="<?php echo $user['password'] ?>">
                </div>

                <div class="form-group mb-3">
                    <input type="submit" class="btn btn-primary" 
                    name="update" value="Update">
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