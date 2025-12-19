<?php
require_once 'DBconnect.php';
require_once 'ContactManager.php';
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

    public function toString() { // Affiche toutes les informations des contacts sous forme de chaîne de caractères
        $contactManager = new ContactManager();
        $contacts = $contactManager->findAll();

        foreach ($contacts as $contact) {
            echo "Contact : "  . "\n" . " - ID : " . $contact['id']
                . "\n" . " - Nom : " . $contact['name']
                . "\n" . " - Email : " . $contact['email']
                . "\n" . " - Numéro téléphone : " . $contact['phone_number'] . "\n";
        }
    }
}