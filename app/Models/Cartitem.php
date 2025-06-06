<?php
namespace App\Models;
use App\Model;
class Cartitem extends Model{
    protected $tableName='cartitem';

public function getCartItemsByUserId($userId)
{
    $qb = $this->connection->createQueryBuilder();

    $qb->select('
        cartitem.id,
        cartitem.soluong,
        cartitem.gia,
        cartitem.tong_gia,
        product.id AS product_id,
        product.ten AS product_name,
        product.hinhanh,
        productvariant.kich_co,
        productvariant.id AS id_bien
    ')
    ->from('cartitem')
    ->innerJoin('cartitem', 'cart', 'c', 'cartitem.id_giohang = c.id')
    ->innerJoin('cartitem', 'product', 'product', 'cartitem.id_sanpham = product.id')
    ->innerJoin('cartitem', 'productvariant', 'productvariant', 'cartitem.id_bien = productvariant.id')
    ->where('c.id_KH = :id_KH')
    ->setParameter('id_KH', $userId);

    return $qb->fetchAllAssociative();
}

public function insert(array $data) {
    return $this->connection->insert($this->tableName, $data);
}
public function findItem($id_giohang, $id_sanpham, $id_bien) {
    return $this->connection->createQueryBuilder()
        ->select('*')
        ->from('cartitem')
        ->where('id_giohang = :id_giohang')
        ->andWhere('id_sanpham = :id_sanpham')
        ->andWhere('id_bien = :id_bien')
        ->setParameters([
            'id_giohang' => $id_giohang,
            'id_sanpham' => $id_sanpham,
            'id_bien' => $id_bien
        ])
        ->executeQuery()
        ->fetchAssociative();
}

public function updateQuantity($id_cartitem, $new_quantity)
{
    return $this->connection->update($this->tableName, [
        'soluong' => $new_quantity,
    ], [
        'id' => $id_cartitem
    ]);
}

public function deleteByCartId($cartId) {
    return $this->connection->delete($this->tableName, ['id_giohang' => $cartId]);
}

}