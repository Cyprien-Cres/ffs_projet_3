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
                $contacts = new Contact();
                $contact = $contacts->toString($id);
                if ($contact === null || $contact === '') {
                    echo "Contact introuvable pour l'id $id.\n";
                } else {
                    echo $contact . "\n";
                }
            } else {
                echo "Votre commande : $line , n'est pas reconnue. Veuillez réessayer.\n";
            }
        }
    }
}
