<?php

namespace Services;

class DB
{
    private \PDO $connection;
    private Interfaces\Logger $logger;
    private \PDOStatement|false $statement;

    public function __construct(\Services\Interfaces\Config $config, \Services\Interfaces\Logger $logger)
    {
        $this->logger = $logger;
        $dbConfig = $config->get('db.postgres');
        $this->connection = new \PDO($dbConfig['dsn'], $dbConfig['username'], $dbConfig['password']);
        $this->connection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_WARNING);
        $this->connection->query("SET NAMES 'utf8'");
    }

    public function query(string $query, array $params = []): bool
    {
        $this->statement = $this->connection->prepare($query);
        return $this->statement->execute($params);
    }

    public function get(string $query, array $params = []): array
    {
        $result = $this->query($query, $params);
        if (!$result) {
            $this->logger->error("$query failed to execute");
        }
        return $this->statement->fetchAll(\PDO::FETCH_ASSOC);
    }

}