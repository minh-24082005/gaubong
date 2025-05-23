<?php 
namespace App\Models;

use App\Model;
 class Product extends Model{
    protected $tableName='product';
public function paginate($page = 1, $limit = 10, $keyword = '')
{
    $offset = ($page - 1) * $limit;
    $params = [];

    // Query danh sách sản phẩm
    $qb = $this->connection->createQueryBuilder()
        ->select(
            'p.id p_id', 'p.ten p_ten',
            'c.ten c_ten',
            'p.hinhanh p_hinhanh',
            'p.gia_coso p_gia_coso',
            'p.hangcosan p_hangcosan',
            'p.trang_thai p_trang_thai',
            'p.ma_hang p_ma_hang', 
            'p.mota p_mota',
            'p.created_at p_created_at', 
            'p.updated_at p_update_at'
        )
        ->from($this->tableName, 'p')
        ->innerJoin('p', 'category', 'c', 'c.id = p.id_danhmuc');

    if ($keyword !== '') {
        $qb->where('p.ten LIKE :keyword');
        $params['keyword'] = "%$keyword%";
    }

    $qb->orderBy('p.id', 'DESC')
       ->setFirstResult($offset)
       ->setMaxResults($limit)
       ->setParameters($params);

    $data = $qb->fetchAllAssociative();

    // Query tổng số sản phẩm
    $countQb = $this->connection->createQueryBuilder()
        ->select('COUNT(*)')
        ->from($this->tableName, 'p');

    if ($keyword !== '') {
        $countQb->where('p.ten LIKE :keyword');
        $countQb->setParameter('keyword', "%$keyword%");
    }

    $totalPage = ceil($countQb->fetchOne() / $limit);

    return [
        'data' => $data,
        'page' => $page,
        'limit' => $limit,
        'totalPage' => $totalPage
    ];
}

    public function find($id){
        $querybuilder=$this->connection->createQueryBuilder();
        $querybuilder
        ->select(
            'p.id p_id',
            'p.id_danhmuc  p_id_danhmuc',
            'p.ten p_ten',
            'c.ten c_ten',
            'p.gia_coso p_gia_coso',
            'p.hangcosan p_hangcosan',
            'p.trang_thai p_trang_thai',
            'p.hinhanh p_hinhanh',
            'p.ma_hang p_ma_hang',
            'p.mota p_mota',
            'p.created_at p_created_at',
            'p.updated_at p_update_at',
        )
        ->from($this->tableName,'p')
        ->innerJoin('p', 'category', 'c', 'c.id=p.id_danhmuc')
        ->where('p.id=:id')
        ->setParameter('id',$id);
        return $querybuilder->fetchAssociative();
    }

 }