<?php

namespace App\Controllers\Admin;


use App\Controller;
use App\Models\Thongke;

class ThongkeController extends Controller
{
    public function index()
    {
        $thongkeModel = new Thongke();
        $sanPhamDaGiao = $thongkeModel->sanPhamDaGiao();

        return view('Admin.thongke.index', compact('sanPhamDaGiao'));
    }
}
