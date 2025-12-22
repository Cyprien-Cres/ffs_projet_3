<?php

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

    public function findById($id) {
        $db = new DBconnect();
        $pdo = $db->connect();

        try {
            $stmt = $pdo->prepare('SELECT * FROM contact WHERE id = :id');
            if ($stmt === false) {
                return "Échec de la préparation de la requête.";
            }

            $stmt->bindParam(':id', $id, PDO::PARAM_INT);

            if ($stmt->execute() === false) {
                return "Échec de l'exécution de la requête.";
            }

            $contacts = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $contacts ?: "";
        } catch (PDOException $e) {
            return "Échec de la requête : " . $e->getMessage();
        }
    }

    public function create($name, $email, $phone_number) {
        $db = new DBconnect();
        $pdo = $db->connect();

        try {
            $stmt = $pdo->prepare('INSERT INTO contact (name, email, phone_number) VALUES (:name, :email, :phone_number)');
            if ($stmt === false) {
                return "Échec de la préparation de la requête.";
            }

            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':phone_number', $phone_number);
            $stmt->execute();
        } catch (PDOException $e) {
            return "Échec de la requête : " . $e->getMessage();
        }
    }

    public function delete($id) {
        $db = new DBconnect();
        $pdo = $db->connect();

        try {
            $stmt = $pdo->prepare('DELETE FROM contact WHERE id = :id');
            if ($stmt === false) {
                return "Échec de la préparation de la requête.";
            }

            $stmt->bindParam(':id', $id, PDO::PARAM_INT);

            if ($stmt->execute() === false) {
                return "Échec de l'exécution de la requête.";
            }
        } catch (PDOException $e) {
            return "Échec de la requête : " . $e->getMessage();
        }
    }
}