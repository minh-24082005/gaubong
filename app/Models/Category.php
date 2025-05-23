<?php
namespace App\Models;

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



}