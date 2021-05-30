<?php

require_once(dirname(__FILE__) . '/../models/Recruiter.php');

class RecruiterController
{
    private $recruiter;

    public function __construct()
    {
        $this->recruiter = new Recruiter;
    }

    public function index()
    {
        return $this->recruiter->getActiveRecruiter();
    }
}
