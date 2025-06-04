<?php
namespace App\Controllers\Client;
use App\Controller;
use App\Models\Cart;
use App\Models\Product;
use App\Models\Banner;
use App\Models\Cartitem;
use App\Models\Bienthe;

class GiohangController extends Controller{
private Cart $cart;
private Bienthe $bienthe;
private Cartitem $cartlitem;
private Product $product;
private Banner $banner;
public function __construct()
{
    $this->cart = new Cart();
    $this->product = new Product();
    $this->banner = new Banner();
    $this->cartlitem = new Cartitem();
    $this->bienthe = new Bienthe(); // Assuming Bienthe is a model for the 'bienthe' table
}
public function index()
{
    $banners = $this->banner->findAll();

    if (!isset($_SESSION['user'])) {
        return redirect('/dangnhap')->with('error', 'Bạn cần đăng nhập để xem giỏ hàng.');
    }

    $id_kh = $_SESSION['user']['id'];
    $giohang = $this->cartlitem->getCartItemsByUserId($id_kh);

    // Tính tổng tiền
    $tong_tien = 0;
    foreach ($giohang as $item) {
        $tong_tien += $item['tong_gia'];
    }

    return view('Client.giohang', compact('banners', 'giohang', 'tong_tien'));
}


public function addToCart()
{
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    $id_kh = $_SESSION['user']['id'] ?? null;
    $variant_id = $_POST['variant_id'] ?? null;
    $so_luong = (int) ($_POST['so_luong'] ?? 1);

    if (!$id_kh || !$variant_id || $so_luong <= 0) {
        echo '<pre>';
        echo "Dữ liệu thiếu:\n";
        print_r([
            'id_kh' => $id_kh,
            'variant_id' => $variant_id,
            'so_luong' => $so_luong,
        ]);
        echo '</pre>';
        exit;
    }
$variant = $this->bienthe->find($variant_id);

if (!$variant || !isset($variant['gia'], $variant['id_sanpham'])) {
    echo "Biến thể không hợp lệ hoặc thiếu id_sanpham"; exit;
}

$gia = $variant['gia'];
$id_sanpham = $variant['id_sanpham'];  // ✅ Lấy đúng key
$tong_gia = $gia * $so_luong;

// Lấy giỏ hàng hiện tại
$cart = $this->cart->where('id_KH', $id_kh);
if (!$cart) {
    $cart_id = $this->cart->insertGetId([
        'id_KH' => $id_kh,
        'id_sanpham' => $id_sanpham, // ✅ đúng key
        'tong_mathang' => 0,
        'tong_gia' => 0,
    ]);
} else {
    $cart_id = $cart['id'];
}

// Kiểm tra sản phẩm + biến thể đã có chưa
$existingItem = $this->cartlitem->findItem($cart_id, $id_sanpham, $variant_id);

if ($existingItem) {
    $new_soluong = $existingItem['soluong'] + $so_luong;
    $new_tonggia = $new_soluong * $gia;

    $this->cartlitem->update($existingItem['id'], [
        'soluong' => $new_soluong,
        'tong_gia' => $new_tonggia,
    ]);
} else {
    $this->cartlitem->insert([
        'id_giohang' => $cart_id,
        'id_sanpham' => $id_sanpham, // ✅ đúng key
        'id_bien' => $variant_id,
        'soluong' => $so_luong,
        'gia' => $gia,
        'tong_gia' => $tong_gia,
    ]);
}

 
    

    // Cập nhật lại tổng số mặt hàng và tổng giá trong giỏ hàng
    $items = $this->cartlitem->where('id_giohang', $cart_id);

    $tong_mathang = 0;
    $tong_gia = 0;
    if ($items && is_array($items)) {
        foreach ($items as $item) {
            $tong_mathang += $item['soluong'];
            $tong_gia += $item['tong_gia'];
        }
    }

    $this->cart->update($cart_id, [
        'tong_mathang' => $tong_mathang,
        'tong_gia' => $tong_gia,
    ]);

    echo "✅ Thêm thành công!";
    exit;
}





}