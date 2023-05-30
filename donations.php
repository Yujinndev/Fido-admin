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
</head>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Marcellus&display=swap');

    * {
        font-family: 'Marcellus', serif;
        letter-spacing: .5px;
    }

    .courses-container {
        margin-top: 10px;
    }

    .course {
        background-color: #fff;
        border-radius: 10px;
        box-shadow: 0 10px 10px rgba(0, 0, 0, 0.2);
        display: flex;
        max-width: 100%;
        margin: 20px;
        overflow: hidden;
        width: 700px;
    }

    .course h6 {
        opacity: 0.6;
        margin: 0;
        letter-spacing: 1px;
        text-transform: uppercase;
    }

    .course h2 {
        letter-spacing: 1px;
        margin: 10px 0;
    }

    .course-preview {
        background-color: #2A265F;
        color: #fff;
        padding: 30px;
        max-width: 250px;
    }

    .course-info {
        padding: 30px;
        position: relative;
        width: 100%;
    }

    .progress-container {
        position: absolute;
        top: 30px;
        right: 30px;
        text-align: right;
        width: 150px;
    }

    .progress {
        background-color: #bbb;
        border-radius: 3px;
        height: 5px;
        width: 100%;
        position: relative;
    }

    .filler {
        position: absolute;
        top: 0;
        left: 0;
        height: 100%;
        background-color: #2A265F;
        border-radius: 3px;
    }
    .progress-text {
        font-size: 10px;
        opacity: 0.6;
        letter-spacing: 1px;
    }

    .floating-button {
      position: fixed;
      bottom: 20px;
      right: 20px;
      width: 60px;
      height: 60px;
      border-radius: 50%;
      background-color: #007bff;
      color: #ffffff;
      display: flex;
      justify-content: center;
      align-items: center;
      font-size: 24px;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
      z-index: 9999;
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

                <div class="row">
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
                                    <img src="<?= isset($row['photo']) ? $row['photo'] : '' ?>" alt="photo" style="height: 180px; aspect-ratio: 3/2; object-fit: contain; max-width: 100%; filter: drop-shadow(0px 0px 1px rgb(255, 255, 255)); margin-bottom: 10px;" class="w-100" />
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
            <a href="insert-data.php?table=products" class="btn btn-primary floating-button rounded-5" data-bs-toggle="tooltip" data-bs-placement="left" title="Insert an item"><i class="ti ti-plus"></i></a>
        </div>
    </div>

    <?php include 'scripts.php' ?>
</body>

</html>