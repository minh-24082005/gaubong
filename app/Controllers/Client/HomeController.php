<?php
namespace App\Controllers\Client;


class HomeController
{
    public function index()
    {
     return view('Admin.layout.sidebar');
    }
}