<?php

require_once(dirname(__FILE__) . '/Connection.php');

class Candidate extends Connection
{
    private $table = 'candidates';
    private $fillable = array('fullname', 'dateOfBirth', 'sexe', 'height', 'weight', 'region', 'email', 'phone', 'destination', 'post', 'situation');

    public function __construct()
    {
        $this->init_connection($this->table, $this->fillable);
    }

    public function getId($email)
    {
        try {
            $req = $this->pdo->prepare('SELECT id
                                        FROM candidates 
                                        WHERE email=?
                                        ');
            $req->execute(array($email));
            $rows = $this->fetch_resultSet($req);
            return $rows;
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }
}
