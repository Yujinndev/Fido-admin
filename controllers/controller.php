<?php
    require_once "database.php";

    // FOR LOGIN AUTHENTICATION
    if(isset($_POST['login'])) {
        function validate($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
    
        $email = validate($_POST['email']);
        $password = validate($_POST['password']);

        $stmt = $con->prepare("SELECT * FROM users WHERE `email` = ? AND `password` = ? AND role = 'Admin'");
        $stmt->bind_param("ss", $email, $password);
        $stmt->execute();
        $result = $stmt->get_result();
    
        if ($result->num_rows === 1) {
            $row = $result->fetch_assoc();
            $_SESSION['email'] = $row['email'];
            $_SESSION['id'] = $row['userId'];

            session_regenerate_id(true); 

            header("Location: ../home.php");
            exit();
        }
    }

    // FOR LOGOUT PROCESS
    if(isset($_GET['logout'])) {
        session_start(); 
        $_SESSION = array();
        session_destroy();
        
        header('Location: ../index.php');
        exit();
    }

    // FOR PET PROCESSES
    if(isset($_GET['delete-pet'])) {
        $id = $_GET['delete-pet'];
        $stmt = $con->prepare("DELETE FROM pets WHERE petId = ?");
        $stmt->bind_param("s", $id);
        $stmt->execute();
        
        header('Location: ../pets.php');
        exit();
    }

    if(isset($_POST['update-pet'])){
        $id = $_POST['petId'];
        $name = $_POST['name'];
        $type = $_POST['type'];
        $age = $_POST['age'];
        $status = $_POST['status'];
        $availability = $_POST['availability'];

        $stmt = $con->prepare("UPDATE pets SET `name` = ?, `type` = ?, `age` = ?, `status` = ?, `availability` = ? WHERE `petId` = ?");
        $stmt->bind_param("ssssss", $name, $type, $age, $status, $availability, $id);
        $stmt->execute();

        header('Location: ../pets.php');
        exit();
    }

    // FOR USER PROCESSES
    if(isset($_GET['delete-user'])) {
        $id = $_GET['delete-user'];
        $stmt = $con->prepare("DELETE FROM users WHERE userId = ?");
        $stmt->bind_param("s", $id);
        $stmt->execute();
        
        header('Location: ../users.php');
        exit();
    }

    if(isset($_POST['update-user'])){
        $id = $_POST['userId'];
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $email = $_POST['email'];
        $age = $_POST['age'];
        $address = $_POST['address'];
        $phoneNum = $_POST['phone'];
        $role = $_POST['role'];

        $stmt = $con->prepare("UPDATE users SET `firstname` = ?, `lastname` = ?, `email` = ?, `age` = ?, `address` = ?, `phoneNum` = ?, `role` = ? WHERE `userId` = ?");
        $stmt->bind_param("ssssssss", $firstname, $lastname, $email, $age, $address, $phoneNum, $role, $id);
        $stmt->execute();

        header('Location: ../users.php');
        exit();
    }

    // FOR REQUESTS PROCESSES
    if(isset($_GET['deny-request'])) {
        $id = $_GET['deny-request'];
        $denied = 'Denied';

        $stmt = $con->prepare("UPDATE requests SET `requestStatus` = ? WHERE `requestId` = ?");
        $stmt->bind_param("ss", $denied, $id);
        $stmt->execute();

        header('Location: ../requests.php');
        exit();
    }

    if(isset($_POST['accept-request'])) {
        $id = $_POST['requestId'];
        $accepted = 'Accepted';

        $stmt = $con->prepare("UPDATE requests SET `requestStatus` = ? WHERE `requestId` = ?");
        $stmt->bind_param("ss", $accepted, $id);
        $stmt->execute();

        header('Location: ../requests.php');
        exit();
    }

    // FOR MATERIALS PROCESSES
    if(isset($_GET['delete-material'])) {
        $id = $_GET['delete-material'];
        $stmt = $con->prepare("DELETE FROM educmat WHERE matId = ?");
        $stmt->bind_param("s", $id);
        $stmt->execute();
        
        header('Location: ../materials.php');
        exit();
    }

    if(isset($_POST['update-material'])) {
        $id = $_POST['materialId'];
        $title = $_POST['title'];
        $reference = $_POST['reference'];
        $content = $_POST['content'];
        $status = $_POST['status'];

        $stmt = $con->prepare("UPDATE educmat SET `title` = ?, `content` = ?, `reference` = ?, `status` = ? WHERE matId = ?");
        $stmt->bind_param("sssss", $title, $content, $reference, $status, $id);
        $stmt->execute();
        
        header('Location: ../materials.php');
        exit();
    }

    // FOR DONATION PROCESSES
    if(isset($_POST['withdraw'])) {
        $transacId = uniqid();
        $userId = $_SESSION['id'];
        $itemId = $_POST['itemId'];
        $dateTransac = date('Y-m-d H:i:s');
        $totalAmount = $_POST['totalAmount'];
        $remarks = 'Withdrawn';

        // Insert into donationtransac table
        $stmt1 = $con->prepare("INSERT INTO donationtransac (`transacId`, `userId`, `itemId`, `dateTransac`, `totalAmount`, `remarks`) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt1->bind_param("ssssss", $transacId, $userId, $itemId, $dateTransac, $totalAmount, $remarks);
        $stmt1->execute();

        // Update itemdonations table
        $stmt2 = $con->prepare("UPDATE itemdonations SET `currentStocks` = 0 WHERE `itemId` = ?");
        $stmt2->bind_param("s", $itemId);
        $stmt2->execute();

        header('Location: ../donations.php');
        exit();
    }
?>  
