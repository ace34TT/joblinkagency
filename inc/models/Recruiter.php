<?php

require_once(dirname(__FILE__) . '/Connection.php');

class Recruiter extends Connection
{
    private $table = 'recruiters';
    private $fillable = array('name', 'status');

    public function __construct()
    {
        $this->init_connection($this->table, $this->fillable);
    }

    public function getActiveRecruiter()
    {
        try {
            $req = $this->pdo->query('SELECT *
                                    FROM recruiters
                                    ');
            $rows = $this->fetch_resultSet($req);
            return $rows;
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }
}
