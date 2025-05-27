<?php
namespace App\Models;
use App\Model;
class Bienthe extends Model{
    protected $tableName='productvariant';
    
public function bientheAll($page = 1, $limit = 10)
{
    $offset = ($page - 1) * $limit;

    $qb = $this->connection->createQueryBuilder()
        ->select(
            'b.id b_id',
            'b.kich_co b_kich_co',
            'p.ten p_ten',
            'b.gia b_gia',
            'b.soluong b_soluong'
        )
        ->from($this->tableName, 'b')
        ->innerJoin('b', 'product', 'p', 'p.id = b.id_sanpham')
        ->setFirstResult($offset)
        ->setMaxResults($limit)
        ->orderBy('b.id', 'DESC');

    $data = $qb->fetchAllAssociative();

    // Đếm đúng số biến thể
    $countQb = $this->connection->createQueryBuilder()
        ->select('COUNT(DISTINCT b.id)')
        ->from($this->tableName, 'b')
        ->innerJoin('b', 'product', 'p', 'p.id = b.id_sanpham');

    $total = $countQb->fetchOne();
    $totalPage = ceil($total / $limit);

    return [
        'data' => $data,
        'page' => $page,
        'limit' => $limit,
        'totalPage' => $totalPage
    ];
}


public function find($id)
{
    $queryBuilder = $this->connection->createQueryBuilder();
    $queryBuilder->select('*')
        ->from($this->tableName)
        ->where('id = :id')
        ->setParameter('id', $id);
    
    return $queryBuilder->fetchAssociative();
}

// App\Models\Bienthe.php
public function getByProductId($productId)
{
    $qb = $this->connection->createQueryBuilder();
    $qb->select('id', 'kich_co', 'gia', 'soluong')
        ->from($this->tableName)
        ->where('id_sanpham = :id_sanpham')
        ->setParameter('id_sanpham', $productId);

    return $qb->fetchAllAssociative();
}



}