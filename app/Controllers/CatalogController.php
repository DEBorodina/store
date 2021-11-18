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
        $product = Product::findById($_GET['id']);
        print_r($product);
        render('product.php');
    }
}