<?php
namespace App\Controllers\Admin;

use App\Controller;
use App\Models\Category;
class CategoryController extends Controller
{
    private Category $category;

    public function __construct()
    {
        $this->category= new Category();
    }

    public function index()
    {
      $categories= $this->category->findAll();
      return view('Admin.category.index',compact('categories'));

    }

    public function create()
    {
        return view('Admin.category.create');
    }
}