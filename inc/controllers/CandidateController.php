<?php

require_once(dirname(__FILE__) . '/../models/Candidate.php');

class CandidateController
{
    private $candidate;

    public function __construct()
    {
        $this->candidate = new Candidate;
    }

    public function store($data, $file)
    {
        echo '<pre>', var_dump($file), '</pre>';
        if ($this->file_checker($file) == "file can be uploaded") {
            $this->store_file($file, $data[6]);
            $this->candidate->_save($data);
            $id = $this->candidate->getId($data[6]);
            header('Location: index.php?action=registration_form&id = ' . $id);
            return;
        } else {
            // header('Location: ' . $url . '&error=' . $this->file_checker($file));
            return;
        }
    }

    public function file_checker($file)
    {
        $target_dir = "assets/resumes/";
        $target_file = $target_dir . basename($file["name"]);
        $file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $status = "file can be uploaded";

        // Check if file already exists
        if (file_exists($target_file)) {
            $status = "Sorry, file already exists.";
        }

        // Check file size
        if ($file["size"] > 1000000) {
            $status = "Sorry, your file is too large.";
        }

        // Allow certain file formats
        if ($file_type != "pdf") {
            $status = "Sorry, only PDF files are allowed.";
        }

        return $status;
    }

    private function store_file($file, $name)
    {
        $target_dir = "assets/resumes/";
        $target_file = $target_dir . basename($file["name"]);
        // Check if $uploadOk is set to 0 by an error

        $target_file = $target_dir . $name . '.pdf';
        if (move_uploaded_file($file["tmp_name"], $target_file)) {
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }

    public function getPendings()
    {
        return $this->candidate->getPending($_SESSION['admin']['recruiter_id']);
    }

    public function getPretests()
    {
        return $this->candidate->getPretest($_SESSION['admin']['recruiter_id']);
    }

    public function getFinalTests()
    {
        return $this->candidate->getFinalTest($_SESSION['admin']['recruiter_id']);
    }

    public function getPretestFails()
    {
        return $this->candidate->getPretestFail($_SESSION['admin']['recruiter_id']);
    }

    public function getFinalTestFails()
    {
        return $this->candidate->getFinalTestFail($_SESSION['admin']['recruiter_id']);
    }

    public function getReceived()
    {
        return $this->candidate->getReceived($_SESSION['admin']['recruiter_id']);
    }

    public function savePending($id)
    {
        $this->candidate->savePending($id);
    }

    public function getCandidate($id)
    {
        return $this->candidate->_id($id);
    }

    public function pretestSetResult($id, $result, $post, $recruiter_id)
    {
        $this->candidate->setPretestResult($id, $result, $post, $recruiter_id);
    }

    public function saveFinaltest($id)
    {
        $this->candidate->saveFinaltest($id);
    }
}
