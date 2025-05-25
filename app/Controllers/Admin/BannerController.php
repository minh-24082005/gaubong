<?php
namespace App\Controllers\Admin;
use App\Controller;
use App\Models\Banner;          
class BannerController extends Controller
{
    private Banner $bannerModel;

    public function __construct()
    {
        $this->bannerModel = new Banner();
    }

    public function index()
    {
        $banners = $this->bannerModel->findAll();
        return view('Admin.banner.index', compact('banners'));
    }
public function create()
    {
        return view('Admin.banner.create');
    }
    public function store()
    {
        $data = [
           
        ];
        if(isset($_FILES['anh']) && $_FILES['anh']['error'] === UPLOAD_ERR_OK) {
            $data['anh'] = $this->uploadFile($_FILES['anh'], 'banner');
        } else {
            $data['anh'] = null;
        }
        $this->bannerModel->insert($data);
        return redirect('/admin/banner');
    }
    // public function edit($id)
    // {
    //     $banner = $this->bannerModel->find($id);
    //     return view('Admin.banner.edit', compact('banner'));
    // }
    // public function update($id)
    // {
    //     $data = [
    //         'image' => $_POST['image'],
    //         'link' => $_POST['link'],
    //     ];
    //     $this->bannerModel->update($id, $data);
    //     return redirect('/admin/banner');
    // }
    public function delete($id)
    {
        $this->bannerModel->delete($id);
        return redirect('/admin/banner');
    }
    // public function show($id)
    // {
    //     $banner = $this->bannerModel->find($id);
    //     return view('Admin.banner.show', compact('banner'));
    // }



}