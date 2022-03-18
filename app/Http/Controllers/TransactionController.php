<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use Illuminate\Support\Facades\Validator;

class TransactionController extends Controller
{
    /**
     * get all Transactions
     * -----------------------------------------------------------------
     */
    public function index()
    {
        $transactions = Transaction::all();

        foreach ($transactions as $transaction) $transaction->category;

        return response()->json([
            'status' => 200,
            'error' => false,
            'message' => 'got all Transactions successfully!',
            'Data' => $transactions
        ]);
    }


    /**
     * find transaction by ID and get all it's Transactions
     * using the models relationship
     * -----------------------------------------------------------------
     */
    public function show($id)
    {
        //check if id is a number
        $isNumber = is_numeric($id);
        if (!$isNumber) return "the inputted id is not a number";

        //check if transaction exists
        $transaction = transaction::find($id);
        if (!$transaction) {
            return response()->json([
                'Status' => 404,
                'error' => true,
                'message' => "transaction with id:'$id' was not found!"

            ]);
        }
        //using model relationship (-> category)
        $transaction->category;
        return response()->json([
            'status' => 200,
            'error' => false,
            'data' => ['Transaction' => $transaction],
        ]);
    }

    /**
     * create a Transactions
     * -----------------------------------------------------------------
     */
    public function store(Request $request)
    {
        //rules for validator
        $rules = array(
            'title' => 'bail | required | max: 255',
            'amount' => 'bail | required | numeric ',
            'note' => 'nullable',
            'category_id' => 'bail | required | numeric',
            'currency_id' => 'bail | required| numeric',
            'recurring_id' => 'nullable',
        );

        $validator = Validator::make($request->all(), $rules);

        $errorMessage = $validator->errors();

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'error' => false,
                'message' => 'bad request error',
                'errors' => $errorMessage

            ]);
        }

        $transaction = Transaction::create($request->input());
        return response()->json([
            'status' => 200,
            'error' => false,
            'message' => 'Transaction created successfully',
            'Data' => $transaction
        ]);
    }

    /**
     * create a Transactions
     * -----------------------------------------------------------------
     */
    public function update(Request $request, $id)
    {
        //check if inputted id is a number
        if (!is_numeric($id)) return "inputted id is not a number!";
        //get transaction!
        $transactions = Transaction::find($id);

        if (!$transactions) {
            return response()->json([
                'Status' => 404,
                'error' => true,
                'message' => "Transactions with id:'$id' was not found!"

            ]);
        }

        if ($request->title) $transactions->title = $request->title;
        if ($request->amount) $transactions->amount = $request->amount;
        if ($request->note) $transactions->note = $request->note;
        if ($request->category_id) $transactions->category_id = $request->category_id;
        if ($request->currency_id) $transactions->currency_id = $request->currency_id;
        if ($request->recurring_id) $transactions->recurring_id = $request->recurring_id;
        $transactions->save();

        //send back a success response
        return response()->json([
            'Status' => 200,
            'error' => false,
            'message' => "Transaction with id:'$id' was successfully updated!"
        ]);
    }

    /**
     * find a Transaction by id and delete it
     * -----------------------------------------------------------------
     */
    function destroy($id)
    {
        //check if inputted id is a number
        if (!is_numeric($id)) return "inputted id is not a number!";
        $transaction = Transaction::find($id);

        if (!$transaction) {
            return response()->json([
                'Status' => 404,
                'error' => true,
                'message' => "Could not find transaction with id: '$id'!"
            ]);
        }
        $transaction->delete();

        return response()->json([
            'Status' => 200,
            'error' => false,
            'message' => "transaction: '$id' was successfully deleted!"
        ]);
    }

    // ==END OF CLASS================================================
}
