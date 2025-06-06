<?php
namespace App\Models;
use App\Model;

class Order extends Model
{
    protected $tableName = 'orders';

    public function insertGetId(array $data)
    {
        $this->connection->insert($this->tableName, $data);
        return $this->connection->lastInsertId();
    }

    public function find($id)
    {
        return $this->connection->createQueryBuilder()
            ->select('*')
            ->from($this->tableName)
            ->where('id = ?')
            ->setParameter(0, $id)
            ->executeQuery()
            ->fetchAssociative();
    }

    public function update($id, array $data)
    {
        return $this->connection->update($this->tableName, $data, ['id' => $id]);
    }

    public function delete($id)
    {
        return $this->connection->delete($this->tableName, ['id' => $id]);
    }

    public function findAllByUser($userId)
    {
        return $this->connection->createQueryBuilder()
            ->select('*')
            ->from($this->tableName)
            ->where('id_KH = ?')
            ->setParameter(0, $userId)
            ->orderBy('ngay_capnhat', 'DESC')
            ->executeQuery()
            ->fetchAllAssociative();
    }
} 