<?php
    include 'connect.php';

    $message = "";

    if(isset($_POST['submit'])){

        $user = $_POST["username"];
        $email = $_POST["email"];

        if(empty($user) && empty($email)){
            $message = "<div class='alert alert-danger alert-dismissible fade show' role='alert'>Please enter username and email
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                        </div>";
        } elseif(empty($user)){
            $message = "<div class='alert alert-danger alert-dismissible fade show' role='alert'>Please enter username
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                        </div>";
        } elseif (empty($email)) {
            $message = "<div class='alert alert-danger alert-dismissible fade show' role='alert'>Please enter email
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                        </div>";
        }elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $message = "<div class='alert alert-danger alert-dismissible fade show' role='alert'>Please enter a valid email
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                        </div>";
        }else{
            $sql = "INSERT INTO `users` (`name`, `email`) VALUES ('$user', '$email')";
            $result = mysqli_query($con, $sql);

            if($result){
                header("Location: index.php?msg=User+added+successfully");
                echo "User registered successfully!";
                exit;
            }else{
                $message = "<div class='alert alert-danger'>Failed to register user...</div>";
            }
        }

    }
?>

<!doctype html>
    <html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Create User</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body class="bg-dark text-white">
    <div class="container mt-5">
        <h2>Add New User</h2>

        <?php echo $message; ?>

        <form method="POST">
            <div class="mb-3">
                <label class="form-label">Name</label>
                <input type="text" class="form-control" name="username" placeholder="Enter your name">
            </div>
            <div class="mb-3">
                <label class="form-label">Email address</label>
                <input type="email" class="form-control" name="email" placeholder="Enter your email">
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
            <a href="index.php" class="btn btn-secondary">Back</a>
        </form>
    </div>
    </body>
</html>
