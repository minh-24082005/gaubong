<?php

namespace App\Models;

use App\Model;

class User extends Model{
    protected $tableName='users';

        public function checkExistsEmailForCreate($email){
        $queryBuilder=$this->connection->createQueryBuilder();
        $queryBuilder->select('COUNT(*)')
        ->from($this->tableName)
        ->where('email=:email')
        ->setParameter('email',$email);
        $result=$queryBuilder->fetchOne();
        return $result>0;
    }
    public function  checkExistsEmailForUpdate($id,$email){
        $querybuilder=$this->connection->createQueryBuilder();
        $querybuilder->select('COUNT(*)')
        ->from($this->tableName)
        ->where('email=:email')
        ->andWhere('id !=:id')
        ->setParameter('email',$email)
        ->setParameter('id',$id);
        $result=$querybuilder->fetchOne();
        return $result>0;
    }
        public function getUserByEmail($email){
        $queryBuilder=$this->connection->createQueryBuilder();
        $queryBuilder->select('*')
        ->from($this->tableName)
        ->where('email=:email')
        ->setParameter('email',$email);
        $result=$queryBuilder->fetchAssociative();
        return $result;
    }
}