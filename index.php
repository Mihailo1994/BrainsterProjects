<?php

session_start();

$_SESSION['bookpage'] = '';

require_once(__DIR__ . '/PHP/db.php');

$sqlBooks = $connection->prepare("SELECT books.id, books.title, books.picture, books.release_year, books.number_of_pages, authors.name as author_name, authors.surname as author_surname, categories.name FROM `books` JOIN authors ON books.author_id = authors.id JOIN categories ON books.category_id = categories.id;");
$sqlBooks->execute();
$books = $sqlBooks->fetchAll();

$sqlSelectCategory = $connection->prepare("SELECT * FROM categories WHERE is_deleted = 0");
$sqlSelectCategory->execute();
$categories = $sqlSelectCategory->fetchAll();

$n = 1;

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <title>Library</title>
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
                    <?php if(!isset($_SESSION['username'])) { ?>
                        <li class="nav-item">
                        <a class="nav-link" href="login-page.php">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="register-page.php">Register</a>
                    </li>
                    <?php } else { ?>
                        <li class="nav-item">
                        <a class="nav-link" href="PHP/Logout.php">Logout</a>
                    </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </nav>
    <div class="banner p-5 d-flex align-items-center">
        <p class="text-capitalize">welcome to brainster library</p>
    </div>
    <div class="container-fluid bg-secondary-subtle">
        <div class="row">
            <div class="col">  
                <div class="p-3 d-flex flex-wrap align-items-center">
                    <p class="mb-0 d-inline me-3 fw-bold">Categories:</p>
                    
                    <?php foreach($categories as $category) {?>

                        <div class="btn-group m-2" role="group">
                            <input type="checkbox" class="btn-check" id="category<?= $n ?>" value="<?= $category['name'] ?>">
                            <label class="btn btn-outline-primary" for="category<?= $n ?>"><?= $category['name'] ?></label>
                        </div>

                    <?php $n++ ?>
                    <?php } ?>
                    
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid py-3">
        <div class="row p-3">

            <?php foreach($books as $book) { ?>

            <div class="col-3 mb-5 d-flex justify-content-center book <?= $book['name']?>">
                <a href="book.php?book=<?=$book['id'] ?>" class="text-decoration-none shadow"  style="display:inline-block; width: 250px;">
                    <div class="card">
                        <img src="<?= $book['picture'] ?>" alt="img" style="width: 100%; height: 300px;" class="card-img-top">
                        <div class="card-body">
                            <h5 class="card-title"><?= $book['title'] ?></h5>
                            <p class="card-text mb-0"><span class="fw-bold">Author:</span> <?= $book['author_name'] . ' ' . $book['author_surname'] ?></p>
                            <p class="card-text mb-0"><span class="fw-bold">Category:</span> <?= $book['name'] ?></p>
                            <p class="card-text mb-0"><span class="fw-bold">Release year:</span> <?= $book['release_year'] ?></p>
                        </div>
                    </div>
                </a>
            </div>

            <?php } ?>

        </div>
    </div>
    <footer class="bg bg-secondary-subtle p-3 text-center fixed-bottom">
        <p class="fst-italic h6" id="footer-text"></p>
    </footer>
    <script src="JavaScript/index-page.js"></script>
    <script src="JavaScript/quote.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>
</html>