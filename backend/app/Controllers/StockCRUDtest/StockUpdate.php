<?php

namespace App\Controllers\StockCRUDtest;

use App\Controllers\BaseController;
use App\Models\StocksModel;

class StockUpdate extends BaseController
{
    public function update($id)
    {
        $stocksModel = new StocksModel();

        $book = $stocksModel->find($id);
        if (!$book) {
            return redirect()->to('/admin/stockPage')->with('error', 'Book not found.');
        }

        $data = [
            'name'        => $this->request->getPost('name'),
            'description' => $this->request->getPost('description'),
            'price'       => $this->request->getPost('price'),
            'quantity'    => $this->request->getPost('quantity'),
            'image'       => $this->request->getPost('image'),
        ];

        $stocksModel->update($id, $data);

        return redirect()->to('/admin/stockPage')->with('message', 'Book updated successfully!');
    }
}
