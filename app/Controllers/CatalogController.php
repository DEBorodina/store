<?php

namespace App\Controllers;

class CatalogController
{
    public function index()
    {
        render('catalog.php');
    }
    public function showProduct()
    {
        render('product.php');
    }
}