<?php
namespace App\Models;
use App\Model;
class Cart extends Model{
    protected $tableName='cart';
public function where($column, $value) {
    return $this->connection->createQueryBuilder()
        ->select('*')
        ->from($this->tableName)
        ->where("$column = ?")
        ->setParameter(0, $value)
        ->executeQuery()
        ->fetchAssociative(); // => CHỈ LẤY 1 DÒNG
}


public function insertGetId(array $data) {
    $this->connection->insert($this->tableName, $data);
    return $this->connection->lastInsertId();
}

public function update($id, array $data) {
    return $this->connection->update($this->tableName, $data, ['id' => $id]);
}



}