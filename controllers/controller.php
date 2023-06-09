<?php
    require_once 'table-config.php';  
    require_once 'database.php';

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

            $_SESSION['message'] = 'Welcome admin, ' . $row['firstname'];

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

            if ($stmt->affected_rows > 0) {
                $_SESSION['status'] = 'Deleted';
                $_SESSION['message'] = 'Deleted Pet #' . $id . ' successfully';
            } else {
                $_SESSION['status'] = 'Failed';
                $_SESSION['message'] = 'Unable to delete Pet #' . $id;
            }
        
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
        
            if ($stmt->affected_rows > 0) {
                $_SESSION['status'] = 'Updated';
                $_SESSION['message'] = 'Successfully updated Pet #' . $id;
                $_SESSION['updatedId'] = $id;
            } else {
                $_SESSION['status'] = 'Failed';
                $_SESSION['message'] = 'Unable to update Pet #' . $id;
            }
        
        // Redirect to the home page
        header('Location: ../pets.php');
        exit;
    }
    
    // FOR USER PROCESSES
    if(isset($_GET['delete-user'])) {
        $id = $_GET['delete-user'];
        $stmt = $con->prepare("DELETE FROM users WHERE userId = ?");
        $stmt->bind_param("s", $id);
        $stmt->execute();

            if ($stmt->affected_rows > 0) {
                $_SESSION['status'] = 'Deleted';
                $_SESSION['message'] = 'Deleted User #' . $id . ' successfully';
            } else {
                $_SESSION['status'] = 'Failed';
                $_SESSION['message'] = 'Unable to delete User #' . $id;
            }
        
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

            if ($stmt->affected_rows > 0) {
                $_SESSION['status'] = 'Updated';
                $_SESSION['message'] = 'Successfully updated User #' . $id;
                $_SESSION['updatedId'] = $id;
            } else {
                $_SESSION['status'] = 'Failed';
                $_SESSION['message'] = 'Unable to update User #' . $id;
            }

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

            if ($stmt->affected_rows > 0) {
                $_SESSION['status'] = 'Failed';
                $_SESSION['message'] = 'Denied Request #' . $id . ' successfully';
                $_SESSION['updatedId'] = $id;
            } else {
                $_SESSION['status'] = 'Failed';
                $_SESSION['message'] = 'Unable to deny Request #' . $id;
            }

        header('Location: ../requests.php');
        exit();
    }

    if(isset($_POST['accept-request'])) {
        $id = $_POST['requestId'];
        $accepted = 'Accepted';

        $stmt = $con->prepare("UPDATE requests SET `requestStatus` = ? WHERE `requestId` = ?");
        $stmt->bind_param("ss", $accepted, $id);
        $stmt->execute();

        $unavailable = 'Not Available';

        $stmt1 = $con->prepare("UPDATE pets SET `availability` = ? WHERE `petId` = ?");
        $stmt1->bind_param("ss", $unavailable, $id);
        $stmt1->execute();

            if ($stmt->affected_rows > 0) {
                $_SESSION['status'] = 'Updated';
                $_SESSION['message'] = 'Accepted Request #' . $id . ' successfully';
                $_SESSION['updatedId'] = $id;
            } else {
                $_SESSION['status'] = 'Failed';
                $_SESSION['message'] = 'Unable to accept Request #' . $id;
            }

        header('Location: ../requests.php');
        exit();
    }

    // FOR MATERIALS PROCESSES
    if(isset($_GET['delete-material'])) {
        $id = $_GET['delete-material'];
        $stmt = $con->prepare("DELETE FROM materials WHERE matId = ?");
        $stmt->bind_param("s", $id);
        $stmt->execute();
        
            if ($stmt->affected_rows > 0) {
                $_SESSION['status'] = 'Deleted';
                $_SESSION['message'] = 'Deleted material #' . $id . ' successfully';
            } else {
                $_SESSION['status'] = 'Failed';
                $_SESSION['message'] = 'Unable to delete material #' . $id;
            }

        header('Location: ../materials.php');
        exit();
    }

    if(isset($_POST['update-material'])) {
        $id = $_POST['materialId'];
        $title = $_POST['title'];
        $reference = $_POST['reference'];
        $content = $_POST['content'];
        $status = $_POST['status'];

        $stmt = $con->prepare("UPDATE materials SET `title` = ?, `content` = ?, `reference` = ?, `status` = ? WHERE matId = ?");
        $stmt->bind_param("sssss", $title, $content, $reference, $status, $id);
        $stmt->execute();

            if ($stmt->affected_rows > 0) {
                $_SESSION['status'] = 'Updated';
                $_SESSION['message'] = 'Updated material #' . $id . ' successfully';
                $_SESSION['updatedId'] = $id;
            } else {
                $_SESSION['status'] = 'Failed';
                $_SESSION['message'] = 'Unable to update material #' . $id;
            }
        
        header('Location: ../materials.php');
        exit();
    }

    // FOR DONATION PROCESSES
    if(isset($_GET['withdraw'])) {
        $transacId = uniqid();
        $userId = $_SESSION['id'];
        $itemId = $_GET['itemId'];
        $date = new DateTime('now', new DateTimeZone('Asia/Manila'));
        $dateTransac = $date->format('Y-m-d H:i:s');
        $totalAmount = $_GET['totalAmount'];
        $remarks = 'Withdrawn';

        // Insert into donationtransac table
        $stmt1 = $con->prepare("INSERT INTO donationtransac (`transacId`, `userId`, `itemId`, `dateTransac`, `totalAmount`, `remarks`) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt1->bind_param("ssssss", $transacId, $userId, $itemId, $dateTransac, $totalAmount, $remarks);
        $stmt1->execute();

        // Update itemdonations table
        $stmt2 = $con->prepare("UPDATE itemdonations SET `currentStocks` = 0, `lastWithdrawn` = ? WHERE `itemId` = ?");
        $stmt2->bind_param("ss", $dateTransac, $itemId);
        $stmt2->execute();

        if ($stmt2->affected_rows > 0) {
            $_SESSION['status'] = 'Updated';
            $_SESSION['message'] = 'Successfully withdrawn the amount of Item #' . $itemId;
            $_SESSION['updatedId'] = $itemId;
        } else {
            $_SESSION['status'] = 'Failed';
            $_SESSION['message'] = 'Unable to withdraw the amount of Item #' . $itemId;
        }

        header('Location: ../_donationsview.php?id=' . $itemId);
        exit();
    }

    if(isset($_GET['delete-item'])) {
        $id = $_GET['delete-item'];

        $stmt = $con->prepare("DELETE FROM itemdonations WHERE itemId = ?");
        $stmt->bind_param("s", $id);
        $stmt->execute();
        
            if ($stmt->affected_rows > 0) {
                $_SESSION['status'] = 'Deleted';
                $_SESSION['message'] = 'Deleted item #' . $id . ' successfully';
            } else {
                $_SESSION['status'] = 'Failed';
                $_SESSION['message'] = 'Unable to delete item #' . $id;
            }

        header('Location: ../donations.php');
        exit();
    }

    
    if(isset($_POST['update-item'])) {
        $id = $_POST['itemId'];
        $name = $_POST['name'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $quarterlyStocks = $_POST['quarterlyStocks'];

        $stmt = $con->prepare("UPDATE `itemdonations` SET `name` = ?, `description` = ?, `price` = ?, `quarterlyStocks` = ? WHERE `itemId` = ?");
        $stmt->bind_param("sssss", $name, $description, $price, $quarterlyStocks, $id);
        $stmt->execute();
        
        if ($stmt->affected_rows > 0) {
            $_SESSION['status'] = 'Updated';
            $_SESSION['message'] = 'Updated item #' . $id . ' successfully';
            $_SESSION['updatedId'] = $id;
        } else {
            $_SESSION['status'] = 'Failed';
            $_SESSION['message'] = 'Unable to update item #' . $id;
        }

        header('Location: ../donations.php');
        exit();
    }

    // FOR INSERTING PROCESS
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['insert'])) {
        $selectedTable = $_POST['selectedTable'];

        if (isset($tables[$selectedTable])) {
            $tableConfig = $tables[$selectedTable];
            $fields = $tableConfig['fields'];
    
            // Retrieve form data based on the selected table fields
            $formData = [];
            foreach ($fields as $field => $fieldConfig) {
                if (isset($_POST[$field])) {
                    $formData[$field] = $_POST[$field];
                }
            }
    
            // Construct the INSERT statement
            $columns = implode(', ', array_keys($formData));
            $placeholders = implode(', ', array_fill(0, count($formData), '?'));
            $sql = "INSERT INTO $selectedTable ($columns) VALUES ($placeholders)";

            // Prepare and bind the parameters
            $stmt = $con->prepare($sql);
            $stmt->bind_param(str_repeat('s', count($formData)), ...array_values($formData));
            $stmt->execute();
            
            header('Location: ../home.php');
            exit();
        }
    }
?>  