<?php
    require_once 'database.php';

    $usersBylocation = mysqli_query($con, "SELECT province, COUNT(*) AS totalUsers, SUM(CASE WHEN adoptedPets > 0 THEN 1 ELSE 0 END) AS totalAdopters FROM users GROUP BY province");
    $result1 = mysqli_fetch_all($usersBylocation, MYSQLI_ASSOC);

    $numOfPets = mysqli_query($con, "SELECT type, count(*) AS petCount FROM pets GROUP BY type");
    $result2 = mysqli_fetch_all($numOfPets, MYSQLI_ASSOC);

    $count = max(count($result1), count($result2)); // Use max to consider all rows from both tables

    $data = array();
    for ($i = 0; $i < $count; $i++) {
        $data[] = array(
            "totalUsers" => isset($result1[$i]) ? intval($result1[$i]['totalUsers']) : 0,
            "totalAdopters" => isset($result1[$i]) ? intval($result1[$i]['totalAdopters']) : 0,
            "provinces" => isset($result1[$i]) ? $result1[$i]['province'] : '',
            "petCount" => isset($result2[$i]) ? intval($result2[$i]['petCount']) : 0,
        );
    }

    mysqli_close($con);

    header('Content-Type: application/json');
    echo json_encode($data);