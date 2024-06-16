<?php

require_once __DIR__ . '/../../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . "/../../");
$dotenv->load();

use PHPUnit\Framework\TestCase;

class DatabaseTest extends TestCase
{
    private $pdo;

    protected function setUp(): void
    {
        $this->pdo = new PDO(
            'mysql:host=' . $_ENV['DB_HOST'],
            $_ENV['DB_USERNAME'],
            $_ENV['DB_PASSWORD']
        );
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    protected function tearDown(): void
    {
       
        $this->pdo = null;
    }

    private function createPostData()
    {
        return [
            'usuario' => '123',
            'senha' => password_hash('123', PASSWORD_BCRYPT)
        ];
    }

    public function testDatabaseCreation()
    {
        $connect = new Connect();
        $connect->getConnection();

        $stmt = $this->pdo->query("SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = '" . $_ENV['DB_NAME_TEST'] . "'");
        $databaseExists = $stmt->rowCount() > 0;

        $this->assertTrue($databaseExists);
    }

    public function testTableCreation()
    {
        $connect = new Connect();
        $connect->getConnection();

        $tables = require __DIR__ . '/../database/tables.php';
        $this->pdo->exec("USE " . $_ENV['DB_NAME_TEST']);

        foreach ($tables as $table) {
            $stmt = $this->pdo->query("SHOW TABLES LIKE '" . $table['name'] . "'");
            $tableExists = $stmt->rowCount() > 0;

            $this->assertTrue($tableExists);
        }
    }

    public function testConnect()
    {
        $this->assertInstanceOf(PDO::class, $this->pdo);
    }

   
}
