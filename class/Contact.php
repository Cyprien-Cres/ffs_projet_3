<?php
class Contact {
    public function getId() { // Récupère l'ID
        $contactManager = new ContactManager();
        $contacts = $contactManager->findAll();

        if (isset($contacts['id'])) {
            foreach ($contacts as $contact) {
                echo "ID: " . $contact['id'] . "\n";
            }
        } else {
            return NULL;
        }
    }
    public function getName() { // Récupère et affiche les noms des contacts
        $contactManager = new ContactManager();
        $contacts = $contactManager->findAll();
        if (isset($contacts['name'])) {
            foreach ($contacts as $contact) {
                echo "Name: " . $contact['name'] . "\n";
            }
        } else {
            return NULL;
        }
    }

    public function toString($id = null) {
        $contactManager = new ContactManager();

        if ($id !== null) {
            $result = $contactManager->findById($id);
            $contacts = isset($result['id']) ? [$result] : $result;
            echo "Contact :\n";
        } else {
            $contacts = $contactManager->findAll();
            echo "Contacts :\n";
        }

        foreach ($contacts as $contact) {
            echo "\n" . " - ID : " . ($contact['id'] ?? '')
                . "\n - Nom : " . ($contact['name'] ?? '')
                . "\n - Email : " . ($contact['email'] ?? '')
                . "\n - Numéro téléphone : " . ($contact['phone_number'] ?? '') . "\n";
        }
    }
}