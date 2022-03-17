<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Currency;
use Illuminate\Support\Facades\Validator;

class CurrencyController extends Controller
{
    public function index()
    {
        $data = Currency::all();
        return  $data;
    }

    public function show($id)
    {
        $wantedRecuring = Currency::find($id)->transactions;
        return $wantedRecuring;
    }

    public function destroy($id)
    {
        $wantedRecuring = Currency::findOrfail($id);
        $wantedRecuring->delete();
        return "deleted done";
    }

    public function store(Request $request)
    {
        $rules = array(
            'name' => 'required',
            'exchange_rate' => 'required | numeric',
            'currency_code' => 'required'
        );

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) return "please enter valid data";

        Currency::create($request->all());
        return "saved";
    }

    public function update(Request $request, $id)
    {
        $wantedcurrency = Currency::find($id);

        if (!$wantedcurrency) {
            return "Record Not found";
        }

        if ($request->name) $wantedcurrency->name = $request->name;
        if ($request->exchange_rate) $wantedcurrency->exchange_rate = $request->exchange_rate;
        if ($request->currency_code) $wantedcurrency->currency_code = $request->currency_code;

        $wantedcurrency->save();
        return "updated";
    }
}
