<?php

namespace App\Controllers;

use App\Models\ProductModel;

class Home extends BaseController
{
    public function index()
    {
        $productModel = new ProductModel();
        
        $data = [
            'title'          => 'Dashboard Utama',
            'total_products' => $productModel->countAllResults(),
            'total_stok'     => $productModel->selectSum('stok')->first()['stok'] ?? 0,
        ];

        return view('home', $data);
    }
}