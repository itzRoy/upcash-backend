<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{



    /**
     * create category with predefined data and takes name as argument
     * -----------------------------------------------------------------
     */
    public function createCategory(Request $request)
    {
        if (!isset($request->name) or !isset($request->type)) return response()->json(['status' => 400, 'error' => true, 'message' => 'name or type of category is not supplied']);

        Category::create([
            'name' => $request->name,
            'type' => $request->type
        ]);

        return response()->json([
            'Status' => 200,
            'error' => false,
            'message' => "Category: $request->name with type: $request->type, has been successfully added!"
        ]);
    }


    /**
     * get all Categories
     * -----------------------------------------------------------------
     */
    public function getCategories()
    {
        $categories = Category::all();

        return  $categories;
    }


    /**
     * find Category by id and get all it's Transactions
     * using the models relationship
     * -----------------------------------------------------------------
     */
    public function getCategoryTransactions($id)
    {
        //using model relationship (-> transactions)
        $transactions = Category::find($id)->transactions;
        return $transactions;
    }
};
