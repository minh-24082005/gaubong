<?php
namespace App\Models;

use App\Model;

class Order extends Model
{
    protected $tableName = 'orders';
    // Lấy tất cả đơn hàng
    public function allOrders()
    {
        return $this->findAll();
    }
    // Lấy đơn hàng theo id
    public function findOrder($id)
    {
        return $this->find($id);
    }
    // Cập nhật đơn hàng
    public function updateOrder($id, $data)
    {
        return $this->update($id, $data);
    }
    // Lấy chi tiết đơn hàng cùng các item
    public function getOrderWithItems($id)
    {
        $order = $this->find($id);
        if ($order) {
            $orderitem = new \App\Models\Orderitem();
            $order['items'] = $orderitem->getByOrderId($id);
        }
        return $order;
    }
}
