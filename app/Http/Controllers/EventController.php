<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Restaurant;
use App\Models\RSVP;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\IcalendarGenerator\Components\Calendar;
use Spatie\CalendarLinks\Link;

class EventController extends Controller
{
    public function get(Event $event, User $user)
    {
        return view('confirmation')->with([
            'event' => $event,
            'user' => $user]);
    }

    public function accept(Request $request, Event $event, User $user)
    {
        $rsvp = RSVP::firstWhere(['user_id' => $user->id,'event_id' => $event->id]);
        $rsvp->status='Yes';
        $rsvp->save();
        return view('confirmation')->with([
            'event' => $event,
            'user' => $user]);
    }

    public function decline(Request $request, Event $event, User $user)
    {
        $rsvp = RSVP::firstWhere(['user_id' => $user->id,'event_id' => $event->id]);
        $rsvp->status='No';
        $rsvp->save();
        return view('confirmation')->with([
            'event' => $event,
            'user' => $user]);
    }

    public function getCalendar($id)
    {
        $event = Event::firstWhere('id',$id);
        $restaurant = Restaurant::firstWhere('id',$event->restaurant_id);
        $calendar = Calendar::create()
            ->event(\Spatie\IcalendarGenerator\Components\Event::create('Lunch Roulette')
            ->address($restaurant->address)
            ->addressName($restaurant->name)
            ->coordinates($restaurant->latitude , $restaurant->longitude)
            ->startsAt(new \DateTime($event->event_start,new \DateTimeZone('Europe/Brussels')))
            ->endsAt(new \DateTime($event->event_end,new \DateTimeZone('Europe/Brussels'))));

        return response($calendar->get(), 200, [
            'Content-Type' => 'text/calendar',
            'Content-Disposition' => 'attachment; filename="lunch-roulette.ics"',
            'charset' => 'utf-8',
        ]);
    }



}
