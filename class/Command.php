<?php
declare(strict_types=1);
namespace Cyprien;
use Cyprien\Contact;
use Cyprien\ContactManager;

/**
 * Classe pour gérer les commandes liées aux contacts.
 */
class Command {

    /**
     * Exécute la boucle de commande pour interagir avec l'utilisateur.
     */
    public function command(): string
    {
        while (true)
        {
            $line = trim(readline("Entrez votre commande : "));
            if ($line === 'list') /** Affiche la liste de tous les contacts */
            {
                $contacts = new Contact();
                $contact = $contacts->toString();
                echo $contact . "\n";
            } elseif (preg_match('/^detail(?:\s+(\d+))?$/', $line, $matches)) /** Affiche les détails d'un contact spécifique */
            {
                $id = isset($matches[1]) && $matches[1] !== '' ? $matches[1] : (int)trim(readline("Entrez l'id du contact : "));
                if ($id === '') /** Si aucun id n'est fourni, demande à l'utilisateur de le saisir */
                {
                    echo "Aucun id fourni.\n";
                    continue;
                }
                $contactManager = new ContactManager();
                $contactData = $contactManager->findById($id);

                if ($contactData === null || $contactData === false) /** Vérifie si le contact existe */
                {
                    echo "Contact introuvable pour l'id $id.\n";
                } else
                {
                    $contact = new Contact();
                    echo $contact->toString($id) . "\n";
                }
            } elseif ($line === 'create') /** Crée un nouveau contact */
            {
                $name = trim(readline("Entrez le nom du contact : "));
                $email = trim(readline("Entrez l'email du contact : "));
                $phone_number = trim(readline("Entrez le numéro de téléphone du contact : "));

                $newContact = new ContactManager();

                if($name === '' || $email === '' || $phone_number === '') /** Vérifie que tous les champs sont remplis */
                {
                    echo "Tous les champs sont obligatoires. Veuillez réessayer.\n";
                    continue;
                }
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) /** Vérifie que l'email est valide */
                {
                    echo "Le format de l'email est invalide. Veuillez réessayer.\n";
                    continue;
                }
                if (!ctype_digit($phone_number) || strlen($phone_number) !== 10) /** Vérifie que le numéro de téléphone est valide */
                {
                    echo "Le numéro de téléphone est invalide. Veuillez réessayer.\n";
                    continue;
                }
                if ($newContact === null) /** Vérifie que l'instance de ContactManager a été créée avec succès */
                {
                    echo "Échec de la création du contact. \n";
                } else /** Crée le nouveau contact */
                {
                    $newContact->create($name, $email, $phone_number);
                    echo "Contact créé avec succès.\n";
                }

            } elseif(preg_match('/^delete(?:\s+(\d+))?$/', $line, $matches)) /** Supprime un contact spécifique */
            {
                $id = isset($matches[1]) && $matches[1] !== '' ? $matches[1] : (int)trim(readline("Entrez l'id du contact : "));
                if ($id === '') /** Si aucun id n'est fourni, demande à l'utilisateur de le saisir */
                {
                    echo "Id invalide.\n";
                    continue;
                }
                $contact = new ContactManager();
                $contactById = $contact->findById($id);
                if ($contactById === null || $contactById === '') /** Vérifie si le contact existe avant de le supprimer */
                {
                    echo "Contact introuvable pour l'id $id.\n";
                } else
                {
                    $contact->delete($id);
                    echo "Le contact à supprimé avec succès" . "\n";
                }
            } elseif($line === 'help') /** Affiche l'aide */
            {
                echo "Commandes disponibles :\n" .
                    " - list : Affiche la liste de tous les contacts.\n" .
                    " - detail [id] : Affiche les détails du contact avec l'id spécifié. Si l'id n'est pas fourni.\n" .
                    " - create : Crée un nouveau contact en demandant le nom, l'email et le numéro de téléphone.\n" .
                    " - delete [id] : Supprime le contact avec l'id spécifié.\n" .
                    " - help : Affiche cette aide.\n";
            } elseif($line === 'quit') /** Quitte le programme */
            {
                echo "Au revoir !\n";
                break;
            } else /** Gère les commandes non reconnues */
            {
                echo "Votre commande : $line , n'est pas reconnue. Veuillez réessayer.\n";
            }
        }
        return '';
    }
}