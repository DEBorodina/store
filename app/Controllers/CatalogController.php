<?php

namespace App\Controllers;

use App\Models\Product;

class CatalogController
{
    public function index()
    {
        render('catalog.php');
    }
    public function showProduct()
    {
        $allProducts = Product::selectAll();
        $product = Product::findById($_GET['id']);
        render('product.php',[
            'product'=>$product,
            'productsList'=>$allProducts,
        ]);
    }
}