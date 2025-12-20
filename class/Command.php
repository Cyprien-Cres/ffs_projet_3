<?php
class Command {
    public function command() {
        while (true) {
            $line = trim(readline("Entrez votre commande : "));
            if ($line === 'list') {
                $contacts = new Contact();
                $contact = $contacts->toString();
                echo $contact . "\n";
            } elseif (preg_match('/^detail(?:\s+(\d+))?$/', $line, $matches)) {
                $id = isset($matches[1]) && $matches[1] !== '' ? $matches[1] : trim(readline("Entrez l'id du contact : "));
                if ($id === '') {
                    echo "Aucun id fourni.\n";
                    continue;
                }
                $contact = new Contact();
                if ($contact === null || $contact === '') {
                    echo "Contact introuvable pour l'id $id.\n";
                } else {
                    $contactData = $contact->toString($id);
                    echo $contactData . "\n";
                }
            } else {
                echo "Votre commande : $line , n'est pas reconnue. Veuillez réessayer.\n";
            }
        }
    }
}
