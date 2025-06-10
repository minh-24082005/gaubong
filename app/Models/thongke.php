<?php
namespace App\Models;

use App\Model; // Model cha chứa Doctrine\DBAL Connection

class Thongke extends Model
{
    // Thống kê sản phẩm đã giao theo biến thể
    public function sanPhamDaGiao()
    {
        $sql = "
            SELECT 
                p.id AS ma_san_pham,
                p.ten AS ten_san_pham,
                pv.id AS ma_bien_the,
                pv.kich_co,
                pv.gia,
                SUM(oi.soluong) AS so_luong_da_giao,
                SUM(oi.tong_gia) AS tong_doanh_thu
            FROM product p
            JOIN productvariant pv ON pv.id_sanpham = p.id
            JOIN orderitem oi ON oi.id_bien = pv.id
            JOIN orders o ON o.id = oi.id_dathang
            WHERE o.trangthai = 'đã giao'
            GROUP BY p.id, p.ten, pv.id, pv.kich_co, pv.gia
            ORDER BY p.id ASC
        ";

        return $this->connection->fetchAllAssociative($sql);
    }
}
