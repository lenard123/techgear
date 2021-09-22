<?php

use ByJG\DbMigration\Database\PgsqlDatabase;
use ByJG\DbMigration\Migration;
use ByJG\Util\Uri;

require_once 'BaseDatabase.php';


/**
 * @requires extension pdo_pgsql
 */
class PostgresDatabaseTest extends BaseDatabase
{
    /**
     * @var Migration
     */
    protected $migrate = null;

    public function setUp()
    {
        $host = getenv('PSQL_TEST_HOST');
        if (empty($host)) {
            $host = "127.0.0.1";
        }
        $password = getenv('PSQL_PASSWORD');
        if (empty($password)) {
            $password = 'password';
        }
        if ($password == '.') {
            $password = "";
        }

        $uri = "pgsql://postgres:${password}@${host}/migratedatabase";

        $this->migrate = new Migration(new Uri($uri), __DIR__ . '/../example/postgres', true, $this->migrationTable);
        $this->migrate->registerDatabase("pgsql", PgsqlDatabase::class);
        parent::setUp();
    }
}
