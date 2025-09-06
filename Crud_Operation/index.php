<?php 
    session_start();

    include 'connect.php'; 

    if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
    }

    $sql = "SELECT * FROM users";
    $result = mysqli_query($con, $sql);

?>


<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>User Database</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    </head>
    <body class="bg-dark text-white">
        <div class="container mt-5">
            
            <h2 class="mb-4">User Management</h2>

            <a href="logout.php" class="btn btn-danger mb-3">Log Out</a>
            <table class="table table-striped table-bordered table-dark align-middle">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        while($row = mysqli_fetch_assoc($result)){
                            echo "<tr>
                                    <td>{$row['id']}</td>
                                    <td>{$row['name']}</td>
                                    <td>{$row['email']}</td>
                                    <td>
                                        <a href='edit.php?id={$row['id']}' class='btn btn-sm btn-primary me-2'>Edit</a>
                                        <a href='delete.php?id={$row['id']}' class='btn btn-sm btn-danger' 
                                        onclick=\"return confirm('Are you sure you want to delete this user?');\">Delete</a>
                                    </td>
                                </tr>";

                        }
                    ?>
                </tbody>
            </table>
        </div>


        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    </body>
</html>