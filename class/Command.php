<?php
class Command {
    public function command() {
        while (true) {
            $line = trim(readline("Entrez votre commande : "));
            if ($line === 'list') {
                $contacts = new Contact();
                $contact = $contacts->toString();
                echo $contact . "\n";
            } else {
                echo "Votre commande : $line , n'est pas reconnue. Veuillez réessayer.\n";
            }
        }
    }
}
