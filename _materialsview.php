<?php include 'controllers/database.php'; ?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>FIDO</title>
    <link rel="shortcut icon" type="image/png" href="../assets/images/logos/favicon.png" />
    <link rel="stylesheet" href="../assets/css/styles.min.css" />
</head>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Marcellus&display=swap');

    * {
        font-family: 'Marcellus', serif;
        letter-spacing: .5px;
    }
</style>

<body>
    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">

        <!-- Sidebar Start -->
        <?php require 'side-navigation.php'; ?>
        <!--  Sidebar End -->

        <div class="body-wrapper">
            <!--  Header Start -->
            <?php require 'header-navigation.php'; ?>
            <!--  Header End -->

            <div class="container-fluid">
                <div class="row">
                    <div class="col">
                        <nav aria-label="breadcrumb" class="bg-light rounded-3 p-3 mb-4">
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item"><a href="home.php">Home</a></li>
                                <li class="breadcrumb-item"><a href="materials.php">All Educational Materials</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Material Details</li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <?php
                if (isset($_GET['id'])) :
                    $id = $_GET['id'];
                    $query = mysqli_query($con, "SELECT a.*, b.*, concat(b.firstname, ' ', b.lastname) as fullname FROM educmat a LEFT JOIN users b on a.author = b.userId WHERE matId = $id");
                    $row = mysqli_fetch_assoc($query);
                ?>
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="card mb-4">
                                <div class="card-body d-flex align-items-center justify-content-center text-center">
                                    <img src="<?= $row['photo'] ?>" alt="" style="height: 275px; aspect-ratio: 3/2; object-fit: contain" class="rounded-circle w-100" />
                                </div>
                                <div class="row mx-3 mb-3">
                                    <label class="col-4 ms-3 col-form-label">Name: </label>
                                    <div class="ms-n3 col-8">
                                        <input type="text" readonly class="form-control" value="<?= $row['fullname'] ?>">
                                    </div>
                                </div>

                                <div class="row mx-3 mb-3">
                                    <label class="col-4 ms-3 col-form-label">Address: </label>
                                    <div class="ms-n3 col-8">
                                        <input type="text" readonly class="form-control" value="<?= $row['address'] ?>">
                                    </div>
                                </div>

                                <div class="row mx-3 mb-3">
                                    <label class="col-4 ms-3 col-form-label">Role: </label>
                                    <div class="ms-n3 col-8">
                                        <input type="text" readonly class="form-control" value="<?= $row['role'] ?>">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-8">
                            <form class="card mb-4" method="POST" action="/controllers/controller.php">
                                <div class="card-body">
                                    <h1 class="card-title fw-semibold">MATERIAL DETAILS</h1>
                                        <input type="hidden" class="form-control" name="materialId" value="<?= $row['matId'] ?>">

                                    <hr>
                                    <div class="row">
                                        <label for="title" class="col-sm-2 col-form-label">Title: </label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="title" value="<?= $row['title'] ?>">
                                        </div>
                                    </div>

                                    <hr>
                                    <div class="row">
                                        <label for="date" class="col-sm-2 col-form-label">Age: </label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" readonly name="date" value="<?= $row['datePosted'] ?>">
                                        </div>
                                    </div>

                                    <hr>
                                    <div class="row">
                                        <label for="reference" class="col-sm-2 col-form-label">Reference: </label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="reference" value="<?= $row['reference'] ?>">
                                        </div>
                                    </div>

                                    <hr>
                                    <div class="row">
                                        <label for="content" class="col-sm-2 col-form-label">Content: </label>
                                        <div class="col-sm-10">
                                            <div class="form-floating">
                                                <b><textarea class="form-control" name="content" style="height: 175px"><?= $row['content'] ?></textarea></b>
                                            </div>
                                        </div>
                                    </div>

                                    <hr>
                                    <div class="row">
                                        <label for="status" class="col-sm-2 col-form-label">Status: </label>
                                        <div class="col-sm-10">
                                            <select name="status" class="form-select" aria-label="Default select example" required>
                                                <option value="Published" <?= $row['status'] == 'Published' ? 'selected' : '' ?> >Published</option>
                                                <option value="Unpublished" <?= $row['status'] == 'Unpublished' ? 'selected' : '' ?> >Unpublished</option>
                                            </select>
                                        </div>
                                    </div>

                                </div>
                                <div class="container">
                                    <button type="submit" name="update-material" class="btn btn-primary float-end mb-2 mt-n3">UPDATE</button>
                                    <a href="/controllers/controller.php?delete-material=<?= $row['matId'] ?>" class="btn btn-outline-danger float-end m-2 mt-n3">DELETE</a>
                                </div>
                            </form>
                        </div>
                    </div>

                <?php endif ?>
            </div>
        </div>
    </div>

    <?php include 'scripts.php' ?>
</body>

</html>