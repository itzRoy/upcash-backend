<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Category;
use App\Models\Currency;

class TransactionController extends Controller
{
    public function makeTransaction($id)
    {
        // $category = Category::find($id);
        // $currency = Currency::find($id);
        $transactions = new Transaction();
        $transactions->title = 'pay for gas';
        $transactions->amount = 200;
        $transactions->note = 'this is test note';
        $transactions->category_id = $id;
        $transactions->currency_id = 1;
        $transactions->save();

        return "Transaction have been created successfully";
    }
}
