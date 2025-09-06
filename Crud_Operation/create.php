<?php
    include 'connect.php';

    $message = "";

    if($_SERVER['REQUEST_METHOD']=="POST"){

        $user = mysqli_real_escape_string($con, $_POST["username"]);
        $email = mysqli_real_escape_string($con, $_POST["email"]);
        $pass = mysqli_real_escape_string($con, $_POST['password']);
        $hashedPassword = password_hash($pass, PASSWORD_DEFAULT);

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
        }elseif(empty($pass)){
            $message = "<div class='alert alert-danger alert-dismissible fade show' role='alert'>Please enter the password
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                        </div>"; 
        }elseif(!preg_match("/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/", $pass)){
            $message = "<div class='alert alert-danger alert-dismissible fade show' role='alert'>Password must be at least 8 characters, include uppercase, lowercase, number & special character
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                        </div>"; 
        }else{
            $sql = "INSERT INTO `users` (`name`, `email`, `password`) VALUES ('$user', '$email', '$hashedPassword')";
            $result = mysqli_query($con, $sql);

            if($result){

                $message = "<div class='alert alert-success'>User register successful..</div>";
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
        <title>Add New User</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
        </head>
        <body class="bg-dark d-flex align-items-center justify-content-center vh-100">

        <div class="card text-white bg-secondary shadow p-4 rounded-4" style="width: 100%; max-width: 450px;">
            <div class="card-body">
            <h2 class="card-title text-center mb-4">Add New User</h2>

            <!-- Display message -->
            <?php if(isset($message)) echo $message; ?>

            <form method="POST">
                <div class="mb-3">
                <label class="form-label">Name</label>
                <input type="text" value="<?php if(isset($_POST['username'])) echo htmlspecialchars($_POST['username']); ?>" class="form-control" name="username" placeholder="Enter your name" required>
                </div>
                <div class="mb-3">
                <label class="form-label">Email address</label>
                <input type="email" value="<?php if(isset($_POST['email'])) echo htmlspecialchars($_POST['email']); ?>" class="form-control" name="email" placeholder="Enter your email" required>
                </div>
                <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" class="form-control" name="password" placeholder="Enter your password" required>
                </div>
                <button type="submit" name="submit" class="btn btn-primary w-100 mb-2">Submit</button>
                <a href="Login.php" class="btn btn-outline-light w-100">Login</a>
            </form>
            </div>
        </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    </body>
    </html>

