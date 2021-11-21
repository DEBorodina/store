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
    public function showForm(){
        render('addProductForm.php');
    }
    private static function checkName($path,$fileName){

        //CAMELCASE TO SNAKECASE
        $fileName = str_replace(' ', '', mb_convert_case(ucwords(str_replace('_', ' ', $fileName)), MB_CASE_TITLE, "UTF-8"));
        $fileName = mb_strtolower(mb_substr($fileName,0,1,"UTF8"),"UTF8"). mb_substr($fileName, 1, mb_strlen($fileName, "UTF8"), "UTF8");

        //CHANGE IF NAMES ARE THE SAME
        $k=0;
        while(file_exists($path.$fileName)){
            $fileName =  stripos($fileName,").")?$fileName:str_replace(".","(0).",$fileName);
            $fileName = str_replace("({$k})","(".strval(++$k).")",$fileName);
        }
        return $fileName;
    }
    public function saveProduct(){
        $path = $_SERVER['DOCUMENT_ROOT']."/downloads/";
        for ($i = 0; $i < count($_FILES['img']['name']); ++$i){
            if(explode('/',mime_content_type($_FILES['img']['tmp_name'][$i]))[0]!="image"){
                echo "File <b>".$_FILES['img']['name'][$i]."</b> can't be added because it is not an image.<br>";
            }else if(filesize($_FILES['img']['tmp_name'][$i])>=1024*1024){
                echo "File <b>".$_FILES['img']['name'][$i]."</b> can't be added because it is too big.<br>";
            }else{
                $fileName = $path.static::checkName($path,$_FILES['img']['name'][$i]);
                move_uploaded_file($_FILES['img']['tmp_name'][$i],$fileName);
                echo "File <b>".$_FILES['img']['name'][$i]."</b> is added!<br>";
            }
        }
    }
}