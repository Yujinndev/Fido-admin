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

                <div class="row">
                    <h1 class="card-title fw-semibold m-3 mb-1">All Item Donations</h1>

                    <div class="container d-flex justify-content-center flex-wrap align-items-center">
                    
                    <?php
                        $num = 0;
                        $result = mysqli_query($con, "SELECT * FROM itemdonations");

                        while ($row = mysqli_fetch_assoc($result)) :
                            $percentage = ($row['currentStocks'] / $row['quarterlyStocks']) * 100;
                            $formattedPercentage = number_format($percentage, 2) . '%';
                            $rowClass = '';

                            if (!empty($status) && $row['itemId'] == $_SESSION['updatedId']) {
                                $rowClass = $status === 'Updated' ? 'fade-out' : '';
                            } 
                    ?>
                            <div class="container-fluid d-flex w-75 m-2 border border-light rounded-3 overflow-hidden <?= $rowClass ?>">
                                <div class="container-fluid w-50 bg-light p-4 m-0">
                                    <img src="<?= isset($row['photo']) ? $row['photo'] : 'https://www.warnersstellian.com/Content/images/product_image_not_available.png' ?>" alt="photo" style="height: 180px; aspect-ratio: 3/2; object-fit: contain; max-width: 100%; filter: drop-shadow(0px 0px 1px rgb(255, 255, 255)); margin-bottom: 10px;" class="w-100" />
                                </div>
                                <div class="course-info">
                                    <div class="progress-container">
                                        <div class="progress">
                                            <div class="filler" style="width: <?= $formattedPercentage ?>"></div>
                                        </div>
                                        <span class="progress-text"><?= $row['currentStocks'] . '/' . $row['quarterlyStocks'] ?> Stocks</span>
                                    </div>
                                    <h6>Item #<?= ++$num ?></h6>
                                    <h2><?= $row['name'] ?></h2>
                                    <p><?= $row['description'] ?></p>
                                    <a href="_donationsview.php?id=<?= $row['itemId'] ?>" class="d-block f-2 mt-2 btn btn-outline-dark float-end">View more</a>
                                </div>
                            </div>

                        <?php endwhile ?>
                    </div>
                </div>
            </div>
            <a href="insert-data.php?table=itemdonations" class="btn btn-primary floating-button rounded-5" data-bs-toggle="tooltip" data-bs-placement="left" title="Insert an item"><i class="ti ti-plus"></i></a>
        </div>
    </div>

    <?php include 'scripts.php' ?>
</body>

</html>