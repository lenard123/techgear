<?php

namespace ByJG\AnyDataset\Db;

use ByJG\Util\Uri;

class Factory
{
    /**
     * @param $connectionString
     * @param $schemesAlternative
     * @return \ByJG\AnyDataset\Db\DbDriverInterface
     */
    public static function getDbRelationalInstance($connectionString, $schemesAlternative = null)
    {
        return self::getDbInstance(new Uri($connectionString), $schemesAlternative);
    }


    /**
     * @param $connectionUri Uri
     * @param $schemesAlternative
     * @return mixed
     */
    public static function getDbInstance($connectionUri, $schemesAlternative = null)
    {
        $scheme = $connectionUri->getScheme();

        $prefix = '\\ByJG\\AnyDataset\\Db\\';
        $validSchemes =  array_merge(
            [
                "oci8" => $prefix . "DbOci8Driver",
                "dblib" => $prefix . "PdoDblib",
                "sqlsrv" => $prefix . "PdoSqlsrv",
                "mysql" => $prefix . "PdoMysql",
                "pgsql" => $prefix . "PdoPgsql",
                "oci" => $prefix . "PdoOci",
                "odbc" => $prefix . "PdoOdbc",
                "sqlite" => $prefix . "PdoSqlite",
                "pdo" => $prefix . "PdoPdo"
            ],
            (array)$schemesAlternative
        );

        if (!isset($validSchemes[$scheme])) {
            throw new \InvalidArgumentException("The '$scheme' scheme does not exist. Check the scheme name or use the Generic PDO scheme");
        }

        $class = $validSchemes[$scheme];

        $instance = new $class($connectionUri);

        if (!($instance instanceof DbDriverInterface)) {
            throw new \InvalidArgumentException(
                "The class '$class' is not a instance of DbDriverInterface"
            );
        }

        return $instance;
    }

    /**
     * Get a IDbFunctions class to execute Database specific operations.
     *
     * @param \ByJG\Util\Uri $connectionUri
     * @return \ByJG\AnyDataset\Db\DbFunctionsInterface
     */
    public static function getDbFunctions(Uri $connectionUri)
    {
        $dbFunc = "\\ByJG\\AnyDataset\\Db\\Helpers\\Db"
            . ucfirst($connectionUri->getScheme())
            . "Functions";
        return new $dbFunc();
    }
}
