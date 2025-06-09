<?php

namespace App\Models;

use Doctrine\DBAL\ParameterType;

use App\Model;

class Product extends Model
{
    protected $tableName = 'product';
    public function paginate($page = 1, $limit = 10, $keyword = '', $category_id = 0)
    {
        $offset = ($page - 1) * $limit;
        $params = [];

        $qb = $this->connection->createQueryBuilder()
            ->select(
                'p.id p_id',
                'p.ten p_ten',
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

        // Điều kiện lọc
        if ($keyword !== '') {
            $qb->andWhere('p.ten LIKE :keyword');
            $params['keyword'] = "%$keyword%";
        }

        if ($category_id > 0) {
            $qb->andWhere('p.id_danhmuc = :category_id');
            $params['category_id'] = $category_id;
        }

        $qb->orderBy('p.id', 'DESC')
            ->setFirstResult($offset)
            ->setMaxResults($limit)
            ->setParameters($params);

        $data = $qb->fetchAllAssociative();

        // Query đếm tổng số sản phẩm có lọc
        $countQb = $this->connection->createQueryBuilder()
            ->select('COUNT(*)')
            ->from($this->tableName, 'p');

        if ($keyword !== '') {
            $countQb->andWhere('p.ten LIKE :keyword');
            $countQb->setParameter('keyword', "%$keyword%");
        }

        if ($category_id > 0) {
            $countQb->andWhere('p.id_danhmuc = :category_id');
            $countQb->setParameter('category_id', $category_id);
        }

        $totalPage = ceil($countQb->fetchOne() / $limit);

        return [
            'data' => $data,
            'page' => $page,
            'limit' => $limit,
            'totalPage' => $totalPage
        ];
    }

    public function find($id)
    {
        $querybuilder = $this->connection->createQueryBuilder();
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
            ->from($this->tableName, 'p')
            ->innerJoin('p', 'category', 'c', 'c.id=p.id_danhmuc')
            ->where('p.id=:id')
            ->setParameter('id', $id);
        return $querybuilder->fetchAssociative();
    }
    //////////////////// clien
    public function getLatest($limit = 6)
    {
        $queryBuilder = $this->connection->createQueryBuilder();
        return $queryBuilder
            ->select('*')
            ->from($this->tableName)
            ->orderBy('created_at', 'DESC')  // đảm bảo bảng có cột `created_at`
            ->setMaxResults($limit)
            ->fetchAllAssociative();
    }
    public function getOldest($limit = 2)
    {
        $queryBuilder = $this->connection->createQueryBuilder();
        return $queryBuilder
            ->select('*')
            ->from($this->tableName)
            ->orderBy('created_at', 'ASC')  // đảm bảo bảng có cột `created_at`
            ->setMaxResults($limit)
            ->fetchAllAssociative();
    }
    public function paginateClien($page = 1, $limit = 10, $keyword = '', $order = 'DESC')
    {
        $offset = ($page - 1) * $limit;
        $params = [];

        $qb = $this->connection->createQueryBuilder()
            ->select(
                'p.id p_id',
                'p.ten p_ten',
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

        $qb->orderBy('p.id', $order)
            ->setFirstResult($offset)
            ->setMaxResults($limit)
            ->setParameters($params);

        $data = $qb->fetchAllAssociative();

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
    //////////////////////////////////////

    public function getProductOnlyActive()
    {
        $querybuilder = $this->connection->createQueryBuilder();
        $querybuilder
            ->select('*')
            ->from($this->tableName);
        return $querybuilder->fetchAllAssociative();
    }

   public function chitiet_bienthe($id)
{
    $querybuilder = $this->connection->createQueryBuilder();

    $querybuilder
        ->select(
            'p.id p_id',
            'p.id_danhmuc p_id_danhmuc',
            'p.ten p_ten',
            'c.ten c_ten',
            'p.gia_coso p_gia_coso',
            'p.hangcosan p_hangcosan',
            'p.trang_thai p_trang_thai',
            'p.hinhanh p_hinhanh',
            'p.ma_hang p_ma_hang',
            'p.mota p_mota',
            'p.created_at p_created_at',
            'p.updated_at p_updated_at',
            'b.id b_id',
            'b.kich_co b_kich_co',
            'b.gia b_gia',
            'b.soluong b_soluong'
        )
        ->from($this->tableName, 'p')
        ->innerJoin('p', 'category', 'c', 'c.id = p.id_danhmuc')
        ->innerJoin('p', 'productvariant', 'b', 'b.id_sanpham = p.id') // ✅ Thêm join bảng productvariant
        ->where('b.id = :id') // ✅ Sửa lại điều kiện tìm theo ID biến thể
        ->setParameter('id', $id);

    return $querybuilder->fetchAssociative();
}


    //// lọc sp danh mục


    public function paginateByCategory($id_danhmuc, $limit, $offset)
    {
        $sql = "SELECT * FROM product WHERE id_danhmuc = :id_danhmuc LIMIT :limit OFFSET :offset";
        $result = $this->connection->executeQuery($sql, [
            'id_danhmuc' => $id_danhmuc,
            'limit' => $limit,
            'offset' => $offset,
        ], [
            'id_danhmuc' => ParameterType::INTEGER,
            'limit' => ParameterType::INTEGER,
            'offset' => ParameterType::INTEGER,
        ]);

        return $result->fetchAllAssociative();
    }


    public function countByCategory($id_danhmuc)
    {
        $sql = "SELECT COUNT(*) as total FROM product WHERE id_danhmuc = :id_danhmuc";
        $result = $this->connection->executeQuery($sql, [
            'id_danhmuc' => $id_danhmuc
        ], [
            'id_danhmuc' => \Doctrine\DBAL\ParameterType::INTEGER
        ]);

        return $result->fetchAssociative()['total'];
    }
    public function sp_dm($product_id, $category_id, $limit = 5)
    {
        $qb = $this->connection->createQueryBuilder();

        return $qb->select(
            'p.id p_id',
            'p.ten p_ten',
            'p.gia_coso p_gia_coso',
            'p.hinhanh p_hinhanh'
        )
            ->from($this->tableName, 'p')
            ->where('p.id_danhmuc = :id_danhmuc')
            ->andWhere('p.id != :id_sanpham')
            ->orderBy('p.created_at', 'DESC')
            ->setMaxResults($limit)
            ->setParameters([
                'id_danhmuc' => $category_id,
                'id_sanpham' => $product_id
            ])
            ->fetchAllAssociative();
    }

    public function paginateClientFull($page = 1, $limit = 8, $category_id = 0, $keyword = '', $sort = 'asc')
    {
        $offset = ($page - 1) * $limit;
        $where = [];
        $params = [];

        if ($category_id > 0) {
            $where[] = 'p.id_danhmuc = :cat';
            $params['cat'] = $category_id;
        }
        if ($keyword !== '') {
            $where[] = 'p.ten LIKE :kw';
            $params['kw'] = "%$keyword%";
        }

        $sqlWhere = $where ? implode(' AND ', $where) : '1=1';
        $order = strtolower($sort) === 'desc' ? 'DESC' : 'ASC';

        $qb = $this->connection->createQueryBuilder()
            ->select('p.*')
            ->from($this->tableName, 'p')
            ->where($sqlWhere)
            ->setFirstResult($offset)
            ->setMaxResults($limit)
            ->orderBy('p.gia_coso', $order);
        foreach ($params as $k => $v) $qb->setParameter($k, $v);
        $data = $qb->fetchAllAssociative();

        $count = $this->connection->createQueryBuilder()
            ->select('COUNT(*)')
            ->from($this->tableName, 'p')
            ->where($sqlWhere);
        foreach ($params as $k => $v) $count->setParameter($k, $v);
        $total = (int) $count->fetchOne();

        return ['data' => $data, 'totalPage' => ceil($total / $limit)];
    }
}
