<?php

require_once(dirname(__FILE__) . '/../models/Comment.php');

class CommnetController
{
    private $comment;

    public function __construct()
    {
        $this->comment = new Comment;
    }
    public function store($data)
    {
        $this->comment->_save($data);
    }

    public function get_canidate_comments($candidate)
    {
        return $this->comment->candidate_comments($candidate);
    }
}
