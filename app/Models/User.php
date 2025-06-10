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

    public function hasRelatedData($userId)
    {
        // Kiểm tra trong bảng cart
        $cartCount = $this->connection->createQueryBuilder()
            ->select('COUNT(*)')
            ->from('cart')
            ->where('id_KH = ?')
            ->setParameter(0, $userId)
            ->executeQuery()
            ->fetchOne();

        // Kiểm tra trong bảng orders
        $orderCount = $this->connection->createQueryBuilder()
            ->select('COUNT(*)')
            ->from('orders')
            ->where('id_khachhang = ?')
            ->setParameter(0, $userId)
            ->executeQuery()
            ->fetchOne();

        // Nếu có dữ liệu trong bất kỳ bảng nào
        return ($cartCount > 0 || $orderCount > 0);
    }

    public function deleteRelatedData($userId)
    {
        // Xóa dữ liệu trong bảng cart
        $this->connection->createQueryBuilder()
            ->delete('cart')
            ->where('id_KH = ?')
            ->setParameter(0, $userId)
            ->executeQuery();

        // Xóa dữ liệu trong bảng orders
        $this->connection->createQueryBuilder()
            ->delete('orders')
            ->where('id_khachhang = ?')
            ->setParameter(0, $userId)
            ->executeQuery();
    }

    public function delete($id)
    {
        try {
            // Bắt đầu transaction
            $this->connection->beginTransaction();

            // Xóa dữ liệu liên quan
            $this->deleteRelatedData($id);

            // Xóa người dùng
            $result = parent::delete($id);

            // Commit transaction
            $this->connection->commit();

            return $result;
        } catch (\Exception $e) {
            // Rollback nếu có lỗi
            $this->connection->rollBack();
            throw $e;
        }
    }
}