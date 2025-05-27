<?php
namespace App\Controllers\Admin;
use App\Controller;
use App\Models\Bienthe;
use App\Models\Product;
class BientheController extends Controller
{
    private Product $product;
    private Bienthe $bienthe;

    public function __construct()
    {
        $this->product = new Product();
        $this->bienthe = new Bienthe();
    }

    public function index()
{
    $page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
    $limit = 5;

    $result = $this->bienthe->bientheAll($page, $limit);
    $bienthes = $result['data'];

    return view('Admin.bienthe.index', compact('bienthes', 'page', 'limit', 'result'));
}

    public function create()
    {
        $products = $this->product->getProductOnlyActive();
        return view('Admin.bienthe.create',compact('products'));
    }
    public function store()
    {
        $data = [
            'kich_co' => $_POST['kich_co'],
            'id_sanpham' => $_POST['id_sanpham'],
            'gia' => $_POST['gia'],
            'soluong' => $_POST['soluong'],

        ];
        

        
        $this->bienthe->insert($data);
        return redirect('/admin/bienthe');
    }
}