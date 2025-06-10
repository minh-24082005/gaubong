<?php
namespace App\Models;
use App\Model;

class Orderitem extends Model
{
    protected $tableName = 'orderitem';

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
            ->fetchAllAssociative();
    }
    public function getByOrderId($orderId)
    {
        return $this->where('id_dathang', $orderId);
    }
    // Lấy item theo id
    public function findItem($id)
    {
        return $this->find($id);
    }
    // Cập nhật item
    public function updateItem($id, $data)
    {
        return $this->update($id, $data);
    }
public function findDetailsByOrderId($orderId)
{
    $sql = "SELECT 
                orderitem.*, 
                product.ten AS ten_sanpham, 
                product.hinhanh AS hinh_sanpham, 
                productvariant.kich_co
            FROM orderitem
            JOIN productvariant ON productvariant.id = orderitem.id_bien
            JOIN product ON product.id = productvariant.id_sanpham
            WHERE orderitem.id_dathang = ?";

    return $this->connection
        ->executeQuery($sql, [$orderId])
        ->fetchAllAssociative();
}


} 