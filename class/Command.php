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
                $contactData = $contact->toString($id);
                echo $contactData . "\n";
            } elseif ($line === 'create') {
                $name = trim(readline("Entrez le nom du contact : "));
                $email = trim(readline("Entrez l'email du contact : "));
                $phone_number = trim(readline("Entrez le numéro de téléphone du contact : "));

                $newContact = new ContactManager();
                $newContact->create($name, $email, $phone_number);

                if ($newContact === null) {
                    echo "Échec de la création du contact. \n";
                } else {
                    echo "Contact créé avec succès.\n";
                }

            } elseif(preg_match('/^delete(?:\s+(\d+))?$/', $line, $matches)) {
                $id = isset($matches[1]) && $matches[1] !== '' ? $matches[1] : trim(readline("Entrez l'id du contact : "));
                if ($id === '') {
                    echo "Aucun id fourni.\n";
                    continue;
                }
                $contact = new ContactManager();
                $contactById = $contact->findById($id);
                if ($contactById === null || $contactById === '') {
                    echo "Contact introuvable pour l'id $id.\n";
                } else {
                    $contact->delete($id);
                    echo "Le contact à supprimé avec succès" . "\n";
                }
            } elseif($line === 'help') {
                echo "Commandes disponibles :\n" .
                    " - list : Affiche la liste de tous les contacts.\n" .
                    " - detail [id] : Affiche les détails du contact avec l'id spécifié. Si l'id n'est pas fourni.\n" .
                    " - create : Crée un nouveau contact en demandant le nom, l'email et le numéro de téléphone.\n" .
                    " - delete [id] : Supprime le contact avec l'id spécifié.\n" .
                    " - help : Affiche cette aide.\n";
            } else {
                echo "Votre commande : $line , n'est pas reconnue. Veuillez réessayer.\n";
            }
        }
    }
}
