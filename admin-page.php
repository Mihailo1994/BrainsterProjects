<?php

require_once('PHP/db.php');

session_start();

if($_SESSION['admin'] != true ) {
    header("Location:index.php");
    die();
}


$sqlSelectCategory = $connection->prepare("SELECT * FROM categories WHERE is_deleted = 0");
$sqlSelectCategory->execute();
$categories = $sqlSelectCategory->fetchAll();

$sqlSelectAuthors = $connection->prepare("SELECT * FROM authors WHERE is_deleted = 0");
$sqlSelectAuthors->execute();
$authors = $sqlSelectAuthors->fetchAll();

$sqlBooks = $connection->prepare("SELECT books.id, books.title, books.picture, books.release_year, books.number_of_pages, authors.name as author_name, authors.surname as author_surname, categories.name FROM `books` JOIN authors ON books.author_id = authors.id JOIN categories ON books.category_id = categories.id;");
$sqlBooks->execute();
$books = $sqlBooks->fetchAll();

$sqlComments = $connection->prepare("SELECT comments.id as id, comments.book_id, users.username, comments.comment, users.id as user_id, comments.is_approved FROM `comments` JOIN users ON comments.user_id = users.id;");
$sqlComments->execute();
$comments = $sqlComments->fetchAll();


?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <title>Admin Page</title>
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
                        <a class="nav-link" href="PHP/logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container-fluid p-4">
        <div class="row border border-primary rounded p-4">
            <div class="col-md-6 col-12 mb-4 mb-md-0">
                <p class="h5 mb-3">Insert new category</p>
                <form action="PHP/insert-category.php" method="POST">
                    <div class="form-group mb-3">
                        <input type="text" class="form-control"  placeholder="Category name..." name="name" required>
                    </div>
                    <button type="submit" class="btn btn-primary mb-2">Submit</button>
                </form>
            </div>
            <div class="col-12 col-md-6">
                <form action="PHP/delete-category.php" method="POST" id="delete-category">
                    <p class="h5 mb-3">Select category</p>
                    <div class="mb-3">
                        <select class="form-select" name="id" id="select-category">
                            <option selected disabled>Select...</option>
                        <?php foreach($categories as $value) { ?>
                            <option value="<?= $value['id'] ?>"><?= $value['name'] ?></option>
                        <?php } ?>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-danger">Delete</button>
                    <button class="btn btn-warning" id="edit-category-btn">Edit</button>
                </form>
                <form id="edit-category" action="PHP/edit-category.php" method="POST" class="d-none">
                    <p class="h5 mb-3">Edit category</p>
                    <div class="form-group mb-3">
                        <input type="number" hidden id="category-id" name="id">
                        <input type="text" class="form-control"  placeholder="Category name..." name="name" id="edit-category-name" required>
                    </div>
                    <button type="submit" class="btn btn-primary mb-2">Edit</button>
                </form>
            </div>
        </div>
    </div>
    <div class="container-fluid p-4">
        <div class="row border border-primary rounded p-4">
            <div class="col-12 col-md-6 mb-4 mb-md-0">
                <p class="h5 mb-3">Insert new author</p>
                <form action="PHP/insert-author.php" method="POST" id="insert-author-form">
                    <div class="row">
                        <div class="col-auto">
                            <div class="mb-3">
                                <label class="mb-1">Name:</label>
                                <input type="text" class="form-control" required name="name">
                            </div>
                            <div class="mb-3">
                                <label class="mb-1">Surname:</label>
                                <input type="text" class="form-control mb-2" required name="surname">
                            </div>
                            <div class="mb-3">
                                <label class="mb-1">Biography:</label>
                                <textarea cols="30" rows="5" placeholder="Enter short biography..." class="form-control" name="bio" id="bio"></textarea>
                            </div>  
                            <button class="btn btn-primary" type="submit">Submit</button>
                        </div>    
                    </div>
                </form>
            </div>
            <div class="col-12 col-md-6">
                <form action="PHP/delete-author.php" method="POST" id="delete-author">
                    <p class="h5 mb-3">Select author</p>
                    <div class="mb-3">
                        <select class="form-select" id="select-author" name="id">
                            <option selected disabled>Select...</option>
                            <?php foreach($authors as $author) { ?>
                            <option value="<?= $author['id'] ?>"><?= $author['name']. ' ' .$author['surname'] ?> </option>
                            <?php } ?>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-danger">Delete</button>
                    <button type="submit" class="btn btn-warning" id="edit-author-btn">Edit</button>
                </form>
                <form class="d-none" id="edit-author" method="POST" action="PHP/edit-author.php">
                    <p class="h5 mb-3">Edit author</p>
                    <div class="row">
                        <div class="col-auto">
                            <div class="mb-3">
                                <label class="mb-1">Name:</label>
                                <input type="text" class="form-control" id="edit-name" name="name">
                            </div>
                            <div class="mb-3">
                                <label class="mb-1">Surname:</label>
                                <input type="text" class="form-control mb-2" id="edit-surname" name="surname">
                            </div>
                            <div class="mb-3">
                                <label class="mb-1">Biography:</label>
                                <textarea cols="30" rows="5" class="form-control" id="edit-bio" name="bio"></textarea>
                            </div>
                            <input type="text" name="id" id="edit-id" hidden>   
                            <button class="btn btn-primary" type="submit">Edit</button>
                        </div>    
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="container-fluid p-4">
        <div class="row border border-primary rounded p-4">
            <div class="col">
                <p class="h5 mb-3">Insert new book</p>
                <form action="PHP/insert-book.php" method="POST">
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <div class="mb-3">
                                <label class="mb-1">Title:</label>
                                <input type="text" class="form-control" required name="title">
                            </div>
                            <div class="mb-3">
                                <label class="mb-1">Author:</label>
                                <select class="form-select" name="author-id">
                                    <option selected disabled>Select...</option>
                                    <?php foreach($authors as $author) { ?>
                                    <option value="<?= $author['id'] ?>"><?= $author['name']. ' ' .$author['surname'] ?> </option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="mb-1">Release year:</label>
                                <input type="number" class="form-control" required name="year">
                            </div> 
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="mb-3">
                                <label class="mb-1">Number of pages:</label>
                                <input type="number" class="form-control" required name="pages">
                            </div> 
                            <div class="mb-3">
                                <label class="mb-1">Picture:</label>
                                <input type="text" placeholder="Enter url link..." class="form-control" required name="picture">
                            </div>
                            <div class="mb-3">
                                <label class="mb-1">Category:</label>
                                <select class="form-select" name="category">
                                    <option selected disabled>Select...</option>
                                <?php foreach($categories as $value) { ?>
                                    <option value="<?= $value['id'] ?>"><?= $value['name'] ?></option>
                                <?php } ?>
                                </select>
                            </div>  
                        </div>  
                        <div class="row">
                            <div class="col">
                                <button class="btn btn-primary" type="submit">Submit</button>
                            </div>
                        </div>  
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="container-fluid p-4">
        <div class="row border border-primary rounded p-4">
            <p class="h5 mb-3">Books</p>
            <?php $n = 1 ?>
            <?php foreach ($books as $book) { ?>
            <div class="row mb-5 border-bottom pb-5">
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
                            <button type="submit" class="btn btn-danger delete-book">Delete</button>
                            <input hidden value="<?= $book['id'] ?>">
                            <form action="edit-book-page.php" method="POST" class="d-inline">
                                <button type="submit" class="btn btn-warning">Edit</button>
                                <input hidden value="<?= $book['id'] ?>" name="id">
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-6">
                    <p class="h5 mb-3">Comments:</p>
                    <button class="btn btn-primary show-comments-btn">Show/hide comments</button>
                    <div class="d-none comments">
                        <div class="mt-2 mb-2">
                            <div class="d-inline m-2">
                                <input type="radio" name="comments-filter-<?= $n ?>" class="all-comments" checked>
                                <label for="all-comments">All comments</label>
                            </div>
                            <div class="d-inline m-2">
                                <input type="radio" name="comments-filter-<?= $n ?>" class="approved-comments">
                                <label for="approved-comments">Approved</label>
                            </div>
                            <div class="d-inline m-2">
                                <input type="radio" name="comments-filter-<?= $n ?>" class="declined-comments">
                                <label for="declined-comments">Declined</label>
                            </div>
                            <div class="d-inline m-2">
                                <input type="radio" name="comments-filter-<?= $n ?>" class="pending-comments">
                                <label for="pending-comments">Pending</label>
                            </div>
                        </div>
                        <?php foreach($comments as $comment) { if($comment['book_id'] === $book['id']) { ?>
                            <?php if($comment['is_approved'] === NULL) {?> 
                                <div class="border rounded p-2 mb-3 pending comment">
                                    <p class="text-warning">Pending..</p>
                                    <p><?= $comment['username'] ?></p>
                                    <p><?= $comment['comment'] ?></p>
                                    <form action="PHP/manage-comment.php" method="POST" class="d-inline">
                                        <input type="number" hidden value="<?= $comment['id'] ?>" name="id">
                                        <input type="text" hidden name="status" value="approve">
                                        <button class="btn btn-success" type="submit">Approve</button>
                                    </form>
                                    <form action="PHP/manage-comment.php" method="POST" class="d-inline">
                                        <input type="number" hidden value="<?= $comment['id'] ?>" name="id">
                                        <input type="text" hidden name="status" value="decline">
                                        <button class="btn btn-danger" type="submit">Decline</button>
                                    </form>
                                </div>
                            <?php } elseif ($comment['is_approved'] === 0) { ?>
                                <div class="border rounded p-2 mb-3 declined comment">
                                    <p class="text-danger">Declined</p>
                                    <p><?= $comment['username'] ?></p>
                                    <p><?= $comment['comment'] ?></p>
                                    <form action="PHP/manage-comment.php" method="POST">
                                        <input type="number" hidden value="<?= $comment['id'] ?>" name="id">
                                        <input type="text" hidden name="status" value="approve">
                                        <button class="btn btn-success" type="submit">Approve</button>
                                    </form>
                                </div>
                            <?php } elseif ($comment['is_approved'] === 1 ) { ?>
                                <div class="border rounded p-2 mb-3 approved comment">
                                    <p class="text-success">Approved</p>
                                    <p><?= $comment['username'] ?></p>
                                    <p><?= $comment['comment'] ?></p>
                                    <form action="PHP/manage-comment.php" method="POST">
                                        <input type="number" hidden value="<?= $comment['id'] ?>" name="id">
                                        <input type="text" hidden name="status" value="decline">
                                        <button class="btn btn-danger" type="submit">Decline</button>
                                    </form>
                                </div>
                            <?php } ?>    
                        <?php } } ?>
                    </div>
                </div>
            </div>
            <?php $n++ ?>
            <?php } ?>
        </div> 
    </div>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>                            
    <script src="JavaScript/admin.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>
</html>