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

  @keyframes fade-out {
        0% {
            background-color: transparent; /* Original color */
        }
        20% {
            background-color: #b1fae4; /* Highlight color */
        }
        100% {
            background-color: transparent; /* Original color */
        }
    }

    .fade-out {
        animation: fade-out 7s;
    }
</style>
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
            <?php
                $status = isset($_SESSION['status']) ? $_SESSION['status'] : '';
                $message = isset($_SESSION['message']) ? $_SESSION['message'] : '';
                $alertClass = $status === 'Updated' || $status === 'Inserted' ? 'alert-success' : 'alert-danger';
                unset($_SESSION['status']);
                unset($_SESSION['message']);
                
                if (!empty($status)): ?>
                    <div class="alert <?= $alertClass ?> alert-dismissible fade show" role="alert">
                        <strong><?= $message ?>!</strong> 
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
            <?php endif; ?>
            
                <div class="col-lg-12 d-flex align-items-stretch">
                    <div class="card w-100">
                        <div class="card-body p-4">
                            <h5 class="card-title fw-semibold mb-4">All Educational Materials</h5>
                            <div class="table-responsive">
                                <table class="table text-nowrap mb-0 align-middle">
                                    <thead class="text-dark fs-4">
                                        <tr>
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">#</h6>
                                            </th>
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">Title</h6>
                                            </th>
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">Content</h6>
                                            </th>
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">Date</h6>
                                            </th>
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">Status</h6>
                                            </th>
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">Action</h6>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        $num = 0;
                                        $result = mysqli_query($con, "SELECT a.*, concat(b.firstname, ' ', b.lastname) as fullname FROM educmat a LEFT JOIN users b on a.author = b.userId");

                                        while($row = mysqli_fetch_assoc($result)):
                                            $dt = new DateTime($row['datePosted'], new DateTimeZone('UTC'));
                                            $datePosted = $dt->format('m/d h:i a');
                                            
                                            $rowClass = '';

                                            if (!empty($status) && $row['matId'] == $_SESSION['updatedId']) {
                                                $rowClass = $status === 'Updated' ? 'fade-out' : '';
                                            } 
                                    ?>
                                        <tr class="border-bottom <?= $rowClass ?>">
                                            <td class="border-bottom-0"><h6 class="fw-semibold mb-0"><?= '0' . ++$num ?></h6></td>
                                            <td class="border-bottom-0">
                                                <h6 class="fw-semibold mb-1"><?= $row['title']; ?></h6>
                                                <span class="fw-normal"><?= $row['fullname']; ?></span>                  
                                            </td>
                                            <td class="border-bottom-0">
                                                <p class="mb-0 fw-normal"><?= strlen($row['content']) > 20 ? substr($row['content'], 0, 20) . " ..." : $row['content']; ?></p>
                                            </td>
                                            <td class="border-bottom-0">
                                                <p class="mb-0 fw-normal"><?= $datePosted ?></p>
                                            </td>
                                            <td class="border-bottom-0">
                                                <div class="d-flex align-items-center gap-2">
                                                    <span class="badge rounded-3 fw-semibold <?= $row['status'] == 'Unpublished' ? 'bg-danger' : 'bg-primary' ?>"><?= $row['status']; ?></span>
                                                </div>
                                            </td>
                                            <td class="border-bottom-0">
                                                <a class="fw-semibold mb-0 fs-4" href="_materialsview.php?id=<?= $row['matId'] ?>">View</a>
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
        </div>
    </div>

    <?php include 'scripts.php' ?>
</body>
</html>