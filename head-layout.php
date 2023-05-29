<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Fido</title>
  <link rel="shortcut icon" type="image/png" href="../assets/images/logos/favicon.png" />
  <link rel="stylesheet" href="../assets/css/styles.min.css" />
</head>

<style>
  @import url('https://fonts.googleapis.com/css2?family=Marcellus&display=swap');

  *{
    font-family: 'Marcellus', serif;
    letter-spacing: .5px;
  }
</style>

<body>
<?php 
    include 'controllers/database.php';
    session_start();

    if (isset($_SESSION['email'])) {
        $email = $_SESSION['email'];
        $result = mysqli_query($con, "SELECT * FROM users WHERE `email` = '$email'") or die (mysqli_error($con));
    } else {
        header('Location: ../controllers/controller.php?logout=true');
    }
?>
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">

    <!-- Sidebar Start -->
    <?php include 'side-navigation.php'; ?>
    <!--  Sidebar End -->

    <div class="body-wrapper">
      <!--  Header Start -->
      <?php include 'header-navigation.php'; ?>
      <!--  Header End -->