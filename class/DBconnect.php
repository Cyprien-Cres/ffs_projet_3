<?php
declare(strict_types=1);
/**
 * Classe de connexion à la base de données.
 */
namespace Cyprien;
class DBconnect
{
    private $host; /** @var mixed|string  */
    private $db_name; /** @var mixed|string  */
    private $user; /** @var mixed|string  */
    private $pass; /** @var mixed|string  */
    private $pdo; /** @var \PDO  */


    /**
     * Constructeur qui initialise les paramètres de connexion à la base de données.
     */
    public function __construct()
    {
        $this->loadEnv();
        $this->host = $_ENV['DB_HOST'] ?? '127.0.0.1';
        $this->db_name = $_ENV['DB_NAME'] ?? '';
        $this->user = $_ENV['DB_USER'] ?? 'root';
        $this->pass = $_ENV['DB_PASS'] ?? '';
    }

    /**
     * Charge les variables d'environnement à partir du fichier .env.
     */
    private function loadEnv(): void
    {
        $envFile = __DIR__ . '/../.env';
        if (file_exists($envFile))
        {
            $lines = file($envFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
            foreach ($lines as $line)
            {
                if (strpos($line, '#') === 0) continue;
                if (strpos($line, '=') !== false)
                {
                    list($key, $value) = explode('=', $line, 2);
                    $_ENV[trim($key)] = trim($value);
                }
            }
        }
    }


    /**
     * Établit une connexion à la base de données et retourne l'objet PDO.
     *
     * @return \PDO Pour interagir avec la base de données.
     */
    public function connect(): \PDO
    {
        try
        {
            $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->db_name . ';charset=utf8mb4';
            $this->pdo = new \PDO($dsn, $this->user, $this->pass);
            $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            return $this->pdo;
        } catch (\PDOException $exception) {
            echo 'Erreur de connexion : ' . $exception->getMessage();
            exit;
        }
    }
}
