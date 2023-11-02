<?php

require_once('PHP/db.php');

session_start();

if(!isset($_GET['book'])) {
    header("Location:index.php");
    die();
}

if(isset($_SESSION['userId'])) {
    $userId = $_SESSION['userId'];
}

$bookId = $_GET['book'];
$_SESSION['bookpage'] = $bookId;


$sqlBook = $connection->prepare("SELECT books.id, books.title, books.picture, books.release_year, books.number_of_pages, authors.name as author_name, authors.surname as author_surname, categories.name, authors.biography as bio FROM `books` JOIN authors ON books.author_id = authors.id JOIN categories ON books.category_id = categories.id WHERE books.id = :id");
$sqlBook->bindParam('id', $bookId);
$sqlBook->execute();
$book = $sqlBook->fetch();


$sqlComments = $connection->prepare("SELECT comments.id as id, comments.book_id, users.username, comments.comment, users.id as user_id, comments.is_approved FROM `comments` JOIN users ON comments.user_id = users.id WHERE book_id = :id");
$sqlComments->bindParam('id', $bookId);
$sqlComments->execute();
$comments = $sqlComments->fetchAll();

$approvedComments = [];
foreach($comments as $comment) {
    if($comment['is_approved'] === 1) {
        array_push($approvedComments, $comment);
    }
}

$sqlSelectUserComment = $connection->prepare("SELECT * FROM comments WHERE book_id = :bookId AND user_id = :userId");
$sqlSelectUserComment->bindParam('bookId', $bookId);
$sqlSelectUserComment->bindParam('userId', $userId);
$sqlSelectUserComment->execute();
$userComment = $sqlSelectUserComment->fetch();


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
    <div class="container-fluid">
        <?php if(isset($_GET['success'])) { ?>
            <p class="h4 text-center text-success my-3" id="msg"><?= $_GET['success'] ?></p>
        <?php } ?>
        <div class="row justify-content-center p-2 p-lg-0">
            <div class="col-12 col-lg-10 p-4 mt-3 rounded bg-secondary-subtle ">
                <div class="row">
                    <div class="col-12 col-lg-6 d-flex mb-lg-0 mb-4">
                        <div class="row">
                            <div class="col-12 col-md-auto mb-0 mb-md-4">
                                <img src="<?= $book['picture'] ?>" alt="img" style="width: 200px;">
                            </div>
                            <div class="col-12 col-md-auto">
                                <p><span class="fw-semibold">Title:</span> <?= $book['title'] ?></p>
                                <p><span class="fw-semibold">Author:</span> <?= $book['author_name'] . ' ' . $book['author_surname'] ?></p>
                                <p><span class="fw-semibold">Release year:</span> <?= $book['release_year'] ?></p>
                                <p><span class="fw-semibold">Number of pages:</span> <?= $book['number_of_pages'] ?></p>
                                <p><span class="fw-semibold">Category:</span> <?= $book['name'] ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-6">
                        <p class="h5 mb-3 px-3">About the Author:</p>
                        <div class="p-3 bg-white rounded">
                            <p><?= $book['bio'] ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php if(isset($_SESSION['username'])) { ?>
    <div class="container-fluid my-3">
        <div class="row justify-content-center p-2 p-lg-0">
            <div class="col-12 col-lg-10 bg-secondary-subtle rounded p-4">
                <p class="h5">Notes</p>
                <div class="my-3">
                    <textarea name="note" id="note" cols="30" rows="2" class="form-control" required></textarea>
                    <button class="btn btn-primary mt-2" id="insert-note-btn" type="submit">Insert note</button>
                </div>
                <div id="notes">
                </div>
            </div>
        </div>
    </div>
    <?php } ?>
    <?php if(isset($_SESSION['username']) && $userComment === false ) { ?>
    <div class="container-fluid my-3">
        <div class="row justify-content-center p-2 p-lg-0">
            <div class="col-12 col-lg-10 bg-secondary-subtle rounded p-4" id="notes">    
                <div class="row">
                    <p class="h5">Write your comment:</p>
                    <form action="PHP/insert-comment.php" method="POST">
                        <input type="hidden" value="<?= $userId ?>" name="userId">
                        <input type="hidden" value="<?= $bookId ?>" name="bookId">
                        <textarea name="comment" cols="30" rows="5" class="form-control my-3"></textarea>
                        <button class="btn btn-primary">Send</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php } ?>
    <div class="container-fluid my-3">
        <div class="row justify-content-center p-2">
            <div class="col-12 col-lg-10 bg-secondary-subtle rounded p-4" id="comments">
                <?php if (empty($approvedComments) && empty($userComment)) { ?>
                <p class="h5">This book has no comments yet.</p>
                <?php } else { ?>
                <p class="h5">Comments</p>

                    <?php foreach($comments as $comment) { ?>
                        <?php if (isset($_SESSION['username']) && $comment['username'] === $_SESSION['username']) { ?>

                        <div class="p-3 bg-white rounded my-3">
                            <p><?= $comment['username'] ?></p>
                            <p><?= $comment['comment'] ?></p>
                            <form action="PHP/delete-user-comment.php" method="POST">
                                <input type="hidden" value="<?= $userId ?>" name="userId">
                                <input type="hidden" value="<?= $bookId ?>" name="bookId">
                                <button class="btn btn-danger" type="submit">Delete Comment</button>
                            </form>
                        </div>

                        <?php } ?>
                        <?php if ($comment['is_approved'] === 1 && !isset($_SESSION['username'])) { ?>

                        <div class="p-3 bg-white rounded my-3">
                            <p><?= $comment['username'] ?></p>
                            <p><?= $comment['comment'] ?></p>
                        </div>

                        <?php } else if ($comment['is_approved'] === 1 && $comment['username'] != $_SESSION['username']) { ?>

                            <div class="p-3 bg-white rounded my-3">
                                <p><?= $comment['username'] ?></p>
                                <p><?= $comment['comment'] ?></p>
                            </div>

                        <?php } ?>
                    <?php } ?>
                <?php } ?>   
            </div>
        </div>
    </div>
    <footer class="bg bg-secondary-subtle p-3 text-center fixed-bottom">
        <p class="fst-italic h6" id="footer-text"></p>
    </footer>
    <script src="JavaScript/quote.js"></script>
    <script src="JavaScript/user-functionality.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>
</html>