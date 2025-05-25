<?php
namespace App\Controllers\Client;

use App\Controller;
use App\Models\Banner;
use App\Models\Product;


class HomeController extends Controller
{
    private Product $product;
    private Banner $banner;
    public function __construct()
    {
        $this->banner = new Banner();
        $this->product = new Product();
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






}