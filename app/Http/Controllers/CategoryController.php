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
     * find Category by ID and get all it's Transactions
     * using the models relationship
     * -----------------------------------------------------------------
     */
    public function getCategoryTransactions($id)
    {
        //using model relationship (-> transactions)
        $transactions = Category::find($id)->transactions;
        return $transactions;
    }


    /**
     * find Category by ID and update it with all 
     * the inputted values from user
     * -----------------------------------------------------------------
     */
    public function updateCategory(Request $request, $id)
    {
        if (!$request->input()) return 'Nothing was updated ';

        $category =  Category::find($id);

        //Break function if category was not found
        if (!$category) {
            return response()->json([
                'Status' => 404,
                'error' => true,
                'message' => "Category with id:'$id' was not found!"

            ]);
        }

        //set all fields that are inputted by user and save them
        if ($request->name) $category->name = $request->name;
        if ($request->type) $category->type = $request->type;
        $category->save();

        //send back a success response
        return response()->json([
            'Status' => 200,
            'error' => false,
            'message' => "Category: $id, was successfully updated!"
        ]);
    }

    /**
     * find a Category by id and delete it
     * -----------------------------------------------------------------
     */
    function deleteCategory($id)
    {
        $category = Category::find($id);

        if (!$category) {
            return response()->json([
                'Status' => 404,
                'error' => true,
                'message' => "Could not find Category with id: ($id)"
            ]);
        }
        $category->delete();

        return response()->json([
            'Status' => 200,
            'error' => false,
            'message' => "Category: $id, was successfully deleted!"
        ]);
    }
};
