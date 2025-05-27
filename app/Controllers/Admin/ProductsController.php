<?php
namespace App\Controllers\Admin;
use App\Controller;
use App\Models\Product;
use App\Models\Category;
class ProductsController extends Controller
{
    private Product $product;
    private Category $category;

    public function __construct()
    {
        $this->product = new Product();
        $this->category = new Category();
    }

    public function index()
    {
        $page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
        $limit = 5;
        $keyword = isset($_GET['keyword']) ? $_GET['keyword'] : '';

        $result = $this->product->paginate($page, $limit, $keyword);
        $products = $result['data'];

        $totalPage = $result['totalPage'];

        return view('Admin.products.index', compact('products', 'page', 'limit', 'result', 'totalPage', 'keyword'));
    }
    public function create()
    {

        $categories = $this->category->getCategoryOnlyActive();
        return view('Admin.products.create', compact('categories'));


    }
    public function store()
    {
        $data = [
            'ten' => $_POST['ten'],
            'gia_coso' => $_POST['gia_coso'],
            'hangcosan' => $_POST['hangcosan'],
            'trang_thai' => $_POST['trang_thai'],
            'ma_hang' => $_POST['ma_hang'],
            'mota' => $_POST['mota'],
            'id_danhmuc' => $_POST['id_danhmuc']
        ];


        if (isset($_FILES['hinhanh']) && $_FILES['hinhanh']['error'] === UPLOAD_ERR_OK) {
            $data['hinhanh'] = $this->uploadFile($_FILES['hinhanh'], 'product');
        } else {
            $data['hinhanh'] = null;
        }

        $this->product->insert($data);
        return redirect('/admin/product');
    }
    public function edit($id)
    {
        $product = $this->product->find($id);
        $categories = $this->category->getCategoryOnlyActive();
        return view('admin.products.edit', compact('product', 'categories'));


    }
public function update($id)
{
    $data = [
        'ten' => $_POST['ten'],
        'gia_coso' => $_POST['gia_coso'],
        'hangcosan' => $_POST['hangcosan'],
        'trang_thai' => isset($_POST['trang_thai']) ? $_POST['trang_thai'] : 'hết',
        'ma_hang' => $_POST['ma_hang'],
        'mota' => $_POST['mota'],
        'id_danhmuc' => $_POST['id_danhmuc']
    ];

    if (isset($_FILES['hinhanh']) && $_FILES['hinhanh']['error'] === UPLOAD_ERR_OK) {
        // Có ảnh mới => upload
        $data['hinhanh'] = $this->uploadFile($_FILES['hinhanh'], 'product');
    } else {
        // Không upload ảnh mới => giữ ảnh cũ
        $data['hinhanh'] = $_POST['old_hinhanh'] ?? null;
    }

    $this->product->update($id, $data);
    return redirect('/admin/product');
}

    public function delete($id)
    {
        $this->product->delete($id);
        return redirect('/admin/product');
    }
    public function show($id)
    {
        
        $product = $this->product->find($id);
        return view('Admin.products.show', compact('product'));
    }

}
