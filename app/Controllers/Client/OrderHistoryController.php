<?php
namespace App\Controllers\Client;
use App\Controller;
use App\Models\Order;
use App\Models\Orderitem;
use App\Models\Banner;
class OrderHistoryController extends Controller
{
    private Order $order;
    private Orderitem $orderitem;
    private Banner $banner;

    public function __construct()
    {

        $this->order = new Order();
        $this->orderitem = new Orderitem();
        $this->banner = new Banner();

    }
public function index()
{
    if (!isset($_SESSION['user'])) {
        redirect('/login');
        return;
    }

    $userId = $_SESSION['user']['id'];
    $orders = $this->order->findAllByUser($userId); // lấy tất cả đơn của user

    foreach ($orders as &$order) {
       $order['items'] = $this->orderitem->findDetailsByOrderId($order['id']);
 // gắn từng item vào đơn
    }

    $banners = $this->banner->findAll();
    return view('Client.order_history', compact('orders', 'banners'));
}

    
    public function cancelOrder($id)
    {
        if (!isset($_SESSION['user'])) {
            $_SESSION['error'] = 'Vui lòng đăng nhập để thực hiện chức năng này';
            redirect('/login');
            return;
        }

        $userId = $_SESSION['user']['id'];
        
        try {
            // Sử dụng phương thức cancelOrder từ model Order
            $result = $this->order->cancelOrder($id, $userId);
            
            if ($result) {
                $_SESSION['success'] = 'Hủy đơn hàng thành công';
            } else {
                $_SESSION['error'] = 'Không thể hủy đơn hàng. Vui lòng kiểm tra lại trạng thái đơn hàng.';
            }
            $data = [
                'trangthai' => 'đã hủy',
                'ngay_capnhat' => date('Y-m-d H:i:s')
            ];
            $this->order->updateOrder($id, $data);
        } catch (\Exception $e) {
            $_SESSION['error'] = 'Có lỗi xảy ra: ' . $e->getMessage();
        }
        
        redirect('/lich-su-don-hang');
    }
}