<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

// use DataTables;
use Yajra\DataTables\Datatables;

class UserController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax())
        {
            $data = User::select('*');
            
            // dd($request->filled('from_date'),$request->from_date,$request->filled('to_date'),$request->to_date);
            return DataTables::of($data)->addIndexColumn()->make(true);
            
            if($request->filled('from_date') && $request->filled('to_date'))
            {
                $data = $data->whereBetween('created_at', [$request->from_date, $request->to_date]);
            }

            // return Datatables()->of($data)->make(true);
        }
        return view('users');
    }
}