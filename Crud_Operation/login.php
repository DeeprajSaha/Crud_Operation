<?php

session_start();

include 'connect.php';

if(isset($_POST['login'])){

    $email = $_POST['email'];
    $pass = $_POST['password'];

    $sql = "SELECT * FROM `users` WHERE email = '$email'";
    $result = mysqli_query($con, $sql);
    $user = mysqli_fetch_array($result, MYSQLI_ASSOC);
    if($user){
        if(password_verify($pass, $user['password'])){
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['name'];
            header("Location: index.php");
            exit;
        }else{
            echo "<div class='alert alert-warning'>Password does not match</div>";
        }
    }else{
        echo "<div class='alert alert-warning'>Email does not match</div>";
    }
}

?>

<!doctype html>
    <html lang="en">
        <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Login</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
        </head>
        <body class="bg-dark d-flex align-items-center justify-content-center vh-100">

        <div class="card text-dark bg-light shadow p-4 rounded-4" style="width: 100%; max-width: 400px;">
            <div class="card-body">
            <h2 class="card-title text-center mb-4">Login</h2>

            <form method="POST">
                <div class="mb-3">
                <label class="form-label">Email address</label>
                <input type="email" value="<?php if(isset($_POST['email'])) echo htmlspecialchars($_POST['email']); ?>" class="form-control" name="email" placeholder="Enter your email" required>
                </div>
                <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" class="form-control" name="password" placeholder="Enter your password" required>
                </div>
                <button type="submit" name="login" class="btn btn-primary w-100 mb-2">Login</button>
                <a href="create.php" class="btn btn-secondary w-100">Sign up</a>
            </form>

            </div>
        </div>

</body>

    <!-- Bootstrap JS (with Popper.js included) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</html>