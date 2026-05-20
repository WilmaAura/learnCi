<?php

namespace App\Controllers;

use App\Models\ProductModel; //Import productModel
class Home extends BaseController
{
    protected $productModel;

    function __construct(){
        $this->productModel = new ProductModel();
    }

    public function index(): string
    {
        $products = $this->productModel->findAll(); //ambil semua data dari product menggunakan fungsi findAll()
        $data['products'] = $products; //view menerima data dalam bentuk array 
        return view('v_home', $data);
    }
    public function contact(): string{
        return view('v_contact');
    }}
