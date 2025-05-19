<?php
namespace App;

use Doctrine\DBAL\DriverManager;

class Model
{
    protected $connection;
    protected $tableName;

    public function __construct()
    {
        $connectionParams = [
            'dbname' => $_ENV['DB_NAME'],
            'user' => $_ENV['DB_USERNAME'],
            'host' => $_ENV['DB_HOST'],
            'driver' => $_ENV['DB_DRIVER'],
        ];

        $this->connection = DriverManager::getConnection($connectionParams);
    }

    public function __destruct()
    {
        $this->connection->close();
    }

    public function findAll()
    {
        $querybuilder = $this->connection->createQueryBuilder();
        $querybuilder->select('*')->from($this->tableName);
        return $querybuilder->fetchAllAssociative();
    }

    public function paginate($pase = 1, $limit = 10)
    {
        $offset = ($pase - 1) * $limit;
        $queryBuilder = $this->connection->createQueryBuilder();
        $queryBuilder->select('*')
            ->from($this->tableName)
            ->setFirstResult($offset)
            ->setMaxResults($limit);
        $data = $queryBuilder->fetchAllAssociative();
        $totalPage = ceil($this->count() / $limit);
        return [
            'data' => $data,
            'page' => $pase,
            'limit' => $limit,
            'totalPage' => $totalPage
        ];
    }

    public function count()
    {
        $querybuiLder = $this->connection->createQueryBuilder();
        $querybuiLder->select('COUNT(*)as total')->from($this->tableName);
       
        return $querybuiLder->fetchOne();
    }

    public function find($id)
    {
        $querybuilder = $this->connection->createQueryBuilder();
        $querybuilder->select('*')
            ->from($this->tableName)
            ->where('id=:id')
            ->setParameter('id', $id);
        return $querybuilder->fetchAssociative();
    }

    public function insert(array $data)
    {
        $this->connection->insert($this->tableName, $data);
        return $this->connection->lastInsertId();
    }

    public function update($id, array $data)
    {
        return $this->connection->update($this->tableName, $data, ['id' => $id]);
    }

    public function delete($id)
    {
        return $this->connection->delete($this->tableName, ['id' => $id]);
    }

    public function beginTransaction()
    {
        $this->connection->beginTransaction();
    }

    public function commit()
    {
        $this->connection->rollblack();
    }
}