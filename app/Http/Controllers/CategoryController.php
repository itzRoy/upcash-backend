<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Transaction;

class CategoryController extends Controller
{

    //get all Categories
    public function getCategories()
    {
        $name = DB::table('categories')->get();

        return  $name;
    }


    //create category with predefined data and takes name as argument
    public function createCategory($test)
    {
        $category = new Category();
        $category->name = $test;
        $category->type = "expense";
        $category->save();

        return "category have been created successfully!";
    }



    //read all transaction of a certain category(find by id)
    public function getCategoryTransactions($id)
    {
        //using model relationship
        $transactions = Category::find($id)->transactions;
        return $transactions;
    }
};
