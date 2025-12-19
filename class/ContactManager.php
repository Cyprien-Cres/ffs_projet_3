<?php
require_once 'DBconnect.php';

class ContactManager {
    public function findAll() // Récupère tous les contacts de la base de données
    {
        $db = new DBconnect();
        $pdo = $db->connect();

        try {
            $stmt = $pdo->prepare('SELECT * FROM contact');
            if ($stmt === false) {
                return "Échec de la préparation de la requête.";
            }

            if ($stmt->execute() === false) {
                return "Échec de l'exécution de la requête.";
            }

            $contacts = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $contacts ?: [];
        } catch (PDOException $e) {
            return "Échec de la requête : " . $e->getMessage();
        }
    }
}