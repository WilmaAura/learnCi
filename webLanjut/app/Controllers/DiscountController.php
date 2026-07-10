<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\DiscountModel;

class DiscountController extends BaseController
{
    
    protected $discountModel;
    public function __construct(){
        helper(['form', 'url', 'number']);
        $this->discountModel = new DiscountModel();

        if (session()->get('role') !== 'admin'){
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Anda tidak memiliki akses.");
        }
    }
    public function index()
    {
        $data['discounts'] = $this->discountModel->findAll();
        
        $hariIni = date('Y-m-d');
        $diskonHariIni = $this->discountModel->where('tanggal', $hariIni)->first();
        $data['nominal_diskon'] = $diskonHariIni ? $diskonHariIni['nominal'] : 0;

        return view('v_discount', $data); 
    }

    public function create(){
        $rules = [
            'tanggal' => [
                'rules'  => 'required|valid_date|is_unique[discounts.tanggal]',
                'errors' => [
                    'required'  => 'Field tanggal harus diisi.',
                    'valid_date'=> 'Format tanggal tidak valid.',
                    'is_unique' => 'The tanggal field must contain a unique value.' // Sesuai screenshot soal
                ]
            ],
            'nominal' => [
                'rules'  => 'required|numeric',
                'errors' => [
                    'required' => 'Field nominal harus diisi.',
                    'numeric'  => 'Nominal harus berupa angka.'
                ]
            ]
        ];
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->discountModel->save([
            'tanggal' => $this->request->getPost('tanggal'),
            'nominal' => $this->request->getPost('nominal'),
        ]);

        return redirect()->to('diskon')->with('success', 'Data diskon berhasil ditambahkan.');
    }

    public function update($id){
        $rules = [
            'nominal' => [
                'rules'  => 'required|numeric',
                'errors' => [
                    'required' => 'Field nominal harus diisi.',
                    'numeric'  => 'Nominal harus berupa angka.'
                ]
            ]
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->discountModel->update($id, [
            'nominal' => $this->request->getPost('nominal')
        ]);

        return redirect()->to('diskon')->with('success', 'Data diskon berhasil diubah.');
    }

    public function delete($id)
    {
        $this->discountModel->delete($id);
        return redirect()->to('diskon')->with('success', 'Data diskon berhasil dihapus.');
    }
}
