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
require_once(dirname(__FILE__) . '/inc/controllers/RecruiterController.php');
require_once(dirname(__FILE__) . '/inc/controllers/AdminController.php');
require_once(dirname(__FILE__) . '/inc/controllers/CommentController.php');
$candidateController = new CandidateController;
$recruiterController = new RecruiterController;
$adminController = new AdminController;
$commentController = new CommnetController;

session_start();

// gestion des routes

if (isset($_GET['action'])) {
    $action = $_GET['action'];
    //Frontend 
    //apply
    if ($action == 'registration_form') {
        $error = '';
        if (isset($_GET['error'])) {
            $error = $_GET['error'];
        }
        $recruiters = $recruiterController->index();
        include('pages/frontend/register.php');
        return;
    }
    if ($action == 'registration_post') {
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

    if ($action == 'update_resume_form') {
        $message = "";
        if (isset($_GET['message'])) {
            $message =  $_GET['message'];
        }
        include('pages/frontend/update-resume.php');
    }

    if ($action == "update_resume") {
        $email = $_POST['email'];
        $id = $_POST['id'];
        $resume = $_FILES['resume'];
        $candidateController->update_resume($email, $id, $resume);
    }

    if ($action == 'admin_login_form') {
        if (isset($_SESSION['admin'])) {
            header('Location: index.php?action=admin_index');
        }
        $recruiters = $recruiterController->index();
        include('pages/backend/index.php');
    }

    if ($action == 'admin_login_post') {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $recruiter = $_POST['recruiter'];

        $adminController->login($username, $password, $recruiter);
    }

    if ($action == 'admin_index') {
        if (!isset($_SESSION['admin'])) {
            header('Location: index.php?action=admin_login_form');
        }
        $pending = $candidateController->getPendings();
        $pretest = $candidateController->getPretests();
        $finaltest = $candidateController->getFinalTests();
        $pretestfail = $candidateController->getPretestFails();
        $finaltestfail = $candidateController->getFinalTestFails();
        $received = $candidateController->getReceived();

        include('pages/backend/homepage.php');
    }

    if ($action == 'pending_list') {
        if (!isset($_SESSION['admin'])) {
            header('Location: index.php?action=admin_login_form');
        }
        $candidates = $candidateController->getPendings();
        include('pages/backend/pending.php');
    }

    if ($action == 'save_pending') {
        if (!isset($_SESSION['admin'])) {
            header('Location: index.php?action=admin_login_form');
        }
        $id = $_GET['id'];
        $candidateController->savePending($id);
        header('Location: index.php?action=pending_list');
    }

    if ($action == 'pretest_list') {
        if (!isset($_SESSION['admin'])) {
            header('Location: index.php?action=admin_login_form');
        }
        $candidates = $candidateController->getPretests();
        include('pages/backend/pretest.php');
    }

    if ($action == 'pretest_form') {
        if (!isset($_SESSION['admin'])) {
            header('Location: index.php?action=admin_login_form');
        }
        $id = $_GET['id'];
        $candidate = $candidateController->getCandidate($id);
        $recruiters = $recruiterController->index();
        include('pages/backend/pretestForm.php');
    }

    if ($action == 'pretest_result_post') {
        if (!isset($_SESSION['admin'])) {
            header('Location: index.php?action=admin_login_form');
        }
        $candidate = $_GET['candidate_id'];
        $situation = $_POST['result'];
        $post = $_POST['post'];
        $recruiter = $_POST['recruiter_id'];

        $comment_value = $_POST['comment'];
        $comment_value = str_replace("'", "\'", $comment_value);
        $comment[0] = $candidate;
        $comment[1] = $comment_value;
        $comment[2] =  $_SESSION['admin']['name'];

        $candidateController->pretestSetResult($candidate, $situation, $post, $recruiter);
        !empty($comment_value) ? $commentController->store($comment) : null;
        header('Location: index.php?action=pretest_list');
    }
    if ($action == 'pretestfail_list') {
        if (!isset($_SESSION['admin'])) {
            header('Location: index.php?action=admin_login_form');
        }
        $candidates = $candidateController->getPretestFails();
        include('pages/backend/pretestfail.php');
    }

    if ($action == 'save_pretestfail') {
        if (!isset($_SESSION['admin'])) {
            header('Location: index.php?action=admin_login_form');
        }
        $id = $_GET['id'];
        $candidateController->savePending($id);
        header('Location: index.php?action=pretestfail_list');
    }

    if ($action == 'candidate_card') {
        if (!isset($_SESSION['admin'])) {
            header('Location: index.php?action=admin_login_form');
        }
        $candidate = $_GET['id'];
        $comments = $commentController->get_canidate_comments($candidate);
        $comments = $commentController->get_canidate_comments($candidate);
        $candidate = $candidateController->getCandidate($candidate);
        include('pages/backend/candidate-card.php');
    }

    if ($action == 'finaltest_list') {
        if (!isset($_SESSION['admin'])) {
            header('Location: index.php?action=admin_login_form');
        }
        $candidates = $candidateController->getFinalTests();
        include('pages/backend/finaltest.php');
    }

    if ($action == 'finaltest_form') {
        if (!isset($_SESSION['admin'])) {
            header('Location: index.php?action=admin_login_form');
        }
        $id = $_GET['id'];
        $comments = $commentController->get_canidate_comments($id);
        $candidate = $candidateController->getCandidate($id);
        $recruiters = $recruiterController->index();
        include('pages/backend/finaltestForm.php');
    }

    if ($action == 'finaltest_result_post') {
        if (!isset($_SESSION['admin'])) {
            header('Location: index.php?action=admin_login_form');
        }
        $candidate = $_GET['candidate_id'];
        $situation = $_POST['result'];
        $post = $_POST['post'];
        $recruiter = $_POST['recruiter_id'];

        $comment_value = $_POST['comment'];
        $comment_value = str_replace("'", "\'", $comment_value);
        $comment[0] = $candidate;
        $comment[1] = $comment_value;
        $comment[2] =  $_SESSION['admin']['name'];

        $candidateController->pretestSetResult($candidate, $situation, $post, $recruiter);
        !empty($comment_value) ? $commentController->store($comment) : null;

        header('Location: index.php?action=finaltest_list');
    }

    if ($action == 'finaltestfail_list') {
        $candidates = $candidateController->getFinalTestFails();
        include('pages/backend/finaltestfail.php');
    }

    if ($action == 'save_finaltestfail') {
        $id = $_GET['id'];
        $candidateController->saveFinaltest($id);
        header('Location: index.php?action=finaltestfail_list');
    }

    if ($action == 'received_list') {
        $candidates = $candidateController->getReceived();
        include('pages/backend/received.php');
    }

    if ($action == 'logout') {
        session_destroy();
        header('Location: index.php');
    }

    if ($action == "send_message") {
        $email = array(
            'name' => $_POST['name'],
            'email' => $_POST['email'],
            'subject' => $_POST['subject'],
            'message' => $_POST['message']
        );
        header('Location: index.php');
    }
} else {
    include('pages/frontend/index.php');
    return;
}
