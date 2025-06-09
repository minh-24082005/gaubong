<?php
namespace App\Controllers\Admin;

use App\Controller;
use App\Models\Thongke;

class ThongkeController extends Controller
{
    public function index()
    {
        $thongkeModel = new Thongke();
        $data = $thongkeModel->tonKhoSanPham();

        return view('Admin.thongke.index', [
            'data' => $data
        ]);
    }
}
