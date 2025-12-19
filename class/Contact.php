<?php
require_once 'DBconnect.php';
require_once 'ContactManager.php';
class Contact {
    public function getId() {
        $contactManager = new ContactManager();
        $contacts = $contactManager->findAll();

        foreach ($contacts as $contact) {
            echo "ID: " . $contact['id'] . "\n";
        }
    }
    public function getName() {
        $contactManager = new ContactManager();
        $contacts = $contactManager->findAll();

        foreach ($contacts as $contact) {
            echo "Name: " . $contact['name'] . "\n";
        }
    }

    public function toString() {
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