<?php

session_start();

if(isset($_SESSION['username'])) {
    header("Location:index.php");
    die();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <title>Login Page</title> 
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-secondary-subtle">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">
                <img src="./img/logo.png" alt="" width="30px">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="register-page.php">Register</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12 col-md-8 col-lg-3 m-5">
                <?php if (isset($_GET['err'])) { ?>
                    <p class="text-danger text-capitalize mt-3"><?= $_GET['err']; ?></p>
                <?php } ?>
                <form action="PHP/login.php" method="POST">
                    <div class="mb-4">
                        <label class="mb-1">Username: </label>
                        <input type="text" class="form-control inputs" name="username">
                    </div>
                    <div class="mb-4">
                        <label class="mb-1">Password: </label>
                        <input type="password" class="form-control inputs" name="password">
                    </div>
                    <div class="text-center mb-4 border-bottom pb-4 border-primary">
                        <button type="submit" class="btn btn-primary form-control">Login</button>
                    </div>
                </form>
                <div>
                    <p class="text-center fw-light fst-italic">Create new account</p>
                    <a href="register-page.php" class="btn btn-success form-control">Create Account</a>
                </div>
            </div>
        </div>
    </div>
    <footer class="bg bg-secondary-subtle p-3 text-center fixed-bottom">
        <p class="fst-italic h6" id="footer-text"></p>
    </footer>
    <script src="JavaScript/emptyFields.js"></script>
    <script src="JavaScript/quote.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>
</html>