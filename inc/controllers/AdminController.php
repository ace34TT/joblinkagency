<?php

require_once(dirname(__FILE__) . '/../models/Admin.php');

class AdminController
{

    private $admin;

    public function __construct()
    {
        $this->admin = new Admin;
    }

    public function login($username, $password, $recruiter_id)
    {
        if ($this->admin->login($username, sha1($password), $recruiter_id) == true) {
            header('Location: index.php?action=admin_index');
            return;
        }
        header('Location: index.php?action=admin_login_form&error');
        return;
    }
}
