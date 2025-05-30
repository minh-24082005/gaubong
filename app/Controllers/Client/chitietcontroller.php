<?php
namespace App\Controllers\Client;
use App\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\Banner;
use App\Models\Bienthe; // Assuming Bienthe is a model for the 'bienthe' table

class ChitietController extends Controller
{
    private Product $product;
    private Banner $banner;
    private Category $category;
    private Bienthe $bienthe;

    public function __construct()
    {
        $this->product = new Product();
        $this->category = new Category();
        $this->banner = new Banner();
        $this->bienthe = new Bienthe(); // Initialize Bienthe model
        
    }

public function index($id)
{
    if (!$id || !is_numeric($id)) {
        return redirect('/'); // hoặc hiển thị lỗi 404
    }

    $product = $this->product->find($id);
    if (!$product) {
        return redirect('/'); // hoặc hiển thị lỗi 404
    }

    $categories = $this->category->getCategoryOnlyActive();
    $bienthes = $this->bienthe->bientheAll();
    $variants = $this->bienthe->getByProductId($id);
    $relatedProducts = $this->product->sp_dm($id, $product['p_id_danhmuc']);
    $banners = $this->banner->findAll();

    return view('Client.chitiet', compact(
        'product',
        'categories',
        'banners',
        'bienthes',
        'variants',
        'relatedProducts'
    ));
}



}