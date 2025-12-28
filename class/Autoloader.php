<?php
declare(strict_types=1);
namespace Cyprien;

/**
 * Classe Autoloader pour le chargement automatique des classes.
 */
class Autoloader
{
    /**
     * Méthode d'autochargement des classes.
     *
     * @param string $class Le nom de la classe à charger.
     */
    static function autoload($class): void
    {
        if (strpos($class, __NAMESPACE__) === 0) /** Vérifie si la classe appartient au namespace courant */
        {
            $class = str_replace(__NAMESPACE__, "", $class); /** Supprime le namespace de la chaîne de caractères */
            $class = str_replace('\\', "/", $class); /** Remplace les backslashes par des slashes */
            $pathFile = 'class/' . $class . '.php'; /** Construit le chemin du fichier de la classe */
        }

        if (file_exists($pathFile)) /** Vérifie si le fichier existe */
        {
            require $pathFile;
        }
    }

    /**
     * Enregistre l'autoloader.
     */
    static function register(): void
    {
        spl_autoload_register(array(__CLASS__, 'autoload'));
    }
}