<?php
namespace CresCyprien;
/**
 * Fichier principal pour exécuter les commandes liées aux contacts.
 */
use Cyprien\Autoloader;
use Cyprien\Command;
require 'class/Autoloader.php';
Autoloader::register();

$command = new Command();
$command->command();