<?php 
  require_once 'controllers/table-config.php';  
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
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    $(document).ready(function () {
    // Get the table name from the URL parameter
    const urlParams = new URLSearchParams(window.location.search);
    const tableFromUrl = urlParams.get('table');

    // Check if a table is specified in the URL
    if (tableFromUrl) {
        const tableName = tableFromUrl.charAt(0).toUpperCase() + tableFromUrl.slice(1);

        updateFormInputs(tableFromUrl);
        tableTitle.textContent = `Create / Add data in ${tableName}`;
    } else {
        window.location.href = '/';
    }

    // Function to update form inputs based on the table
    function updateFormInputs(selectedTable) {
        var tableConfig = <?= json_encode($tables) ?>;
        var fields = tableConfig[selectedTable].fields;

        var formInputs = $('#formInputs');
        formInputs.empty();

        $.each(fields, function (field, fieldConfig) {
            var input = '<hr><div class="row mb-2">' +
                '<label for="' + field + '" class="col-4 col-form-label">' + fieldConfig.label + ':</label>' +
                '<div class="col-8">';
            if (fieldConfig.type === 'textarea') {
                input += '<textarea name="' + field + '" id="' + field + '" class="form-control" required></textarea>';
            } else {
                input += '<input type="' + fieldConfig.type + '" name="' + field + '" id="' + field + '" class="form-control" required>';
            }
            input += '</div> </div>';
            formInputs.append(input);
        });
    }
});
  </script>
</head>
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
        <div class="row">
          <div class="col">
            <nav aria-label="breadcrumb" class="bg-light rounded-3 p-3 mb-4">
              <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="home.php">Home</a></li>
                <li class="breadcrumb-item"><a href="#">All Table</a></li>
                <li class="breadcrumb-item active" aria-current="page">Insert Data</li>
              </ol>
            </nav>
          </div>
        </div>

        <div class="row mt-n3">
          <form class="card mb-4" method="POST" action="/controllers/controller.php">
            <div class="card-body">
              <h1 class="card-title fw-semibold mt-n3" id="tableTitle">TITLE</h1>
              <input type="hidden" name="selectedTable" value="<?= $_GET['table'] ?>">
              <div id="formInputs">
                  <!-- Form inputs will be dynamically generated here -->
              </div>
              <button type="submit" name="insert" class="btn btn-primary float-end px-5">Submit</button>
            </div>
          </form>
        </div>  
      </div>
    </div>
  </div>

  <?php include 'scripts.php' ?>

</body>
</html>
