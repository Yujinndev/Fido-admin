<?php
require_once "./controllers/database.php";

$result1 = mysqli_query($con, "SELECT province, count(*) AS userCount, sum(adoptedPets) as countPets FROM users GROUP BY province");
$rows1 = mysqli_fetch_all($result1, MYSQLI_ASSOC);

$result2 = mysqli_query($con, "SELECT type, count(*) AS petCount FROM pets GROUP BY type");
$rows2 = mysqli_fetch_all($result2, MYSQLI_ASSOC);

$count = max(count($rows1), count($rows2)); // Use max to consider all rows from both tables

$data = array();
for ($i = 0; $i < $count; $i++) {
    $data[] = array(
        "userCount" => isset($rows1[$i]) ? intval($rows1[$i]['userCount']) : 0,
        "countPets" => isset($rows1[$i]) ? intval($rows1[$i]['countPets']) : 0,
        "count" => isset($rows2[$i]) ? intval($rows2[$i]['petCount']) : 0,
    );
}

mysqli_close($con);

header('Content-Type: application/json');
echo json_encode($data);
