<?php
namespace App\Models;
use App\Model;

class Payment extends Model
{
    protected $tableName = 'payment';

    public function insert(array $data)
    {
        return $this->connection->insert($this->tableName, $data);
    }

    public function findByOrderId($orderId)
    {
        return $this->connection->createQueryBuilder()
            ->select('*')
            ->from($this->tableName)
            ->where('id_dathang = ?')
            ->setParameter(0, $orderId)
            ->executeQuery()
            ->fetchAssociative();
    }
} 