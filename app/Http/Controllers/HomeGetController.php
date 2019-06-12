<?php

namespace App\Http\Controllers;

use App\Events\Deleted;
use App\Events\StatusChange;
use App\To_do_list;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeGetController extends Controller
{
    public function get_index(){
        if (Auth::check())
        {
            $list = To_do_list::where('deleted', 0)->where('user_id', Auth::user()->id)->get();
            return view('home')->with('list', $list);
        }
        else
            return view('auth.login');
    }

    public function get_add()
    {
        return view('add');
    }

    public function get_update($id)
    {
        if (!empty($id))
            $updateVals = To_do_list::where('id', $id)->get()->first();

        return view('add')->with('updateVals', $updateVals);
    }


}

