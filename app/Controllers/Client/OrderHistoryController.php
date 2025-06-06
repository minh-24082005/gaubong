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
} 