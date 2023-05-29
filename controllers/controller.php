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
    if(isset($_GET['deletePet'])) {
        $id = $_GET['deletePet'];
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

        // update
        $stmt = $con->prepare("UPDATE pets SET `name` = ?, `type` = ?, `age` = ?, `status` = ?, `availability` = ? WHERE `petId` = ?");
        $stmt->bind_param("ssssss", $name, $type, $age, $status, $availability, $id);
        $stmt->execute();

        header('Location: ../pets.php');
        exit();
    }

    // FOR USER PROCESSES
    if(isset($_GET['deleteUser'])) {
        $id = $_GET['deleteUser'];
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

        // update
        $stmt = $con->prepare("UPDATE users SET `firstname` = ?, `lastname` = ?, `email` = ?, `age` = ?, `address` = ?, `phoneNum` = ?, `role` = ? WHERE `userId` = ?");
        $stmt->bind_param("ssssssss", $firstname, $lastname, $email, $age, $address, $phoneNum, $role, $id);
        $stmt->execute();

        header('Location: ../users.php');
        exit();
    }
?>
