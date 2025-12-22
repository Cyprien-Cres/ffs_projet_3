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

    public function toString($id = null) { // Affiche les informations d'un contact spécifique ou de tous les contacts
        $contactManager = new ContactManager();

        if ($id !== null) { // Si un ID est fourni, afficher les informations du contact correspondant
            $result = $contactManager->findById($id);
            $contacts = isset($result['id']) ? [$result] : $result;
            if ($contacts === null || $contacts === '') {
                return "Aucun contact trouvé avec l'id : $id. \n";
            } else {
                echo "Contact :\n";// Afficher les informations du contact
                foreach ($contacts as $contact) { // Boucle permettant d'afficher les informations de chaque contact
                    echo "(" . ($contact->id ?? '')
                        . ", " . ($contact->name ?? '')
                        . ", " . ($contact->email ?? '')
                        . ", " . ($contact->phone_number ?? '') . ") \n";
                }
            }
        } else { // Si aucun ID n'est fourni, afficher les informations de tous les contacts
            $contacts = $contactManager->findAll();
            if ($contacts === null || $contacts === '') {
                return "Aucuns contacts trouvés.\n";
            } else {
                echo "Contacts :\n";
                foreach ($contacts as $contact) { // Boucle permettant d'afficher les informations de chaque contact
                    echo "(" . ($contact->id ?? '')
                        . ", " . ($contact->name ?? '')
                        . ", " . ($contact->email ?? '')
                        . ", " . ($contact->phone_number ?? '') . ") \n";
                }
            }
        }
    }
}