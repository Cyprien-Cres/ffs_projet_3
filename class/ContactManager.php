<?php
class ContactManager {
    public function findAll() { // Récupère tous les contacts
        $db = new DBconnect();
        $pdo = $db->connect();

        try { // Préparation et exécution de la requête SQL
            $stmt = $pdo->prepare('SELECT * FROM contact');
            if ($stmt === false) {
                return "Échec de la préparation de la requête.";
            }

            if ($stmt->execute() === false) {
                return "Échec de l'exécution de la requête.";
            }

            $contacts = $stmt->fetchAll(PDO::FETCH_OBJ);
            return $contacts ?: [];
        } catch (PDOException $e) { // Gestion des erreurs
            return "Échec de la requête : " . $e->getMessage();
        }
    }

    public function findById($id) { // Récupère un contact par son ID
        $db = new DBconnect();
        $pdo = $db->connect();

        try { // Préparation et exécution de la requête SQL
            $stmt = $pdo->prepare('SELECT * FROM contact WHERE id = :id');
            if ($stmt === false) {
                return "Échec de la préparation de la requête.";
            }

            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmtExecute = $stmt->execute();

            if ($stmtExecute === false) {
                return "Échec de l'exécution de la requête.";
            }

            $contacts = $stmt->fetchAll(PDO::FETCH_OBJ);
            return $contacts ?: [];
        } catch (PDOException $e) { // Gestion des erreurs
            return "Échec de la requête : " . $e->getMessage();
        }
    }

    public function create(string $name, string $email, string $phone_number){ // Crée un nouveau contact
        $db = new DBconnect();
        $pdo = $db->connect();

        try { // Préparation et exécution de la requête SQL
            $stmt = $pdo->prepare('INSERT INTO contact (name, email, phone_number) VALUES (:name, :email, :phone_number)');
            if ($stmt === false) {
                return "Échec de la préparation de la requête.";
            }

            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':phone_number', $phone_number);
            $stmt->execute();
        } catch (PDOException $e) { // Gestion des erreurs
            return "Échec de la requête : " . $e->getMessage();
        }
    }

    public function delete(int $id){ // Supprime un contact par son ID
        $db = new DBconnect();
        $pdo = $db->connect();

        try { // Préparation et exécution de la requête SQL
            $stmt = $pdo->prepare('DELETE FROM contact WHERE id = :id');
            if ($stmt === false) {
                return "Échec de la préparation de la requête.";
            }

            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmtExecute = $stmt->execute();
            if ($stmtExecute=== false) {
                return "Échec de l'exécution de la requête.";
            }
        } catch (PDOException $e) { // Gestion des erreurs
            return "Échec de la requête : " . $e->getMessage();
        }
    }
}