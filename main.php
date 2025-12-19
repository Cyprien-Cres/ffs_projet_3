<?php
require "class/DBconnect.php";
require 'class/ContactManager.php';
require 'class/Contact.php';
require 'class/Command.php';

$command = new Command();
$command->command();