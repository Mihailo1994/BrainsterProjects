<?php 


$host = "localhost";
$dbname = "employment";
$username = "root";
$password = "";

$conn = mysqli_connect(hostname: $host, username: $username, password: $password, database: $dbname);

if(!$conn){
    echo 'Connection error: ' , mysqli_connect_error();
}

$sql = 'SELECT company.name as name, company.company_name as cname, company.email as email, company.phone_number as pno, student.student_type as st FROM company
JOIN student ON student.id = company.student_type';

$result = mysqli_query($conn, $sql);

$companies = mysqli_fetch_all($result, MYSQLI_ASSOC);


?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Brainster Labs</title>
    <link rel="stylesheet" href="./main.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/64087b922b.js" crossorigin="anonymous"></script>
</head>

<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg bg-yellow px-lg-5 px-3 py-4">
        <a class="navbar-brand" href="./index.html"><img src="./img/Logo.png" alt="Logo" class="logo-size"></a>
        <button class="navbar-toggler" type="button" data-toggle="modal" data-target="#navbarDropdown" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fa-solid fa-bars text-dark f-size-2"></i>
        </button>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link text-dark font-weight-bold px-3" href="https://brainster.co/marketing/">Академија за маркетинг</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark font-weight-bold px-3" href="https://brainster.co/full-stack/">Академија за програмирање</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark font-weight-bold px-3" href="https://brainster.co/data-science/">Академија за data science</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark font-weight-bold px-3" href="https://brainster.co/graphic-design/">Академија за дизајн</a>
                </li>
                <li class="nav-item ml-5">
                    <a class="nav-link text-white font-weight-bold bg-red rounded px-4 hire-btn" href="./employment.html">Вработи наш студент</a>
                </li>
            </ul>
        </div>
    </nav>
    <!-- Clients -->
    <div class="container-fluid bg-yellow py-5 clients">
        <div class="row mb-5">
            <div class="col text-center">
                <p class="font-weight-bold h1">Клиенти</p>
            </div>
        </div>
        <?php foreach($companies as $company){ ?>
            <div class="row justify-content-center font-weight-bold">
                <div class="col-11">
                    <div class="row border border-dark rounded p-3">
                        <div class="col">
                            <p>Име и презиме:</p>
                            <p><?php echo htmlspecialchars($company['name']); ?></p>
                        </div>
                        <div class="col">
                            <p>Име на компанијата:</p>
                            <p><?php echo htmlspecialchars($company['cname']); ?></p>
                        </div>
                        <div class="col">
                            <p>Email:</p>
                            <p><?php echo htmlspecialchars($company['email']); ?></p>
                        </div>
                        <div class="col">
                            <p>Телефонски број:</p>
                            <p><?php echo htmlspecialchars($company['pno']); ?></p>
                        </div>
                        <div class="col">
                            <p>Тип на студент:</p>
                            <p><?php echo htmlspecialchars($company['st']); ?></p>
                        </div>
                    </div> 
                </div>
            </div>                               
        <?php } ?>
    </div>
    <!-- Footer -->
    <div class="container-fluid text-center bg-dark-custom text-white font-weight-bold py-3">
        <p class="mb-0">Изработено со <i class="fa-solid fa-heart text-danger"></i> од студентите на Brainster</p>
    </div>



    <div class="modal fade w-100 bg-dark-custom" id="navbarDropdown" tabindex="-1" role="dialog" aria-labelledby="navbarDropdown" aria-hidden="true">
        <div class="modal-dialog w-100 m-0" role="document">
            <div class="modal-content bg-dark-custom w-100">
                <div class="modal-header">
                    <button type="button" class="close text-white f-size-2" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="f-size-2">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link text-white font-weight-bold px-3" href="https://brainster.co/marketing/">Академија за маркетинг</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white font-weight-bold px-3" href="https://brainster.co/full-stack/">Академија за програмирање</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white font-weight-bold px-3" href="https://brainster.co/data-science/">Академија за data science</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white font-weight-bold px-3" href="https://brainster.co/graphic-design/">Академија за дизајн</a>
                        </li>
                        <li class="nav-item ml-3">
                            <a class="nav-link text-white font-weight-bold bg-red rounded d-inline-block px-2" href="./employment.html">Вработи наш студент</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN"
        crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"
        integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous">
        </script>
</body>
</html>