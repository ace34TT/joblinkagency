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
            $this->pdo->beginTransaction();
            $req = $this->pdo->prepare('SELECT id
                                        FROM candidates 
                                        WHERE email=?
                                        ');
            $req->execute(array($email));
            $rows = $this->fetch_resultSet($req);
            $this->pdo->commit();
            return $rows;
        } catch (Exception $e) {
            $this->pdo->rollback();
            die('Erreur : ' . $e->getMessage());
            exit;
        }
    }

    public function getPending($recruiter_id)
    {
        try {
            $this->pdo->beginTransaction();
            $req = $this->pdo->prepare('SELECT * 
                                        FROM candidates
                                        WHERE situation = \'pending\'  
                                        AND recruiter_id = ?');
            $req->execute(array($recruiter_id));
            $rows = $this->fetch_resultSet($req);
            $this->pdo->commit();
            return $rows;
        } catch (Exception $e) {
            $this->pdo->rollback();
            die('Erreur : ' . $e->getMessage());
            exit;
        }
    }

    public function getPretest($recruiter_id)
    {
        try {
            $this->pdo->beginTransaction();
            $req = $this->pdo->prepare('SELECT * 
                                        FROM candidates
                                        WHERE situation = \'pretest\'  
                                        AND recruiter_id = ?');
            $req->execute(array($recruiter_id));
            $rows = $this->fetch_resultSet($req);
            $this->pdo->commit();
            return $rows;
        } catch (Exception $e) {
            $this->pdo->rollback();
            die('Erreur : ' . $e->getMessage());
            exit;
        }
    }
    public function getFinalTest($recruiter_id)
    {
        try {
            $this->pdo->beginTransaction();
            $req = $this->pdo->prepare('SELECT * 
                                        FROM candidates
                                        WHERE situation = \'finaltest\'  
                                        AND recruiter_id = ?');
            $req->execute(array($recruiter_id));
            $rows = $this->fetch_resultSet($req);
            $this->pdo->commit();
            return $rows;
        } catch (Exception $e) {
            $this->pdo->rollback();
            die('Erreur : ' . $e->getMessage());
            exit;
        }
    }

    public function getPretestFail($recruiter_id)
    {
        try {
            $this->pdo->beginTransaction();
            $req = $this->pdo->prepare('SELECT * 
                                        FROM candidates
                                        WHERE situation = \'pretestfail\'  
                                        AND recruiter_id = ?');
            $req->execute(array($recruiter_id));
            $rows = $this->fetch_resultSet($req);
            $this->pdo->commit();
            return $rows;
        } catch (Exception $e) {
            $this->pdo->rollback();
            die('Erreur : ' . $e->getMessage());
            exit;
        }
    }

    public function getFinalTestFail($recruiter_id)
    {
        try {
            $this->pdo->beginTransaction();
            $req = $this->pdo->prepare('SELECT * 
                                        FROM candidates
                                        WHERE situation = \'finaltestfail\'  
                                        AND recruiter_id = ?');
            $req->execute(array($recruiter_id));
            $rows = $this->fetch_resultSet($req);
            $this->pdo->commit();
            return $rows;
        } catch (Exception $e) {
            $this->pdo->rollback();
            die('Erreur : ' . $e->getMessage());
            exit;
        }
    }

    public function getReceived($recruiter_id)
    {
        try {
            $this->pdo->beginTransaction();
            $req = $this->pdo->prepare('SELECT * 
                                        FROM candidates
                                        WHERE situation = \'received\'  
                                        AND recruiter_id = ?');
            $req->execute(array($recruiter_id));
            $rows = $this->fetch_resultSet($req);
            $this->pdo->commit();
            return $rows;
        } catch (Exception $e) {
            $this->pdo->rollback();
            die('Erreur : ' . $e->getMessage());
            exit;
        }
    }

    public function savePending($id)
    {
        try {
            $this->pdo->beginTransaction();
            $req = $this->pdo->prepare('UPDATE candidates SET situation = \'pretest\' WHERE id = :id');
            $req->execute(array(
                'id' => $id
            ));
            $this->pdo->commit();
        } catch (Exception $e) {
            $this->pdo->rollback();
            die('Erreur : ' . $e->getMessage());
            exit;
        }
    }

    public function setPretestResult($id, $result, $post, $recruiter_id)
    {
        try {
            $this->pdo->beginTransaction();
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
            $this->pdo->commit();
        } catch (Exception $e) {
            $this->pdo->rollback();
            die('Erreur : ' . $e->getMessage());
            exit;
        }
    }
    public function saveFinaltest($id)
    {
        try {
            $this->pdo->beginTransaction();
            $req = $this->pdo->prepare('UPDATE candidates SET situation = \'finaltest\' WHERE id = :id');
            $req->execute(array(
                'id' => $id
            ));
            $this->pdo->commit();
        } catch (Exception $e) {
            $this->pdo->rollback();
            die('Erreur : ' . $e->getMessage());
            exit;
        }
    }
    function check_credentidal($email, $id)
    {
        try {
            $this->pdo->beginTransaction();
            $req = $this->pdo->prepare('SELECT * FROM candidates WHERE email = ? AND id = ?');
            $req->execute(array($email, $id));
            $row = $this->fetch_resultSet($req);
            $this->pdo->commit();
            if ($row != null) {
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
