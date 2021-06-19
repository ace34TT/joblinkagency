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
        foreach ($data as $field) {
            if ($field == '' || $field == 'Région' || $field == 'pour') {
                header('Location: index.php?action=registration_form&error=SVP ,tâcher à bien remplir chaques champs');
                return;
            }
        }
        if ($this->file_checker($file) == "file can be uploaded" && $this->candidate->getId($data[6]) == NULL) {
            $this->candidate->_save($data);
            $this->store_file($file, $data[6]);
            $id = $this->candidate->getId($data[6]);
            header('Location: index.php?action=registration_form&id = ' . $id);
            return;
        } else {
            if ($this->candidate->getId($data[6]) == NULL) {
                header('Location: index.php?action=registration_form&error=Email already used');
                return;
            }
            header('Location: index.php?action=registration_form&error=' . $this->file_checker($file));
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

    public function update_resume($email, $id, $resume)
    {
        $file_status = $this->file_checker($resume);
        if ($this->check_candidate($email, $id) && file_exists("assets/resumes/" . $email . ".pdf")) {
            if ($this->file_checker($resume) == "file can be uploaded") {
                unlink("assets/resumes/" . $email . ".pdf");
                $this->store_file($resume, $email);
                header('Location: index.php?action=update_resume_form&message=Votre CV a été mis à jour');
                return;
            }
            header('Location: index.php?action=update_resume_form&message=Le fichier que vous essayer d\'envoyer est invalide');
            return;
        }
        header('Location: index.php?action=update_resume_form&message=Identifiants introuvable(s)');
        return;
    }

    public function check_candidate($email, $id)
    {
        return $this->candidate->check_credentidal($email, $id);
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

    public function send_message($email)
    {
        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

        // Create email headers
        $from = $email['email'];
        $headers .= 'From: ' . $from . "\r\n" .
            'Reply-To: ' . $from . "\r\n" .
            'X-Mailer: PHP/' . phpversion();

        $to = "info@joblinkagency.com";
        $subject = "Validation link";

        $message = '<html><body>';
        $message .= $email['message'];
        $message .= '</body></html>';

        mail($to, $subject, $message, $headers);
    }
}
