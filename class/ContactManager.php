<?php
declare(strict_types=1);
namespace Cyprien;
use Cyprien\DBconnect;
/**
 * Classe de gestion des contacts.
 */
class ContactManager {

    /**
     * Récupère tous les contacts.
     *
     * @return array|string Liste des contacts ou message d'erreur.
     */
    public function findAll(): array|string
    {
        $db = new DBconnect();
        $pdo = $db->connect();

        try
        {
            $stmt = $pdo->prepare('SELECT * FROM contact');
            if ($stmt === false)
            {
                return "Échec de la préparation de la requête.";
            }

            if ($stmt->execute() === false)
            {
                return "Échec de l'exécution de la requête.";
            }

            $contacts = $stmt->fetchAll(\PDO::FETCH_OBJ);
            return $contacts ?: [];
        } catch (\PDOException $e)
        {
            return "Échec de la requête : " . $e->getMessage();
        }
    }

    /**
     * Récupère un contact par son ID.
     *
     * @param string $id ID du contact.
     * @return array|string|null Contact trouvé ou message d'erreur.
     */
    public function findById(string $id): array|string|null
    {
        $db = new DBconnect();
        $pdo = $db->connect();

        try
        {
            $stmt = $pdo->prepare('SELECT * FROM contact WHERE id = :id');
            if ($stmt === false)
            {
                return "Échec de la préparation de la requête.";
            }

            $stmt->bindParam(':id', $id, \PDO::PARAM_INT);
            $stmtExecute = $stmt->execute();

            if ($stmtExecute === false)
            {
                return "Échec de l'exécution de la requête.";
            }

            $contacts = $stmt->fetchAll(\PDO::FETCH_OBJ);
            return $contacts ?: null;
        } catch (\PDOException $e)
        {
            return "Échec de la requête : " . $e->getMessage();
        }
    }

    /**
     * Crée un nouveau contact.
     *
     * @param string $name Nom du contact.
     * @param string $email Email du contact.
     * @param string $phone_number Numéro de téléphone du contact.
     * @return null|string Message d'erreur en cas d'échec.
     */
    public function create(string $name, string $email, string $phone_number): null|string
    {
        $db = new DBconnect();
        $pdo = $db->connect();

        try {
            $stmt = $pdo->prepare('INSERT INTO contact (name, email, phone_number) VALUES (:name, :email, :phone_number)');
            if ($stmt === false)
            {
                return "Échec de la préparation de la requête.";
            }

            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':phone_number', $phone_number);
            $stmt->execute();
            return null;
        } catch (\PDOException $e)
        {
            return "Échec de la requête : " . $e->getMessage();
        }
    }

    /**
     * Supprime un contact par son ID.
     *
     * @param string $id ID du contact à supprimer.
     * @return void|string Message d'erreur en cas d'échec.
     */
    public function delete(string $id): null|string
    {
        $db = new DBconnect();
        $pdo = $db->connect();

        try
        {
            $stmt = $pdo->prepare('DELETE FROM contact WHERE id = :id');
            if ($stmt === false)
            {
                return "Échec de la préparation de la requête.";
            }

            $stmt->bindParam(':id', $id, \PDO::PARAM_INT);
            $stmtExecute = $stmt->execute();
            if ($stmtExecute=== false)
            {
                return "Échec de l'exécution de la requête.";
            }
            return null;
        } catch (\PDOException $e)
        {
            return "Échec de la requête : " . $e->getMessage();
        }
    }
}