<?php

namespace App\Controllers;
use mysqli;

class SiteController
{
    public function index()
    {
        render('main.php');
    }

    public function notFound()
    {
        render('404.php');
    }
}