<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index()
    {
        $data = Admin::all();
        return  $data;
    }

    public function show($id)
    {
        $wantedRecuring = Admin::find($id);
        return $wantedRecuring;
    }



    public function destroy($id)
    {
        $wantedRecuring = Admin::findOrfail($id);
        $wantedRecuring->delete();
        return "deleted";
    }

    public function store(Request $request)
    {
        $rules = array(
            'username' => 'required | unique:admins',
            'password' => 'required |min:6'
        );

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) return response()->json($validator->errors());

        Admin::create($request->all());
        return "saved";
    }

    public function update(Request $request, $id)
    {
        $wanteduser = Admin::find($id);

        if (!$wanteduser) {
            return "Record Not found";
        }

        if ($request->username) $wanteduser->username = $request->username;
        if ($request->password)
        $pass = Hash::make($request->password);
         $wanteduser->password = $pass;

        $wanteduser->save();
        return "Admin Updated";
    }
}
