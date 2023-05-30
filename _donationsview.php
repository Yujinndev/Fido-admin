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
                <li class="breadcrumb-item"><a href="donations.php">All Item Donations</a></li>
                <li class="breadcrumb-item active" aria-current="page">Item Details & Transactions</li>
              </ol>
            </nav>
          </div>
        </div>
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

        <?php if (isset($_GET['id'])):
          $id = $_GET['id'];
          $query = mysqli_query($con, "SELECT * FROM itemdonations WHERE itemId = $id");
          $details = mysqli_fetch_assoc($query);

          $rowClass = '';

          if (!empty($status) && $details['itemId'] == $_SESSION['updatedId']) {
              $rowClass = $status === 'Updated' ? 'fade-out' : '';
          } 
        ?>

        <div class="row">
          <div class="col-lg-4 d-flex align-items-stretch">
            <div class="card w-100 pb-5">
              <div class="card-body p-4">
                <div class="mb-4">
                  <h5 class="card-title fw-semibold">Item Transactions</h5>
                </div>
                <ul class="timeline-widget mb-0 position-relative mb-n5">
                  <?php
                    $result = mysqli_query($con, "SELECT a.*, concat(b.firstname, ' ', b.lastname) as fullname, c.name FROM donationtransac a LEFT JOIN users b ON a.userId = b.userId LEFT JOIN itemdonations c ON a.itemId = c.itemId WHERE c.itemId = $id ORDER BY `dateTransac` DESC");
                    if (mysqli_num_rows($result) > 0) :
                      while ($row = mysqli_fetch_assoc($result)) :
                        $dt = new DateTime($row['dateTransac'], new DateTimeZone('UTC'));
                        $dateTransac = $dt->format('m/d h:i A');
                  ?>
                    <li class="timeline-item d-flex position-relative overflow-hidden">
                      <div class="timeline-time flex-shrink-0 text-end text-success w-25"><?= $dateTransac ?></div>
                      <div class="timeline-badge-wrap d-flex flex-column align-items-center">
                        <span class="timeline-badge border-2 border border-primary flex-shrink-0 my-8"></span>
                        <span class="timeline-badge-border d-block flex-shrink-0"></span>
                      </div>
                      <div class="timeline-desc fw-semibold mt-n1"><?= $row['fullname'] .' '. $row['remarks'] ?>  an amount of Php <?= $row['totalAmount'] ?>.00 <p class="text-primary d-block fw-normal fs-2">Id: ****<?= $row['transacId'] ?></p>
                      </div>

                    </li>
                    <li class="timeline-item d-flex position-relative overflow-hidden">
                      <div class="timeline-time flex-shrink-0 text-end w-25"><?= $dateTransac ?></div>
                      <div class="timeline-badge-wrap d-flex flex-column align-items-center">
                        <span class="timeline-badge border-2 border border-warning flex-shrink-0 my-8"></span>
                        <span class="timeline-badge-border d-block flex-shrink-0"></span>
                      </div>
                      <div class="timeline-desc fs-2 mt-0">Transaction incoming ... <p class="text-warning d-block fw-normal">Id: ****<?= $row['transacId'] ?></p>
                      </div>
                    </li>
                  <?php endwhile; ?>
                </ul>
                <?php else: ?>
                  <div class="container d-flex justify-content-center align-items-center mt-5">
                    <h3 class="align-self-center text-danger fs-6"> NO TRANSACTIONS YET .. </h3> 
                  </div>
                <?php endif; ?>
              </div>
            </div>
          </div>

          <div class="col-lg-8">
            <div class="card mb-4">
            <form method="POST" action="/controllers/controller.php">
              <div class="card-body">
                <h5 class="card-title fw-semibold">ITEM DETAILS</h5>
              
                <hr>
                <div class="row">
                  <label for="name" class="col-sm-2 col-form-label">Name: </label>
                  <div class="col-sm-10">
                    <input type="hidden" readonly class="form-control" name="itemId" value="<?= $details['itemId'] ?>">
                    <input type="text" class="form-control" name="name" value="<?= $details["name"] ?>">
                  </div>
                </div>

                <hr>
                <div class="row">
                  <label for="price" class="col-sm-2 col-form-label">Price: </label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="price" value="<?= $details["price"] ?>">
                  </div>
                </div>

                <hr>
                <div class="row">
                  <div class="col">
                    <div class="form-floating mb-3">
                      <input type="number" readonly class="form-control" placeholder="Enter number" value="<?= $details["currentStocks"] ?>">
                      <label>Current Available Stocks</label>
                    </div>
                  </div>
                  <div class="col">
                    <div class="form-floating mb-3">
                      <input type="number" class="form-control" placeholder="Enter number" name="quarterlyStocks" value="<?= $details["quarterlyStocks"] ?>">
                      <label for="floatingInput">Quarterly Target Stocks</label>
                    </div>
                  </div>
                </div>

                <?php $totalAmount = intval($details['price']) * intval($details['currentStocks']) ?>
                <hr>
                <div class="row <?= $rowClass ?>">
                  <label for="price" class="col-sm-2 col-form-label">Price: </label>
                    <div class="col-sm-10 col-lg-7">
                      <input type="text" readonly class="form-control" name="totalAmount" value="<?= $totalAmount ?>">
                    </div>
                    <div class="col-sm-10 col-lg-2 ms-2">
                      <input type="hidden" readonly class="form-control" name="itemId" value="<?= $details['itemId'] ?>">
                      <a href="<?= ($details['currentStocks'] > 0) ? '/controllers/controller.php?withdraw=true&itemId=' . $details['itemId'] . '&totalAmount=' . $totalAmount : 'javascript:void(0)' ?>" class="btn btn-outline-primary" name="withdraw">WITHDRAW</a>
                    </div>
                </div>

                <hr>
                <div class="row">
                  <label for="description" class="col-sm-2 col-form-label">Description: </label>
                  <div class="col-sm-10">
                    <div class="form-floating">
                      <b><textarea class="form-control" name="description" style="height: 115px"><?= $details['description'] ?></textarea></b>
                    </div>
                  </div>
                </div>
              </div>

              <div class="container">
                <button type="submit" name="update-item" class="btn btn-primary float-end mb-2 mt-n3">UPDATE</button>
                <a href="/controllers/controller.php?delete-item=<?= $details["itemId"] ?>" class="btn btn-outline-danger float-end m-2 mt-n3">DELETE</a>
              </div>
            </form>
            </div>
          </div>
        </div>
        <?php endif ?>
      </div>
    </div>
  </div>

  <?php include "scripts.php"; ?>
</body>

</html>