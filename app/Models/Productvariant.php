<?php

namespace App\Models;

use Doctrine\DBAL\ParameterType;

use App\Model;

class Productvariant extends Model
{
    protected $tableName = 'productvariant';
    public function find($id)
    {
        $sql = "SELECT * FROM productvariant WHERE id = :id";
        $result = $this->connection->executeQuery($sql, [
            'id' => $id
        ], [
            'id' => ParameterType::INTEGER
        ]);

        return $result->fetchAssociative();
    }

    public function update($id, array $data)
    {
        return $this->connection->update($this->tableName, $data, ['id' => $id]);
    }

    public function insert(array $data)
    {
        return $this->connection->insert($this->tableName, $data);
    }

    public function delete($id)
    {
        return $this->connection->delete($this->tableName, ['id' => $id]);
    }

    public function getProductVariantsByProductId($productId)
    {
        $sql = "SELECT * FROM productvariant WHERE id_sanpham = :productId";
        $result = $this->connection->executeQuery($sql, [
            'productId' => $productId
        ], [
            'productId' => ParameterType::INTEGER
            
        ]);

        return $result->fetchAllAssociative();
    }
}
