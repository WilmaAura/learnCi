<?php

namespace App\Controllers\Api;

use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;

class DiscountController extends ResourceController
{
    protected $modelName = 'App\Models\DiscountModel';
    protected $format = 'json';
    /**
     * Return an array of resource objects, themselves in array format.
     *
     * @return ResponseInterface
     */
    public function index()
    {
        $data = $this->model->findAll();
        return $this->respond($data, 200);
    }

    /**
     * Return the properties of a resource object.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function show($id = null)
    {
        $data = $this->model->find($id);
        if (!$data){
            return $this->failNotFound('Data diskon tidak ditemukan.');
        }
        return $this->respond($data, 200);
    }

    /**
     * Return a new resource object, with default properties.
     *
     * @return ResponseInterface
     */
    public function new()
    {
        //
    }

    /**
     * Create a new resource object, from "posted" parameters.
     *
     * @return ResponseInterface
     */
    public function create()
    {
        // Ambil data JSON body yang dikirim dari file .rest
        $json = $this->request->getJSON(true);

        // Jika request dalam bentuk JSON raw, tampung datanya ke array $inputData
        // Jika request form biasa, tampung data POST biasa
        $inputData = !empty($json) ? $json : $this->request->getPost();

        $rules = [
            'tanggal' => 'required|valid_date|is_unique[discounts.tanggal]',
            'nominal' => 'required|numeric'
        ];

        // Validasi menggunakan data input yang sudah kita tangkap
        if (!$this->validateData($inputData, $rules)) {
            return $this->fail($this->validator->getErrors());
        }

        // Insert data ke database
        $this->model->insert([
            'tanggal' => $inputData['tanggal'],
            'nominal' => $inputData['nominal']
        ]);
        
        $response = [
            'status'   => 201,
            'messages' => 'Data diskon berhasil ditambahkan.'
        ];
        return $this->respondCreated($response);
    }

    /**
     * Return the editable properties of a resource object.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function edit($id = null)
    {
        //
    }

    /**
     * Add or update a model resource, from "posted" properties.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function update($id = null)
    {
        $data = $this->model->find($id);
        if (!$data) {
            return $this->failNotFound('Data diskon tidak ditemukan.');
        }

        $rules = [
            'nominal' => 'required|numeric'
        ];

        if (!$this->validate($rules)) {
            return $this->fail($this->validator->getErrors());
        }

        // Pada update, field tanggal dikunci (readonly), jadi hanya mengupdate nominal
        $input = [
            'nominal' => $this->request->getVar('nominal')
        ];

        $this->model->update($id, $input);

        $response = [
            'status'   => 200,
            'messages' => 'Data diskon berhasil diperbarui.'
        ];
        return $this->respond($response);
    }

    /**
     * Delete the designated resource object from the model.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function delete($id = null)
    {
        $data = $this->model->find($id);
        if (!$data) {
            return $this->failNotFound('Data diskon tidak ditemukan.');
        }

        $this->model->delete($id);

        $response = [
            'status'   => 200,
            'messages' => 'Data diskon berhasil dihapus.'
        ];
        return $this->respondDeleted($response);
    }
}
