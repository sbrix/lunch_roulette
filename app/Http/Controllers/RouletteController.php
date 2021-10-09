<?php

namespace App\Http\Controllers;

use App\Mail\RSVPMail;
use App\Models\Event;
use App\Models\Restaurant;
use App\Models\RSVP;
use App\Models\User;
use Carbon\Traits\Date;
use Cassandra\Exception\ValidationException;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Mail;
use SebastianBergmann\Comparator\DateTimeComparator;

class RouletteController extends Controller
{
    public function update(Request $request)
    {
        //dd($request);


        //setto i giorni della settimana
        if ($request->monday === 'true')
            config(['settings.monday' => 'true']);

        elseif ($request->monday === null)
            config(['settings.monday' => 'false']);

        if ($request->tuesday === 'true')
            config(['settings.tuesday' => 'true']);

        elseif ($request->tuesday === null)
            config(['settings.tuesday' => 'false']);

        if ($request->wednesday === 'true')
            config(['settings.wednesday' => 'true']);

        elseif ($request->wednesday === null)
            config(['settings.wednesday' => 'false']);

        if ($request->thursday === 'true')
            config(['settings.thursday' => 'true']);

        elseif ($request->thursday === null)
            config(['settings.thursday' => 'false']);

        if ($request->friday === 'true')
            config(['settings.friday' => 'true']);

        elseif ($request->friday === null)
            config(['settings.friday' => 'false']);

        //setto orario pausa pranzo
        $checkTime = preg_match('/[0-9]{2}:[0-9]{2}/', $request->startBreak);
        if ($checkTime) {
            $checkTime = preg_match('/[0-9]{2}:[0-9]{2}/', $request->endBreak);
            if ($checkTime) {
                if (new \DateTime($request->startBreak) < new \DateTime($request->endBreak)) {
                    config(['settings.break_start_time' => $request->startBreak]);
                    config(['settings.break_end_time' => $request->endBreak]);

                }
            }
        }


        //numero di partecipanti all'evento
        if (preg_match('/[0-9]+/', $request->participants) and ((int)$request->participants > 0)) {
            config(['settings.number_of_participants' => $request->participants]);
        }


        //scrivo su file le impostazioni
        $text = '<?php return ' . var_export(config('settings'), true) . ';';
        file_put_contents(config_path('settings.php'), $text);
        return redirect('settings')->with('success', 'Settings updated');
    }

    public function launch()
    {
        //scelgo le persone
        $number_of_participants = config('settings.number_of_participants');
        $users = User::all();
        $users = $users->shuffle();

        $participants = new Collection();
        for ($i = 0; $i < $number_of_participants; $i++) {
            $participants->push($users[$i]);

        }

        //scelgo il ristorante
        $restaurant = Restaurant::all()->shuffle()[0];

        //scelgo il giorno
        $days = new Collection();
        if (config('settings.monday') == 'true')
            $days->push('Monday');
        if (config('settings.tuesday') == 'true')
            $days->push('Tuesday');
        if (config('settings.wednesday') == 'true')
            $days->push('Wednesday');
        if (config('settings.thursday') == 'true')
            $days->push('Thursday');
        if (config('settings.friday') == 'true')
            $days->push('Friday');
        $days = $days->shuffle();


        //creo l'evemto
        $event = new Event();
        $event->event_start = new \DateTime($days[0].' '.config('settings.break_start_time'));
        $event->event_end = new \DateTime($days[0].' '.config('settings.break_end_time'));
        $event->restaurant_id=$restaurant->id;
        $event->save();

        //creo la lista degli RSVP associati all'evento
        foreach ($participants as $participant) {
            RSVP::create([
                'user_id' => $participant->id ,
                'event_id' => $event->id,
                'status' => 'Maybe',
                ]);
            //mando gli inviti via email intanto che ciclo sui partecipanti
            $email = new RSVPMail($event,$participant);
            $email->build();
            Mail::to($participant->email)->send($email);

        }




    }
}
