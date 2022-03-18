<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profit_goal;

class Profit_goal_controller extends Controller
{
   
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
            if (!isset($request->name) or !isset($request->year) or !isset($request->amount)) return response()->json(['status' => 400, 'error' => true, 'message' => 'name amount or type is missing']);
    
    Profit_goal::create([
            'name' => $request->name,
            'amount' => $request->amount,
            'year' => $request->year
        ]);
        $profit_goal = Profit_goal::all();
        echo $profit_goal;

        return response()->json([
            'Status' => 200,
            'error' => false,
            'message' => "Profit goal: $request->name set to: $request->year, till $request->amount !"
        ]);
    }

   

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $profit_goal = Profit_goal::all();
        return $profit_goal;
    }

    public function show($id)
    {
        $profit_goal = Profit_goal::find($id);
        return $profit_goal;

    }

    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (!$request->input()) return 'Nothing was updated ';

        $profit_goal =  Profit_goal::where('id', $id)->first();

        //Break function if category was not found
        if (!$profit_goal) {
            return response()->json([
                'Status' => 404,
                'error' => true,
                'message' => "profit goal with id:'$id' was not found!"

            ]);
        }

        //set all fields that are inputted by user and save them
        if ($request->name) $profit_goal->name = $request->name;
        if ($request->amount) $profit_goal->amount = $request->amount;
        if ($request->year) $profit_goal->year = $request->year;

        $profit_goal->save();

        //send back a success response
        return response()->json([
            'Status' => 200,
            'error' => false,
            'message' => "profit goal: $id, was successfully updated!"
        ]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!is_numeric($id)) return "inputted id is not a number!";
        $profit_goal = Profit_goal::find($id);

        if (!$profit_goal) {
            return response()->json([
                'Status' => 404,
                'error' => true,
                'message' => "Could not find profit goal with id: '$id'!"
            ]);
        }
        $profit_goal->delete();

        return response()->json([
            'Status' => 200,
            'error' => false,
            'message' => "profit goal: '$id' was successfully deleted!"
        ]);

    }
}
