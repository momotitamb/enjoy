<?php

abstract class Model {
    public const CREATED_AT = 'created_at';

    abstract public function getTableName(): string;

    public static function getConnection(): PDO {
        return Database::getInstance();
    }
}