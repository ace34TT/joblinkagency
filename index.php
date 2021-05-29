<?php
// index.php
// On charge les modeles et les controleurs

//Avoid document expired
ini_set('session.cache_limiter', 'public');
session_cache_limiter(false);


// Enable display errors 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Required files 
require_once(dirname(__FILE__) . '/inc/controllers/CandidateController.php');
$candidateController = new CandidateController;

// gestion des routes

if (isset($_GET['action'])) {
    $action = $_GET['action'];
    //Frontend 
    //apply
    if ($action == 'registration_form') {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
        }
        include('pages/frontend/register.php');
        return;
    }
    if ($action == 'registration_upload') {
        $data[0] = $_POST['fullname'];
        $data[1] = $_POST['dateOfBirth'];
        $data[2] = $_POST['sexe'];
        $data[3] = $_POST['height'];
        $data[4] = $_POST['weight'];
        $data[5] = $_POST['region'];
        $data[6] = $_POST['email'];
        $data[7] = $_POST['phone'];
        $data[8] = $_POST['destination'];
        $data[9] = $_POST['post'];
        $data[10] = 'pending';

        $resume = $_FILES['resume'];

        $candidateController->store($data, $resume);
    }

    if($action == ''){

    }
} else {
    include('pages/frontend/index.php');
    return;
}

// if ($route != $uri) {
// } else {
//     header('Status: 404 Not Found');
//     echo '<html><body><h1>Page Not Found</h1></body></html>';
//     return;
// }
