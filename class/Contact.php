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
            if ($contacts === null || $contacts === '') {
                return "Aucun contact trouvé avec l'id : $id. \n";
            } else {
                echo "Contact :\n";

                foreach ($contacts as $contact) {
                    echo "\n" . " - ID : " . ($contact['id'] ?? '')
                        . "\n - Nom : " . ($contact['name'] ?? '')
                        . "\n - Email : " . ($contact['email'] ?? '')
                        . "\n - Numéro téléphone : " . ($contact['phone_number'] ?? '') . "\n";
                }
            }
        } else {
            $contacts = $contactManager->findAll();
            if ($contacts === null || $contacts === '') {
                return "Aucuns contacts trouvés.\n";
            } else {
                echo "Contacts :\n";
                foreach ($contacts as $contact) {
                    echo "\n" . " - ID : " . ($contact['id'] ?? '')
                        . "\n - Nom : " . ($contact['name'] ?? '')
                        . "\n - Email : " . ($contact['email'] ?? '')
                        . "\n - Numéro téléphone : " . ($contact['phone_number'] ?? '') . "\n";
                }
            }
        }
    }
}