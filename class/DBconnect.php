<?php
class DBconnect {
    private $host = '127.0.0.1';
    private $db_name = 'exercice_1_poo';
    private $user = 'root';
    private $pass = '';
    private $pdo;

    // Méthode de connexion
    public function connect() {
        try {
            $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->db_name . ';charset=utf8mb4';

            $this->pdo = new PDO($dsn, $this->user, $this->pass);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            return $this->pdo;
        } catch (Exception $exception) {
            echo 'Erreur de connexion : ' . $exception->getMessage();
            exit;
        }
    }
}
