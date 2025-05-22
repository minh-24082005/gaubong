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
      return view('Admin.categories.index',compact('categories'));

    }

    public function create()
    {
        return view('Admin.categories.Create');
    }
    public function store()
    {
        $data=[
            'ten'=>$_POST['ten'],
            'mieuta'=>$_POST['mieuta'],
        ];
        $this->category->insert($data);
        return redirect('/admin/categories');
    }
    public function edit($id)
    {
        $category= $this->category->find($id);
        return view('Admin.categories.edit',compact('category'));
    }
    public function update($id)
    {
        $data=[
            'ten'=>$_POST['ten'],
            'mieuta'=>$_POST['mieuta'],
        ];
        $this->category->update($id,$data);
        return redirect('/admin/categories');
    }
    public function delete($id)
    {
        $this->category->delete($id);
        return redirect('/admin/categories');
    }
    public function show($id)
    {
        $category= $this->category->find($id);
        return view('Admin.categories.show',compact('category'));
    }
}