<?php
class Connection {
    private $db = 'sismapurb';
    private $host = 'localhost';
    private $user = 'root';
    private $passwd = 'passwd';
    private $pdo;

    protected function connect()
    {
        try {
            $this->pdo = new PDO("mysql:host={$this->host};dbname={$this->db}", $this->user, $this->passwd);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return ($this->pdo);
        } catch (PDOException $e){
            echo $e->getMessage();
        }
    }

}

?>
