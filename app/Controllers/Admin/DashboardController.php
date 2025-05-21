<?php
namespace App\Controllers\Admin;

class DashboardController
{
    public function index()
    {
        return view('Admin.layout.sidebar');
    }
}