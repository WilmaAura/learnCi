<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class TransaksiController extends BaseController
{
    protected $cart;
    public function __construct(){
        helper(['number', 'form']);
        $this->cart= service('cart');
    }
    public function index()
    {
        $data = [
            'items' => $this->cart->contents()
        ];
        return view('v_keranjang', $data);
    }

    public function cart_add(){
       $this->cart->insert([
        'id'      => $this->request->getPost('id'),
        'qty'     => 1,
        'price'   => $this->request->getPost('harga'),
        'name'    => $this->request->getPost('nama'),
        'options' => [
            'foto' => $this->request->getPost('foto')
          ] 
        ]); 
        session()->setFlashdata(
            'success',
            
        );
    }
}
