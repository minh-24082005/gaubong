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
    public function allOrders()
    {
        return $this->findAll();
    }
    // Lấy đơn hàng theo id
    public function findOrder($id)
    {
        $order = $this->find($id);
        if ($order) {
            // Đảm bảo key id_KH tồn tại
            $order['id_KH'] = $order['id_KH'] ?? null;
        }
        return $order;
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

    public function cancelOrder($id, $userId)
    {
        // Kiểm tra đơn hàng tồn tại và thuộc về user
        $order = $this->findOrder($id);
        if (!$order || $order['id_khachhang'] != $userId) {
            return false;
        }

        // Kiểm tra trạng thái đơn hàng
        if ($order['trangthai'] !== 'xử lý') {
            return false;
        }

        // Cập nhật trạng thái đơn hàng
        $data = [
            'trangthai' => 'đã hủy',
            'ngay_capnhat' => date('Y-m-d H:i:s')
        ];

        return $this->updateOrder($id, $data);
    }
    public function findByUserId($userId)
{
    return $this->connection->createQueryBuilder()
        ->select('*')
        ->from($this->tableName)
        ->where('id_KH = ?')
        ->setParameter(0, $userId)
        ->orderBy('ngay_caphat', 'DESC')
        ->executeQuery()
        ->fetchAllAssociative();
}

} 