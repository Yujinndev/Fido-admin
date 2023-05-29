<?php 
  include 'controllers/database.php';

  if (isset($_SESSION['id'])) {
    header('Location: home.php');
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
  <link rel="stylesheet" href="../assets/css/style.css" />
</head>
<body>
  <div class="container" id="container">
    <div class="form-container sign-in-container">
      <form action="../controllers/controller.php" method="POST">
        <h1>Hello, Admin!</h1>
        <input type="email" placeholder="Email" name="email" />
        <input type="password" placeholder="Password" name="password" />
        <span class="m-2">We will never share your information</span>
        <button type="submit" name="login">Login</button>
      </form>
    </div>
    
    <div class="overlay-container">
      <div class="overlay">
        <div class="overlay-panel overlay-right">
           <!-- logo here -->
        </div>
      </div>
    </div>
  </div>


</body>
</html>