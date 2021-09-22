<?php

namespace ByJG\AnyDataset\Db;

use ByJG\AnyDataset\Core\Enum\Relation;
use ByJG\AnyDataset\Core\IteratorFilterFormatter;
use ByJG\AnyDataset\Db\Helpers\SqlHelper;

class IteratorFilterSqlFormatter extends IteratorFilterFormatter
{
    public function format($filters, $tableName = null, &$params = [], $returnFields = "*")
    {
        $params = array();

        $sql = "select @@returnFields from @@tableName ";
        $sqlFilter = $this->getFilter($filters, $params);
        if ($sqlFilter != "") {
            $sql .= " where @@sqlFilter ";
        }

        return SqlHelper::createSafeSQL(
            $sql,
            [
                "@@returnFields" => $returnFields,
                "@@tableName" => $tableName,
                "@@sqlFilter" => $sqlFilter
            ]
        );
    }

    public function getRelation($name, $relation, $value, &$param)
    {
        $paramName = $name;
        $counter = 0;
        while (array_key_exists($paramName, $param)) {
            $paramName = $name . ($counter++);
        }

        $paramStr = function (&$param, $paramName, $value) {
            $param[$paramName] = trim($value);
            $result = "[[$paramName]]";
            if (is_object($value)) {
                unset($param[$paramName]);
                $result = $value->__toString();
            }
            return $result;
        };

        $data = [
            Relation::EQUAL => function (&$param, $name, $paramName, $value) use ($paramStr) {
                return " $name = " . $paramStr($param, $paramName, $value) . ' ';
            },

            Relation::GREATER_THAN => function (&$param, $name, $paramName, $value) use ($paramStr) {
                return " $name > " . $paramStr($param, $paramName, $value) . ' ';
            },

            Relation::LESS_THAN => function (&$param, $name, $paramName, $value) use ($paramStr) {
                return " $name < " . $paramStr($param, $paramName, $value) . ' ';
            },

            Relation::GREATER_OR_EQUAL_THAN => function (&$param, $name, $paramName, $value) use ($paramStr) {
                return " $name >= " . $paramStr($param, $paramName, $value) . ' ';
            },

            Relation::LESS_OR_EQUAL_THAN => function (&$param, $name, $paramName, $value) use ($paramStr) {
                return " $name <= " . $paramStr($param, $paramName, $value) . ' ';
            },

            Relation::NOT_EQUAL => function (&$param, $name, $paramName, $value) use ($paramStr) {
                return " $name <> " . $paramStr($param, $paramName, $value) . ' ';
            },

            Relation::STARTS_WITH => function (&$param, $name, $paramName, $value) use ($paramStr) {
                $value .= "%";
                return " $name  like  " . $paramStr($param, $paramName, $value) . ' ';
            },

            Relation::CONTAINS => function (&$param, $name, $paramName, $value) use ($paramStr) {
                $value = "%" . $value . "%";
                return " $name  like  " . $paramStr($param, $paramName, $value) . ' ';
            }
        ];

        return $data[$relation]($param, $name, $paramName, $value);
    }
}
