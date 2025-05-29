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
    $products= $this->product->getLatest(4);
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
    // Lấy ID danh mục từ query string
    $category_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $limit = 2;

    
    $offset = ($page - 1) * $limit;

    // Lấy danh sách sản phẩm theo danh mục
    $products = $this->product->paginateByCategory($category_id, $limit, $offset);
    $totalProduct = $this->product->countByCategory($category_id);
    $totalPage = ceil($totalProduct / $limit);

    // Lấy thông tin danh mục nếu cần
    $category = $this->category->findAll();
    $productss=$this->product->findAll();
    // Truyền ra view
    $banners = $this->banner->findAll();

    return view('Client.danhmuc', compact(
        'products',
        'category',
        'page',
        'totalPage',
        'limit',
        'totalProduct',
        'category_id',
        'banners',
        'productss'
    ));
}





}