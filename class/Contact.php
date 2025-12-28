<?php
declare(strict_types=1);
namespace Cyprien;
use Cyprien\ContactManager;

/**
 * Classe Contact pour gérer les informations des contacts.
 */
class Contact
{
    /** Récupère l'ID du contact
     * @return int|null L'ID du contact ou NULL si non disponible.
     */
    public function getId(): int|null /** Récupère et affiche les IDs des contacts */
    {
        $contactManager = new ContactManager();
        $contacts = $contactManager->findAll();

        if (isset($contacts['id']))
        {
            foreach ($contacts as $contact)
            {
                echo "ID: " . $contact['id'] . "\n";
            }
        } else
        {
            return null;
        }
        return null;
    }

    /** Récupère le nom du contact
     * @return string|null Le nom du contact ou NULL si non disponible.
     */
    public function getName(): string|null /** Récupère et affiche les noms des contacts */
    {
        $contactManager = new ContactManager();
        $contacts = $contactManager->findAll();
        if (isset($contacts['name']))
        {
            foreach ($contacts as $contact)
            {
                echo "Name: " . $contact['name'] . "\n";
            }
        } else
        {
            return null;
        }
        return null;
    }

    /** Récupère et affiche les informations des contacts
     * @param int|null $id L'ID du contact à afficher (optionnel).
     * @return string
     */
    public function toString($id = null): string
        /** Affiche les informations d'un contact spécifique ou de tous les contacts */
    {
        $contactManager = new ContactManager();

        if ($id !== null) /** Si un ID est fourni, afficher les informations du contact correspondant */
        {
            $result = $contactManager->findById((string) $id);
            $contacts = isset($result['id']) ? [$result] : $result;
            if ($contacts === null || $contacts === '')
            {
                return "Aucun contact trouvé avec l'id : $id. \n";
            } else
            {
                echo "Contact :\n";
                foreach ($contacts as $contact)
                {
                    echo "(" . ($contact->id ?? '')
                        . ", " . ($contact->name ?? '')
                        . ", " . ($contact->email ?? '')
                        . ", " . ($contact->phone_number ?? '') . ") \n";
                }
            }
        }
        $contacts = $contactManager->findAll(); /** Si aucun ID n'est fourni, afficher les informations de tous les contacts */
        if ($contacts === null || $contacts === '')
        {
            return "Aucuns contacts trouvés.\n";
        } else
        {
            echo "Contacts :\n";
            foreach ($contacts as $contact)
            {
                echo "(" . ($contact->id ?? '')
                    . ", " . ($contact->name ?? '')
                    . ", " . ($contact->email ?? '')
                    . ", " . ($contact->phone_number ?? '') . ") \n";
            }
        }
        return "";
    }
}