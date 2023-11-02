<?php

require_once('PHP/db.php');
require_once('PHP/functions.php');

checkRequest('admin-page.php');

$id = $_POST['id'];


$sqlSelectBook = $connection->prepare("SELECT books.id, books.title, books.picture, books.release_year, books.number_of_pages, authors.name as author_name, authors.surname as author_surname, categories.name FROM `books` JOIN authors ON books.author_id = authors.id JOIN categories ON books.category_id = categories.id WHERE books.id = :id");
$sqlSelectBook->bindParam("id", $id);
$sqlSelectBook->execute();
$book = $sqlSelectBook->fetch();

$sqlSelectCategory = $connection->prepare("SELECT * FROM categories WHERE is_deleted = 0");
$sqlSelectCategory->execute();
$categories = $sqlSelectCategory->fetchAll();

$sqlSelectAuthors = $connection->prepare("SELECT * FROM authors WHERE is_deleted = 0");
$sqlSelectAuthors->execute();
$authors = $sqlSelectAuthors->fetchAll();


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <title>Edit Book</title>
</head>
<body>
    <div class="p-4">
        <div class="container-fluid p-4 border border-primary rounded">
            <p class="h5 mb-3">Edit Book</p>
            <div class="row mb-5 pb-5">
                <div class="col-12 col-xl-4 d-flex mb-xl-0 mb-4">
                    <div class="me-4">
                        <img src="<?= $book['picture'] ?>" alt="img" style="width: 200px;">
                    </div>
                    <div>
                        <p>Title: <?= $book['title'] ?></p>
                        <p>Author: <?= $book['author_name'] . ' ' . $book['author_surname'] ?></p>
                        <p>Release year: <?= $book['release_year'] ?></p>
                        <p>Number of pages: <?= $book['number_of_pages'] ?></p>
                        <p>Category: <?= $book['name'] ?></p>
                    </div>
                </div>
                <div class="col-12 col-xl-8">
                    <form action="PHP/edit-book.php" method="POST">
                        <div class="row">
                                <div class="col-12 col-lg-6">
                                    <div class="mb-3">
                                        <input type="number" value=<?= $id ?> hidden name="id">
                                        <label class="mb-1">Title:</label>
                                        <input type="text" class="form-control" value="<?= $book['title'] ?>" name="title">
                                    </div>
                                    <div class="mb-3">
                                        <label class="mb-1">Author:</label>
                                        <select class="form-select" name="author-id">
                                            <?php foreach($authors as $author) { ?>
                                                <?php if($author['name'] === $book['author_name']) {?>
                                                    <option selected value="<?= $author['id'] ?>"><?= $author['name']. ' ' .$author['surname'] ?> </option>
                                                <?php } else { ?>
                                                    <option value="<?= $author['id'] ?>"><?= $author['name']. ' ' .$author['surname'] ?> </option>
                                                <?php }?>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="mb-1">Release year:</label>
                                        <input type="number" class="form-control" value="<?= $book['release_year'] ?>" name="year">
                                    </div> 
                                </div>
                                <div class="col-12 col-lg-6">
                                    <div class="mb-3">
                                        <label class="mb-1">Number of pages:</label>
                                        <input type="text" class="form-control" value="<?= $book['number_of_pages'] ?>" name="pages">
                                    </div> 
                                    <div class="mb-3">
                                        <label class="mb-1">Picture:</label>
                                        <input type="text" placeholder="Enter url link..." class="form-control" value="<?= $book['picture'] ?>" name="picture">
                                    </div>
                                    <div class="mb-3">
                                        <label class="mb-1">Category:</label>
                                        <select class="form-select" name="category">
                                        <?php foreach($categories as $category) { ?>
                                            <?php if($category['name'] === $book['name']) {?>
                                                <option selected value="<?= $category['id'] ?>"><?= $category['name'] ?></option>
                                            <?php } else { ?>
                                                <option value="<?= $category['id'] ?>"><?= $category['name'] ?></option>
                                            <?php }?>
                                        <?php } ?>
                                        </select>
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
    </div>
</body>
</html>