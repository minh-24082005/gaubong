<?php
namespace App\Models;

use App\Model; // lớp cha Model chứa kết nối Doctrine\DBAL

class Thongke extends Model
{
    // Thống kê tồn kho sản phẩm theo biến thể (kích cỡ)
    public function tonKhoSanPham()
    {
$sql = "
    SELECT 
        p.id AS ma_san_pham,
        p.ten AS ten_san_pham,
        pv.id AS ma_bien_the,
        pv.kich_co AS kich_co,
        pv.kich_co,
        pv.gia,
        IFNULL(SUM(oi.soluong), 0) AS so_luong_ban,
        IFNULL(SUM(oi.tong_gia), 0) AS doanh_thu
    FROM product p
    LEFT JOIN productvariant pv ON pv.id_sanpham = p.id
    LEFT JOIN orderitem oi ON oi.id_bien = pv.id
    LEFT JOIN orders o ON o.id = oi.id_dathang
    GROUP BY p.id, p.ten, pv.id, pv.kich_co, pv.gia
    ORDER BY p.id ASC
";


        return $this->connection->fetchAllAssociative($sql);
    }
}
