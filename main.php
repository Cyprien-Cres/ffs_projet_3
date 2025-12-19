<?php
require "class/DBconnect.php";
require 'class/ContactManager.php';
require 'class/Contact.php';
while (true) {
    $line = readline("Entrez votre commande : ");
    if ($line === 'list') {
        echo "Affichage de la liste \n";
        $contacts = new Contact();
        $contact = $contacts->toString();
    } else {
        echo "Votre commande est : $line \n";
    }
}