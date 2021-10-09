<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\User;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function get(Event $event, User $user)
    {
        return view('confirmation')->with([
            'event' => $event,
            'user' => $user]);
    }

    public function store(Request $request, Event $event, User $user)
    {
        //aggiorno lo status e genero i deeplink

        return view('confirmation')->with([
            'event' => $event,
            'user' => $user]);
    }

}
