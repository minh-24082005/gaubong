<?php
namespace App\Controllers\Client;

use App\Controller;
use App\Models\Banner;
use App\Models\Product;
use App\Models\Category;



class HomeController extends Controller
{
    private Product $product;
    private Banner $banner;
    private Category $category; // Assuming you have a Category model
    public function __construct()
    {
        $this->banner = new Banner();
        $this->product = new Product();
        $this->category = new Category(); // Assuming you have a Category model
    }
    public function index()
    {
        $products = $this->product->getLatest(4);
        $page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
        $limit = 8;
        $keyword = isset($_GET['keyword']) ? $_GET['keyword'] : '';

        $result = $this->product->paginateClien($page, $limit, $keyword, 'ASC'); // chắc chắn gọi paginateClien
        $productss = $result['data'];
        $totalPage = $result['totalPage'];

        $banners = $this->banner->findAll();

        return view('Client.home', compact('products', 'banners', 'productss', 'page', 'limit', 'totalPage', 'keyword'));
    }


public function danhmuc()
{
    $category_id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
    $page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
    $limit = 8;
// tìm kiếm
    $sort = isset($_GET['sort']) ? $_GET['sort'] : 'asc';
    $keyword = isset($_GET['keyword']) ? trim($_GET['keyword']) : '';

    // Lấy sản phẩm theo tất cả điều kiện
    // lọc
    $result = $this->product->paginateClientFull($page, $limit, $category_id, $keyword, $sort);

    $products = $result['data'];
    $totalPage = $result['totalPage'];

    $category = $this->category->findAll();
    $banners = $this->banner->findAll();

    return view('Client.danhmuc', compact(
        'products',
        'category',
        'banners',
        'category_id',
        'keyword',
        'sort',
        'page',
        'totalPage'
    ));
}






}