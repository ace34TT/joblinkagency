<?php

require_once(dirname(__FILE__) . '/Connection.php');

class Comment extends Connection
{

    private $table = 'comments';

    private $fillable = array('candidate_id', 'value', 'author');

    public function __construct()
    {
        $this->init_connection($this->table, $this->fillable);
    }

    public function candidate_comments($candidate)
    {
        try {
            $req = $this->pdo->prepare('SELECT * FROM comments WHERE candidate_id = ? ORDER BY created_at DESC');
            $req->execute(array($candidate));
            return $this->fetch_resultSet($req);
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
        return null;
    }
}
