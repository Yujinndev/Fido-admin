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
                <div class="col-lg-12 d-flex align-items-stretch">
                    <div class="card w-100">
                        <div class="card-body p-4">
                            <h5 class="card-title fw-semibold mb-4">All Requests</h5>
                            <div class="table-responsive">
                                <table class="table text-nowrap mb-0 align-middle">
                                    <thead class="text-dark fs-4">
                                        <tr>
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">#</h6>
                                            </th>
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">Name of Requester</h6>
                                            </th>
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">Email</h6>
                                            </th>
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">Requested Pet</h6>
                                            </th>
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">Request Status</h6>
                                            </th>
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">Action</h6>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $num = 0;
                                        $result = mysqli_query($con, "SELECT a.*, concat(b.firstname, ' ', b.lastname) as fullname, b.email, b.address, b.photo as userphoto, c.name, c.type, c.photo as petphoto FROM requests a INNER JOIN users b ON a.userId = b.userId INNER JOIN pets c ON a.petId = c.petId");

                                        while ($row = mysqli_fetch_assoc($result)) :
                                        ?>
                                            <tr class="border-bottom">
                                                <td class="border-bottom-0">
                                                    <h6 class="fw-semibold mb-0"><?= '0' . ++$num ?></h6>
                                                </td>
                                                <td class="border-bottom-0">
                                                    <div class="d-flex align-items-center">
                                                        <img src="<?= $row['userphoto'] ?>" alt="" style="width: 45px; height: 45px; aspect-ratio: 3/2; object-fit: contain" class="rounded-circle" />
                                                        <div class="ms-3">
                                                            <h6 class="fw-semibold mb-1"><?= $row['fullname'] ?></h6>
                                                            <span class="fw-normal"><?= $row['address'] ?></span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="border-bottom-0">
                                                    <p class="mb-0 fw-normal"><?= $row['email'] ?></p>
                                                </td>
                                                <td class="border-bottom-0">
                                                    <div class="d-flex align-items-center">
                                                        <img src="<?= $row['petphoto'] ?>" alt="" style="width: 45px; height: 45px; aspect-ratio: 3/2; object-fit: contain" class="rounded-circle" />
                                                        <div class="ms-3">
                                                            <h6 class="fw-semibold mb-1"><?= $row['name'] ?></h6>
                                                            <span class="fw-normal"><?= $row['type'] ?></span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="border-bottom-0">
                                                    <div class="d-flex align-items-center gap-2">
                                                        <span class="badge rounded-3 fw-semibold <?= $row['requestStatus'] == 'Accepted' ? 'bg-primary' : 'bg-danger' ?>"><?= $row['requestStatus'] ?></span>
                                                    </div>
                                                </td>
                                                <td class="border-bottom-0">
                                                    <a class="fw-semibold mb-0 fs-4" href="_requestsview.php?id=<?= $row['requestId'] ?>">View</a>
                                                </td>
                                            </tr>
                                        <?php endwhile; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <?php include 'scripts.php' ?>
</body>

</html>