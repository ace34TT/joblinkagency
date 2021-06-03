<?php

require_once(dirname(__FILE__) . '/Connection.php');

class Admin extends Connection
{
    private $table = 'admins';
    private $fillable = array('name', 'username', 'password', 'recruiter_id');

    public function __construct()
    {
        $this->init_connection($this->table, $this->fillable);
    }

    function login($username, $password, $recruiter_id)
    {
        try {
            $this->pdo->beginTransaction();
            $req = $this->pdo->prepare('SELECT * FROM admins WHERE username = ? AND password = ? AND recruiter_id = ?');
            $req->execute(array($username, $password, $recruiter_id));
            $row = $this->fetch_resultSet($req);
            $this->pdo->commit();
            if ($row != null) {
                $_SESSION['admin'] = $row[0];
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            $this->pdo->rollback();
            die('Erreur : ' . $e->getMessage());
            exit;
        }
    }
}
