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
                                <li class="breadcrumb-item"><a href="users.php">All Users</a></li>
                                <li class="breadcrumb-item active" aria-current="page">User Profile</li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <?php
                if (isset($_GET['id'])) :
                    $id = $_GET['id'];
                    $query = mysqli_query($con, "SELECT * FROM users WHERE userId = $id");
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
                                    <h1 class="card-title fw-semibold">USER DETAILS</h1>

                                    <hr>
                                    <div class="row">
                                        <label for="firstname" class="col-sm-2 col-form-label">First Name: </label>
                                        <div class="col-sm-10">
                                            <input type="hidden" class="form-control" name="userId" value="<?= $row['userId'] ?>">
                                            <input type="text" class="form-control" name="firstname" value="<?= $row['firstname'] ?>">
                                        </div>
                                    </div>

                                    <hr>
                                    <div class="row">
                                        <label for="lastname" class="col-sm-2 col-form-label">Last Name: </label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="lastname" value="<?= $row['lastname'] ?>">
                                        </div>
                                    </div>

                                    <hr>
                                    <div class="row">
                                        <label for="email" class="col-sm-2 col-form-label">Email: </label>
                                        <div class="col-sm-10">
                                            <input type="email" class="form-control" name="email" value="<?= $row['email'] ?>">
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
                                        <label for="address" class="col-sm-2 col-form-label">Address: </label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="address" value="<?= $row['address'] ?>">
                                        </div>
                                    </div>

                                    <hr>
                                    <div class="row">
                                        <label for="phone" class="col-sm-2 col-form-label">Phone: </label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="phone" value="<?= $row['phoneNum'] ?>">
                                        </div>
                                    </div>

                                    <hr>
                                    <div class="row">
                                        <label for="role" class="col-sm-2 col-form-label">Role: </label>
                                        <div class="col-sm-10">
                                            <select name="role" class="form-select" aria-label="Default select example" required>
                                                <option value="Admin" <?= $row['role'] == 'Admin' ? 'selected' : '' ?> >Admin</option>
                                                <option value="User" <?= $row['role'] == 'User' ? 'selected' : ''?> >User</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="container">
                                    <button type="submit" name="update-user" class="btn btn-primary float-end mb-2 mt-n3">UPDATE</button>
                                    <a href="/controllers/controller.php?delete-user=<?= $row['userId'] ?>" class="btn btn-outline-danger float-end m-2 mt-n3">DELETE</a>
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