<?php

$conn = new mysqli("Localhost", "root", "", "Modul10");

if ($conn->connect_error) {
    die("En feil skjedde: " . $conn->connect_error);
}

function getJobId($jobId) {
    global $conn;
    $query = "SELECT * FROM jobs WHERE id = $jobId";
    $result = $conn->query($query);
    return $result->fetch_assoc();
}

function getRandJob($category) {
    global $conn;
    $query = "SELECT * FROM jobs WHERE category = '$category' ORDER BY RAND() LIMIT 1";
    $result = $conn->query($query);
    return $result->fetch_assoc();
}

function getJobLocation($location) {
    global $conn;
    $query = "SELECT * FROM jobs WHERE location LIKE '%$location%'";
    $result = $conn->query($query);

    $jobs = array();
    while ($row = $result->fetch_assoc()) {
        $jobs[] = $row;
    }

    return $jobs;
}
function getJobCategory($cat) {
    global $conn;
    $query = "SELECT * FROM jobs WHERE category LIKE '%$cat%'";
    $result = $conn->query($query);

    $jobs = array();
    while ($row = $result->fetch_assoc()) {
        $jobs[] = $row;
    }

    return $jobs;
}


if (isset($_GET['action'])) {
    $action = $_GET['action'];

    switch ($action) {
        case 'getJobId':
            if (isset($_GET['jobId'])) {
                $jobId = $_GET['jobId'];
                $res = getJobId($jobId);
            }
            break;
        case 'getRandJob':
            if (isset($_GET['randJob'])) {
                $randJob = $_GET['randJob'];
                $res = getRandJob($randJob);
            }
            break;
        case 'getJobLocation':
            if (isset($_GET['location'])) {
                $location = $_GET['location'];
                $res = getJobLocation($location);
            }
            break;
        case 'getJobCategory':
            if (isset($_GET['category'])) {
                $cat = $_GET['category'];
                $res = getJobCategory($cat);
            }
            break;
        default:
            $res = array('error' => 'Invalid action');
            break;
    }

    header('Content-Type: application/json');
    echo json_encode($res);
}

$conn->close();

?>


