<?php
namespace App\Controllers\Admin;

use App\Controller;
use App\Models\Order;
use App\Models\Orderitem;

class OrderController extends Controller
{
    private Order $order;
    private Orderitem $orderitem;

    public function __construct()
    {
        $this->order = new Order();
        $this->orderitem = new Orderitem();
    }

    // Hiển thị danh sách đơn hàng
    public function index()
    {
        $orders = $this->order->findAll('id DESC');
        $orderitems = $this->orderitem->findAll();
        $totalPage = ceil(count($orders) / 10);
        $page = $_GET['page'] ?? 1;
        $offset = ($page - 1) * 10;
        $orders = array_slice($orders, $offset, 10);
        return view('Admin.orders.index', compact('orders', 'orderitems', 'totalPage', 'page'));
    }

    // Xem chi tiết đơn hàng
    public function show($id)
    {
        $order = $this->order->getOrderWithItems($id);
        return view('Admin.orders.show', compact('order'));
    }

    // Chỉnh sửa đơn hàng (hiển thị form)
    public function edit($id)
    {
        $order = $this->order->getOrderWithItems($id);
        return view('Admin.orders.edit', compact('order'));
    }

    // Xử lý cập nhật đơn hàng
    public function update($id)
    {
        $data = [
            'ten' => $_POST['ten'] ?? null,
            'email' => $_POST['email'] ?? null,
            'dien_thoai' => $_POST['dien_thoai'] ?? null,
            'dia_chi' => $_POST['dia_chi'] ?? null,
            'tong_gia' => $_POST['tong_gia'] ?? null,
            'trangthai' => $_POST['trangthai'] ?? null,
            'ngay_capnhat' => date('Y-m-d H:i:s'),
        ];
        $this->order->updateOrder($id, $data);
        $_SESSION['msg'] = 'Cập nhật đơn hàng thành công!';
        return redirect('/admin/orders');
    }
}
