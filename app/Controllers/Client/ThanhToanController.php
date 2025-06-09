<?php
namespace App\Controllers\Client;
use App\Controller;
use App\Models\Cart;
use App\Models\Product;
use App\Models\Banner;
use App\Models\Cartitem;
use App\Models\Bienthe;
use App\Models\User;
use App\Models\Order;
use App\Models\Orderitem;
use App\Models\Payment;
use App\Models\Productvariant;


class ThanhToanController extends Controller
{
    private Cart $cart;
    private Productvariant $productvariant;
    private Cartitem $cartitem;
    private Product $product;
    private Banner $banner;
    private User $user;
    private Order $order;
    private Orderitem $orderitem;
    private Payment $payment;

    public function __construct()
    {
        $this->cart = new Cart();
        $this->product = new Product();
        $this->banner = new Banner();
        $this->cartitem = new Cartitem();
        $this->productvariant = new Productvariant();
        $this->user = new User();
        $this->order = new Order();
        $this->orderitem = new Orderitem();
        $this->payment = new Payment();
    }
public function index()
{
    if (!isset($_SESSION['user'])) {
        redirect('/login');
        return;
    }

    $userId = $_SESSION['user']['id'];
    $user = $this->user->find($userId);

    // Lấy thông tin giỏ hàng của user
    $cart = $this->cart->where('id_KH', $userId);

    if (!$cart) {
        // 👉 Nếu chưa có giỏ hàng, chuyển hướng về trang giỏ hàng
        redirect('/giohang');
        return;
    }

    // Lấy chi tiết giỏ hàng
    $cartItems = $this->cartitem->getCartItemsByUserId($userId);

    // Nếu giỏ hàng có rồi nhưng không có sản phẩm thì cũng chuyển hướng
    if (empty($cartItems)) {
        redirect('/giohang');
        return;
    }

    // Tính tổng tiền
    $total = 0;
    foreach ($cartItems as $item) {
        $total += $item['tong_gia'];
    }

    $banners = $this->banner->findAll();

    return view('Client.thanhtoan', [
        'cart' => $cart,
        'cartItems' => $cartItems,
        'total' => $total,
        'user' => $user,
        'banners' => $banners
    ]);
}

    public function store()
    {
        if (!isset($_SESSION['user'])) {
            redirect('/login');
            return;
        }

        $userId = $_SESSION['user']['id'];
        
        // Validate dữ liệu đầu vào
        $requiredFields = ['ten', 'dien_thoai', 'dia_chi', 'email', 'phuong_thuc_thanh_toan'];
        foreach ($requiredFields as $field) {
            if (empty($_POST[$field])) {
                $_SESSION['error'] = "Vui lòng điền đầy đủ thông tin";
                redirect('/checkout');
                return;
            }
        }

        // Validate số điện thoại
        if (!preg_match('/^[0-9]{10}$/', $_POST['dien_thoai'])) {
            $_SESSION['error'] = "Số điện thoại không hợp lệ";
            redirect('/checkout');
            return;
        }

        // Validate email
        if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $_SESSION['error'] = "Email không hợp lệ";
            redirect('/checkout');
            return;
        }

        // Lấy thông tin giỏ hàng
        $cart = $this->cart->where('id_KH', $userId);
        if (!$cart) {
            $_SESSION['error'] = "Giỏ hàng trống";
            redirect('/checkout');
            return;
        }

        // Lấy chi tiết giỏ hàng
        $cartItems = $this->cartitem->getCartItemsByUserId($userId);
        if (empty($cartItems)) {
            $_SESSION['error'] = "Giỏ hàng trống";
            redirect('/checkout');
            return;
        }
        
        // Tính tổng tiền
        $total = 0;
        foreach ($cartItems as $item) {
            $total += $item['tong_gia'];
        }

        try {
            // Tạo đơn hàng mới
            $orderId = $this->order->insertGetId([
                'id_KH' => $userId,
                'phien_token' => '', // Có thể sinh token nếu cần
                'ten' => $_POST['ten'],
                'email' => $_POST['email'],
                'dien_thoai' => $_POST['dien_thoai'],
                'id_giohang' => $cart['id'],
                'tong_mathang' => count($cartItems),
                'tong_gia' => $total,
                'dia_chi' => $_POST['dia_chi'],
                'vanchuyen_thanhpho' => 0,
                'trangthai' => 'xử lý',
                'ngay_capnhat' => date('Y-m-d H:i:s')
            ]);

            // Thêm payment
            $this->payment->insert([
                'id_dathang' => $orderId,
                'phuongthuc_thanhtoan' => 'tiền mặt',
                'trangthai_thanhtoan' => 'xử lý',
                'sotien_thanhtoan' => $total,
                'ngay_capnhat' => date('Y-m-d H:i:s')
            ]);

            // Thêm chi tiết đơn hàng
            foreach ($cartItems as $item) {
                if (empty($item['id_bien'])) {
                    throw new \Exception("Sản phẩm {$item['product_name']} không có biến thể (id_bien)!");
                }

                // Kiểm tra số lượng tồn kho
                $productVariant = $this->productvariant->find($item['id_bien']);
                // if ($productVariant['so_luong'] < $item['soluong']) {
                //     throw new \Exception("Sản phẩm {$item['product_name']} chỉ còn {$productVariant['so_luong']} sản phẩm trong kho. Vui lòng giảm số lượng đặt mua!");
                // }

                // Thêm chi tiết đơn hàng
                $this->orderitem->insert([
                    'id_dathang' => $orderId,
                    'id_sanpham' => $item['product_id'],
                    'id_bien' => $item['id_bien'],
                    'soluong' => $item['soluong'],
                    'gia' => $item['gia'],
                    'tong_gia' => $item['tong_gia'],
                    'ngay_capnhat' => date('Y-m-d H:i:s')
                ]);

                // Cập nhật số lượng tồn kho
                $this->productvariant->update($item['id_bien'], [
                    'soluong' => $productVariant['soluong'] - $item['soluong']
                ]);
            }

            // Xóa giỏ hàng
            $this->cartitem->deleteByCartId($cart['id']);
            if (isset($_SESSION['cart'])) unset($_SESSION['cart']);

            $_SESSION['success'] = "Đặt hàng thành công!";
            echo "<script>alert('Đặt hàng thành công!'); setTimeout(function(){ window.location.href = '/'; }, 2000);</script>";
            exit;
        } catch (\Exception $e) {
            $_SESSION['error'] = "Có lỗi xảy ra: " . $e->getMessage();
            redirect('/checkout');
        }
    }

    private function sendOrderConfirmationEmail($email, $orderId, $items, $total)
    {
        $subject = "Xác nhận đơn hàng #" . $orderId;
        
        $message = "Cảm ơn bạn đã đặt hàng!\n\n";
        $message .= "Mã đơn hàng: #" . $orderId . "\n";
        $message .= "Tổng tiền: " . number_format($total) . "đ\n\n";
        $message .= "Chi tiết đơn hàng:\n";
        
        foreach ($items as $item) {
            $message .= "- " . $item['product_name'] . " (Size: " . $item['kich_co'] . ")";
            $message .= " x " . $item['soluong'] . " = " . number_format($item['tong_gia']) . "đ\n";
        }
        
        $headers = "From: your-email@domain.com\r\n";
        $headers .= "Reply-To: your-email@domain.com\r\n";
        $headers .= "X-Mailer: PHP/" . phpversion();
        
        mail($email, $subject, $message, $headers);
    }
}