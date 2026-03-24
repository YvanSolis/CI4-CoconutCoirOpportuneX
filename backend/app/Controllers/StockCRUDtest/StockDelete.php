<?php

namespace App\Controllers\StockCRUDtest;

use App\Controllers\BaseController;
use App\Models\StocksModel;

class StockDelete extends BaseController
{
    public function delete($id)
    {
        $model = new StocksModel();

        // Check if book exists
        $book = $model->find($id);

        if (!$book) {
            return redirect()->to('/admin/stockPage')->with('error', 'Book not found.');
        }

        // Delete from database
        $model->delete($id);

        return redirect()->to('/admin/stockPage')->with('message', 'Book deleted successfully.');
    }
}
