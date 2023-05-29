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

  ::-webkit-scrollbar {
    width: 0.6em;
    background-color: rgb(110, 110, 110);
  }

  ::-webkit-scrollbar-thumb {
    border-radius: 10px;
    background-color: rgb(190, 190, 190);
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
        <!--  Row 1 -->
        <div class="row m-n3">
          <div class="col-lg-8 d-flex align-items-strech">
            <div class="card w-100 bg-dark">
              <div class="card-body">
                <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
                  <div class="mb-3 mb-sm-0">
                    <h5 class="card-title fw-semibold mb-0 text-light">USERS BY LOCATION</h5>
                    <p class="text-danger mb-3 fs-2 mb-0">AS OF <?= $currentDate = date('F d, Y') ?></p>
                  </div>
                </div>
                <div id="chart"></div>
              </div>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="row">
              <div class="col-lg-12">
                <!-- Yearly Breakup -->
                <div class="card bg-dark mt-5">
                  <div class="card-body p-4">
                    <div class="row align-items-center">
                      <div class="col-7">
                        <h5 class="card-title mb-0 fw-semibold text-light">NUMBER OF PETS</h5>
                        <p class="text-danger mb-3 fs-2 mb-0">AS OF <?= $currentDate = date('F d, Y') ?></p>
                        <h4 class="fw-semibold text-light mb-3 text-light"><?= mysqli_fetch_assoc($pet)['count']; ?> OVERALL</h4>
                        <div class="d-flex align-items-center">
                          <div class="me-4">
                            <span class="round-8 bg-success rounded-circle me-2 d-inline-block"></span>
                            <span class="fs-2 text-light">Dog</span>
                          </div>
                          <div>
                            <span class="round-8 bg-primary rounded-circle me-2 d-inline-block"></span>
                            <span class="fs-2 text-light">Cat</span>
                          </div>
                        </div>
                      </div>
                      <div class="col-4">
                        <div class="d-flex justify-content-center">
                          <div id="breakup"></div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-12">
                <!-- Monthly Earnings -->
                <div class="card bg-dark">
                  <div class="card-body">
                    <div class="row align-items-start">
                      <div class="col-8">
                        <h5 class="card-title mb-0 fw-semibold text-light"> TOTAL DONATION </h5>
                        <p class="text-danger mb-3 fs-2 mb-0">AS OF <?= $currentDate = date('F d, Y') ?></p>
                        <h4 class="fw-semibold text-light mb-3 text-light"><?= 'Php ' . mysqli_fetch_assoc($donation)['sum']; ?></h4>
                        <div class="d-flex align-items-center pb-1">
                          <span class="me-2 rounded-circle bg-light-danger round-20 d-flex align-items-center justify-content-center">
                            <i class="ti ti-arrow-up-left text-success"></i>
                          </span>
                          <p class="text-light me-1 fs-3 mb-0">+9%</p>
                          <p class="fs-3 mb-0 text-light">Last Quarter</p>
                        </div>
                      </div>
                      <div class="col-4">
                        <div class="d-flex justify-content-end">
                          <div class="text-white bg-secondary rounded-circle p-6 d-flex align-items-center justify-content-center">
                            <i class="ti ti-currency-dollar fs-6"></i>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div id="earning"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-4 d-flex align-items-stretch">
            <div class="card w-100 bg-dark">
              <div class="card-body p-4 overflow-y-scroll" style="max-height: 30rem;">
                <div class="mb-4">
                  <h5 class="card-title fw-semibold text-light">Donation Transactions</h5>
                </div>
                <ul class="timeline-widget mb-0 position-relative mb-n5">
                  <?php
                  $result = mysqli_query($con, "SELECT a.*, concat(b.firstname, ' ', b.lastname) as fullname, c.name  FROM donationtransac a LEFT JOIN users b ON a.userId = b.userId LEFT JOIN itemdonations c ON a.itemId = c.itemId");
                  while ($row = mysqli_fetch_assoc($result)) :
                    $dt = new DateTime($row['dateTransac'], new DateTimeZone('UTC'));
                    $dt->setTimezone(new DateTimeZone('Asia/Manila'));
                    $dateTransac = $dt->format('m/d h:i A');

                    $id = uniqid();
                  ?>
                    <li class="timeline-item d-flex position-relative overflow-hidden">
                      <div class="timeline-time flex-shrink-0 text-end text-success w-25"><?= $dateTransac ?></div>
                      <div class="timeline-badge-wrap d-flex flex-column align-items-center">
                        <span class="timeline-badge border-2 border border-primary flex-shrink-0 my-8"></span>
                        <span class="timeline-badge-border d-block flex-shrink-0"></span>
                      </div>
                      <div class="timeline-desc fw-semibold text-light mt-n1">Donation received from <?= $row['fullname'] ?> with an amount of Php <?= $row['totalAmount'] ?>.00 <p class="text-primary d-block fw-normal fs-2">Id: ****<?= $row['transacId'] ?></p>
                      </div>

                    </li>
                    <li class="timeline-item d-flex position-relative overflow-hidden">
                      <div class="timeline-time text-light flex-shrink-0 text-end w-25"><?= $dateTransac ?></div>
                      <div class="timeline-badge-wrap d-flex flex-column align-items-center">
                        <span class="timeline-badge border-2 border border-warning flex-shrink-0 my-8"></span>
                        <span class="timeline-badge-border d-block flex-shrink-0"></span>
                      </div>
                      <div class="timeline-desc fs-2 text-light mt-0">Transaction incoming ... <p class="text-warning d-block fw-normal">Id: ****<?= $row['transacId'] ?></p>
                      </div>
                    </li>
                  <?php endwhile ?>
                </ul>
              </div>
            </div>
          </div>
          <div class="col-lg-8 d-flex align-items-stretch">
            <div class="card w-100">
              <div class="card-body p-4 bg-dark rounded-3">
                <h5 class="card-title fw-semibold mb-4 text-light">Donation Rankings</h5>
                <div class="table-responsive">
                  <table class="table text-nowrap mb-0 align-middle">
                    <thead class="text-light fs-4">
                      <tr>
                        <th class="border-bottom-0">
                          <h6 class="fw-semibold text-light mb-0">#</h6>
                        </th>
                        <th class="border-bottom-0">
                          <h6 class="fw-semibold text-light mb-0">Name</h6>
                        </th>
                        <th class="border-bottom-0">
                          <h6 class="fw-semibold text-light mb-0">Province</h6>
                        </th>
                        <th class="border-bottom-0">
                          <h6 class="fw-semibold text-light mb-0">Rank</h6>
                        </th>
                        <th class="border-bottom-0">
                          <h6 class="fw-semibold text-light mb-0">Total Donated</h6>
                        </th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $num = 0;
                      $result = mysqli_query($con, "SELECT b.*, sum(totalAmount) as sum, concat(b.firstname, ' ', b.lastname) as fullname FROM donationtransac a LEFT JOIN users b ON a.userId = b.userId GROUP BY userId ORDER BY sum(totalAmount) desc");

                      $rankLabels = array("First", "Second", "Third"); // Add more labels as needed
                      $rankColors = array("bg-success", "bg-danger", "bg-warning"); // Add more colors as needed

                      while ($row = mysqli_fetch_assoc($result)) :
                        $num++;
                        $rankLabel = isset($rankLabels[$num - 1]) ? $rankLabels[$num - 1] : $num;
                        $rankColor = isset($rankColors[$num - 1]) ? $rankColors[$num - 1] : "";
                      ?>

                        <tr>
                          <td class="border-bottom-0">
                            <h6 class="fw-semibold text-light mb-0"><?= $num ?></h6>
                          </td>
                          <td class="border-bottom-0">
                            <h6 class="fw-semibold text-light mb-1"><?= $row['fullname'] ?></h6>
                            <span class="fw-normal"><?= $row['email'] ?></span>
                          </td>
                          <td class="border-bottom-0">
                            <p class="mb-0 fw-normal text-light"><?= $row['province'] ?></p>
                          </td>
                          <td class="border-bottom-0">
                            <div class="d-flex align-items-center gap-2">
                              <span class="badge <?= $rankColor ?> rounded-3 fw-semibold"><?= $rankLabel ?></span>
                            </div>
                          </td>
                          <td class="border-bottom-0">
                            <h6 class="fw-semibold text-light mb-0 fs-4">Php <?= $row['sum'] ?>.00</h6>
                          </td>
                        </tr>
                      <?php endwhile ?>
                    </tbody>
                  </table>
                </div>
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