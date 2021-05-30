<?php

require_once(dirname(__FILE__) . '/Connection.php');

class Candidate extends Connection
{
    private $table = 'candidates';
    private $fillable = array('fullname', 'dateOfBirth', 'sexe', 'height', 'weight', 'region', 'email', 'phone', 'recruiter_id', 'post', 'situation');

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

    public function getPending($recruiter_id)
    {
        try {
            $req = $this->pdo->prepare('SELECT * 
                                        FROM candidates
                                        WHERE situation = \'pending\'  
                                        AND recruiter_id = ?');
            $req->execute(array($recruiter_id));
            $rows = $this->fetch_resultSet($req);
            return $rows;
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }

    public function getPretest($recruiter_id)
    {
        try {
            $req = $this->pdo->prepare('SELECT * 
                                        FROM candidates
                                        WHERE situation = \'pretest\'  
                                        AND recruiter_id = ?');
            $req->execute(array($recruiter_id));
            $rows = $this->fetch_resultSet($req);
            return $rows;
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }
    public function getFinalTest($recruiter_id)
    {
        try {
            $req = $this->pdo->prepare('SELECT * 
                                        FROM candidates
                                        WHERE situation = \'finaltest\'  
                                        AND recruiter_id = ?');
            $req->execute(array($recruiter_id));
            $rows = $this->fetch_resultSet($req);
            return $rows;
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }

    public function getPretestFail($recruiter_id)
    {
        try {
            $req = $this->pdo->prepare('SELECT * 
                                        FROM candidates
                                        WHERE situation = \'pretestfail\'  
                                        AND recruiter_id = ?');
            $req->execute(array($recruiter_id));
            $rows = $this->fetch_resultSet($req);
            return $rows;
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }

    public function getFinalTestFail($recruiter_id)
    {
        try {
            $req = $this->pdo->prepare('SELECT * 
                                        FROM candidates
                                        WHERE situation = \'finaltestfail\'  
                                        AND recruiter_id = ?');
            $req->execute(array($recruiter_id));
            $rows = $this->fetch_resultSet($req);
            return $rows;
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }

    public function getReceived($recruiter_id)
    {
        try {
            $req = $this->pdo->prepare('SELECT * 
                                        FROM candidates
                                        WHERE situation = \'received\'  
                                        AND recruiter_id = ?');
            $req->execute(array($recruiter_id));
            $rows = $this->fetch_resultSet($req);
            return $rows;
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }

    public function savePending($id)
    {
        try {
            $req = $this->pdo->prepare('UPDATE candidates SET situation = \'pretest\' WHERE id = :id');
            $req->execute(array(
                'id' => $id
            ));
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }

    public function setPretestResult($id, $result, $post, $recruiter_id)
    {
        try {
            $req = $this->pdo->prepare('UPDATE candidates 
                                        SET situation = :result ,
                                        post = :post ,
                                        recruiter_id = :recruiter_id 
                                        WHERE id = :id');
            $req->execute(array(
                'result' => $result,
                'post' => $post,
                'id' => $id,
                'recruiter_id' => $recruiter_id
            ));
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }
    public function saveFinaltest($id)
    {
        try {
            $req = $this->pdo->prepare('UPDATE candidates SET situation = \'finaltest\' WHERE id = :id');
            $req->execute(array(
                'id' => $id
            ));
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }
}
