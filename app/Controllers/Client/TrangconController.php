<?php
namespace App\Controllers\Client;

use App\Controller;
use App\Models\Banner;

class TrangconController extends Controller{
private Banner $banner;

 public function __construct() {
     $this->banner = new Banner();
}

    public function about(){
        $banners = $this->banner->findAll();
        return view('Client.trangcon.about',compact('banners'));
    }
}