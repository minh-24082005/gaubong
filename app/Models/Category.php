<?php
namespace App\Models;
use Doctrine\DBAL\ParameterType;
use App\Model;

class Category extends Model{
    protected $tableName='category';
    public function getCategoryOnlyActive(){
        $querybuilder=$this->connection->createQueryBuilder();
        $querybuilder
        ->select('*')
        ->from($this->tableName);
        return $querybuilder->fetchAllAssociative();
    }


public function find($id)
{
    $sql = "SELECT * FROM category WHERE id = :id";
    $result = $this->connection->executeQuery($sql, [
        'id' => $id
    ], [
        'id' => ParameterType::INTEGER
    ]);

    return $result->fetchAssociative();
}




}