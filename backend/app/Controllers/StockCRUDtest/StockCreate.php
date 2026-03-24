<?php

namespace App\Controllers\StockCRUDtest;

use App\Controllers\BaseController;
use App\Models\StocksModel;

class StockCreate extends BaseController
{
    public function create()
    {
        $model = new StocksModel();

        $data = [
            'name'        => $this->request->getPost('name'),
            'image'       => $this->request->getPost('image'),
            'description' => $this->request->getPost('description'),
            'price'       => $this->request->getPost('price'),
            'quantity'    => $this->request->getPost('quantity'),
        ];

        $model->insert($data);

        return redirect()->to('/admin/stockPage')
            ->with('message', 'New book added successfully!');
    }
}
