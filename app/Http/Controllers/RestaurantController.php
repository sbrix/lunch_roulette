<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use Illuminate\Http\Request;

class RestaurantController extends Controller
{
    public function store(Request $request ){

        $request->validate([
            'name' => ['required','string', 'max:255','unique:restaurants,name'],
            'address' => ['required','string', 'max:255'],

        ]);

        $restaurant = Restaurant::create([
            'name'=> $request->name,
            'address'=> $request->address,
            'coordinates' => $request->coordinates,

        ]);

    return redirect('restaurant')->with('success','Restaurant added');
    //return back();
    }
}
