<?php
namespace App\Controllers\Client;
use App\Controller;
use App\Models\Order;
use App\Models\Orderitem;

class OrderHistoryController extends Controller
{
    private Order $order;
    private Orderitem $orderitem;

    public function __construct()
    {
        $this->order = new Order();
        $this->orderitem = new Orderitem();
    }

    public function index()
    {
        if (!isset($_SESSION['user'])) {
            redirect('/login');
            return;
        }
        $userId = $_SESSION['user']['id'];
        // Lấy tất cả đơn hàng của user
        $orders = $this->order->findAllByUser($userId);
        // Lấy chi tiết từng đơn hàng
        foreach ($orders as &$order) {
            $order['items'] = $this->orderitem->findByOrderId($order['id']);
        }
        return view('Client.order_history', ['orders' => $orders]);
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