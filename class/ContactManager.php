<?php
require_once 'DBconnect.php';

class ContactManager {
    public function findAll()
    {
        $db = new DBconnect();
        $pdo = $db->connect();

        try {
            $stmt = $pdo->prepare('SELECT * FROM contact');
            if ($stmt === false) {
                return [];
            }

            if ($stmt->execute() === false) {
                return [];
            }

            $contacts = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $contacts ?: [];
        } catch (PDOException $e) {
            return [];
        }
    }
}