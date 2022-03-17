<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recurring;
use Illuminate\Support\Facades\Validator;

class RecurringController extends Controller
{
    public function index()
    {
        $data = Recurring::all();
        return  $data;
    }

    public function show($id)
    {
        $wantedRecuring = Recurring::find($id)->transactions;
        return $wantedRecuring;
    }

    public function destroy($id)
    {
        $wantedRecuring = Recurring::findOrfail($id);
        $wantedRecuring->delete();
        return "deleted done";
    }

    public function store(Request $request)
    {
        $rules = array(
            'name' => 'required',
            'start_date' => 'required | date',
            'end_date' => 'required |date'
        );

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) return "please enter valid data";

        Recurring::create($request->all());
        return "saved";
    }

    public function update(Request $request, $id)
    {
        $wantedRecuring = Recurring::find($id);
        if (!$wantedRecuring) {
            return "Record Not found";
        }

        if ($request->name) $wantedRecuring->name = $request->name;
        if ($request->start_date) $wantedRecuring->start_date = $request->start_date;
        if ($request->end_date) $wantedRecuring->end_date = $request->end_date;

        $wantedRecuring->save();
        return "updated";
    }
}
