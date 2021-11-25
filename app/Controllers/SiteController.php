<?php

namespace App\Controllers;
use App\Models\Product;
use mysqli;

class SiteController
{
    public function index()
    {
        $product = new Product();
        $product->name="headphones";
        $product->description="first headphones";
        $product->save();
        render('main.php');
    }

    public function notFound()
    {
        render('404.php');
    }
}