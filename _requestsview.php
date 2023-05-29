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
                                <li class="breadcrumb-item"><a href="requests.php">All Requests</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Request Detail</li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <?php
                if (isset($_GET['id'])) :
                    $id = $_GET['id'];
                    $query = mysqli_query($con, "SELECT a.*, b.*, c.*, concat(b.firstname, ' ', b.lastname) as fullname, b.photo as userphoto, c.photo as petphoto FROM requests a INNER JOIN users b ON a.userId = b.userId INNER JOIN pets c ON a.petId = c.petId WHERE requestId = $id");
                    $row = mysqli_fetch_assoc($query);
                ?>
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="card mb-4">
                                <div class="card-body d-flex align-items-center justify-content-center text-center">
                                    <img src="<?= $row['userphoto'] ?>" alt="" style="height: 275px; aspect-ratio: 3/2; object-fit: contain" class="rounded-circle w-100" />
                                </div>
                            </div>
                            <div class="card mb-4 mb-lg-0">
                                <div class="card-body p-4">
                                    <h1 class="card-title fw-semibold">PET DETAILS</h1>

                                    <div class="d-flex text-black">
                                        <div class="flex-shrink-0">
                                            <img src="<?= $row['petphoto'] ?>" class="img-fluid mt-2" style="width: 100px; border-radius: 10px;">
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <div class="row mb-1">
                                                <label class="col-4 col-form-label">Name: </label>
                                                <div class="col-8">
                                                    <input type="text" readonly class="form-control" value="<?= $row['name'] ?>">
                                                </div>
                                            </div>

                                            <div class="row mb-1">
                                                <label class="col-4 col-form-label">Type: </label>
                                                <div class="col-8">
                                                    <input type="text" readonly class="form-control" value="<?= $row['type'] ?>">
                                                </div>
                                            </div>

                                            <div class="row mb-1">
                                                <label class="col-4 col-form-label">Age: </label>
                                                <div class="col-8">
                                                    <input type="text" readonly class="form-control" value="<?= $row['age'] ?>">
                                                </div>
                                            </div>

                                            <div class="row mb-1">
                                                <label class="col-4 col-form-label">Status: </label>
                                                <div class="col-8">
                                                    <input type="text" readonly class="form-control" value="<?= $row['status'] ?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-8">
                            <form class="card mb-4" method="POST" action="/controllers/controller.php">
                                <div class="card-body">
                                    <h1 class="card-title fw-semibold">REQUESTER DETAILS</h1>

                                    <hr>
                                    <div class="row">
                                        <label class="col-sm-2 col-form-label">Name: </label>
                                        <div class="col-sm-10">
                                            <input type="hidden" class="form-control" name="requestId" value="<?= $row['requestId'] ?>">
                                            <input type="text" readonly class="form-control" name="name" value="<?= $row['fullname'] ?>">
                                        </div>
                                    </div>

                                    <hr>
                                    <div class="row">
                                        <label for="email" class="col-sm-2 col-form-label">Email: </label>
                                        <div class="col-sm-10">
                                            <input type="email" readonly class="form-control" name="email" value="<?= $row['email'] ?>">
                                        </div>
                                    </div>

                                    <hr>
                                    <div class="row">
                                        <label for="age" class="col-sm-2 col-form-label">Age: </label>
                                        <div class="col-sm-10">
                                            <input type="text" readonly class="form-control" name="age" value="<?= $row['age'] ?>">
                                        </div>
                                    </div>

                                    <hr>
                                    <div class="row">
                                        <label for="address" class="col-sm-2 col-form-label">Address: </label>
                                        <div class="col-sm-10">
                                            <input type="text" readonly class="form-control" name="address" value="<?= $row['address'] ?>">
                                        </div>
                                    </div>

                                    <hr>
                                    <div class="row">
                                        <label for="phone" class="col-sm-2 col-form-label">Phone: </label>
                                        <div class="col-sm-10">
                                            <input type="text" readonly class="form-control" name="phone" value="<?= $row['phoneNum'] ?>">
                                        </div>
                                    </div>

                                    <hr>
                                    <div class="row">
                                        <label for="reason" class="col-sm-2 col-form-label">Reason: </label>
                                        <div class="col-sm-10">
                                            <div class="form-floating">
                                            <b><textarea class="form-control" readonly placeholder="Leave a comment here" name="reason" style="height: 175px"><?= $row['reason'] ?></textarea></b>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="container">
                                    <button type="submit" name="accept-request" class="btn btn-primary float-end mb-2 mt-n3">ACCEPT</button>
                                    <a href="/controllers/controller.php?deny-request=<?= $row['requestId'] ?>" class="btn btn-outline-danger float-end m-2 mt-n3">DENY</a>
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