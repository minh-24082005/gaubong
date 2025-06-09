<?php
namespace App\Models;

use App\Model;

class Orderitem extends Model
{
    protected $tableName = 'orderitem';
    // Lấy các item theo id đơn hàng
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
}
