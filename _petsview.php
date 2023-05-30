<?php 
    include 'controllers/database.php'; 

    if (!isset($_SESSION['id'])) {
        header('Location: index.php');
    }
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>FIDO</title>
    <link rel="shortcut icon" type="image/png" href="../assets/images/logos/favicon.png" />
    <link rel="stylesheet" href="../assets/css/styles.min.css" />
    <link rel="stylesheet" href="../assets/css/styles.css" />
</head>
<body>
    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">

        <!-- Sidebar Start -->
        <?php require 'components/side-navigation.php'; ?>
        <!--  Sidebar End -->

        <div class="body-wrapper">
            <!--  Header Start -->
            <?php require 'components/header-navigation.php'; ?>
            <!--  Header End -->

            <div class="container-fluid">
                <div class="row">
                    <div class="col">
                        <nav aria-label="breadcrumb" class="bg-light rounded-3 p-3 mb-4">
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item"><a href="home.php">Home</a></li>
                                <li class="breadcrumb-item"><a href="pets.php">All Pets</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Pet Profile</li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <?php
                if (isset($_GET['id'])) :
                    $id = $_GET['id'];
                    $query = mysqli_query($con, "SELECT * FROM pets WHERE petId = $id");
                    $row = mysqli_fetch_assoc($query);
                ?>
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="card mb-4">
                                <div class="card-body d-flex align-items-center justify-content-center text-center">
                                    <img src="<?= $row['photo'] ?>" alt="" style="height: 358px; aspect-ratio: 3/2; object-fit: contain" class="rounded-circle w-100" />
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-8">
                            <form class="card mb-4" method="POST" action="/controllers/controller.php">
                                <div class="card-body">
                                    <h1 class="card-title fw-semibold">PET DETAILS</h1>

                                    <hr>
                                    <div class="row">
                                        <label for="name" class="col-sm-2 col-form-label">Name: </label>
                                        <div class="col-sm-10">
                                            <input type="hidden" class="form-control" name="petId" value="<?= $row['petId'] ?>">
                                            <input type="text" class="form-control" name="name" value="<?= $row['name'] ?>">
                                        </div>
                                    </div>

                                    <hr>
                                    <div class="row">
                                        <label for="type" class="col-sm-2 col-form-label">Type: </label>
                                        <div class="col-sm-10">
                                            <select name="type" class="form-select" required>
                                                <option value="Dog" <?= $row['type'] == 'Dog' ? 'selected' : '' ?> >Dog</option>
                                                <option value="Cat" <?= $row['type'] == 'Cat' ? 'selected' : ''?> >Cat</option>
                                            </select>
                                        </div>
                                    </div>

                                    <hr>
                                    <div class="row">
                                        <label for="age" class="col-sm-2 col-form-label">Age: </label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="age" value="<?= $row['age'] ?>">
                                        </div>
                                    </div>

                                    <hr>
                                    <div class="row">
                                        <label for="status" class="col-sm-2 col-form-label">Status: </label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="status" value="<?= $row['status'] ?>">
                                        </div>
                                    </div>

                                    <hr>
                                    <div class="row">
                                        <label for="availability" class="col-sm-2 col-form-label">Role: </label>
                                        <div class="col-sm-10">
                                            <select name="availability" class="form-select" aria-label="Default select example" required>
                                                <option value="Available" <?= $row['availability'] == 'Available' ? 'selected' : '' ?> >Available</option>
                                                <option value="Not Available" <?= $row['availability'] == 'Not Available' ? 'selected' : ''?> >Not Available</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="container">
                                    <button type="submit" name="update-pet" class="btn btn-primary float-end mb-2 mt-n3">UPDATE</button>
                                    <a href="/controllers/controller.php?delete-pet=<?= $row['petId'] ?>" class="btn btn-outline-danger float-end m-2 mt-n3">DELETE</a>
                                </div>
                            </form>
                        </div>
                    </div>
            </div>
        <?php endif ?>
        </div>
    </div>
    </div>

    <?php include 'scripts.php' ?>
</body>

</html>