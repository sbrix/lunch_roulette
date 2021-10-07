<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function makeAdmin(){
        auth()->user()->setAttribute('is_admin','true');
        auth()->user()->save();
        return back();
    }

    public function registerForLunch(){
        auth()->user()->setAttribute('registered_for_lunch','true');
        auth()->user()->save();
        return back();
    }

    public function unregisterForLunch(){
        auth()->user()->setAttribute('registered_for_lunch','false');
        auth()->user()->save();
        return back();
    }

}
