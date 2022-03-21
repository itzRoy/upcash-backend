<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{



    /**
     * create category with predefined data and takes name as argument
     * -----------------------------------------------------------------
     */
    public function store(Request $request)
    {

        $rules = [
            'name' => 'required ',
            'type' => 'required | in:income,expense',
        ];

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

        $category = Category::create([
            'name' => $request->name,
            'type' => $request->type
        ]);

        return response()->json([
            'status' => 200,
            'error' => false,
            'message' => 'Category created successfully',
            'Data' => $category
        ]);
    }


    /**
     * get all Categories
     * -----------------------------------------------------------------
     */
    public function index()
    {
        $categories = Category::all();
        return  $categories;
    }


    /**
     * Get all Categories and there transactions
     * using the models relationship
     */
    public function categoriesTransactions()
    {
        $categories = Category::all();
        foreach ($categories as $category) $category->transactions;

        return response()->json([
            'status' => 200,
            'data' => $categories
        ]);
    }


    /**
     * find Category by ID and get all it's Transactions
     * using the models relationship
     * -----------------------------------------------------------------
     */
    public function show($id)
    {
        //check if id is a number
        $isNumber = is_numeric($id);
        if (!$isNumber) return "the inputted id is not a number";

        //check if Category exists
        $category = Category::find($id);
        if (!$category) {
            return response()->json([
                'Status' => 404,
                'error' => true,
                'message' => "Category with id:'$id' was not found!"

            ]);
        }

        //using model relationship (-> transactions)
        $category->transactions;
        return response()->json([
            'status' => 200,
            'error' => false,
            'data' => ['category' => $category],
        ]);
    }


    /**
     * find Category by ID and update it with all 
     * the inputted values from user
     * -----------------------------------------------------------------
     */
    public function update(Request $request, $id)
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
            'message' => "Category with id: '$id' was successfully updated!"
        ]);
    }


    /**
     * find a Category by id and delete it
     * -----------------------------------------------------------------
     */
    function destroy($id)
    {
        //check if inputted id is a number
        if (!is_numeric($id)) return "inputted id is not a number!";
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

    // ==END OF CLASS================================================
};
