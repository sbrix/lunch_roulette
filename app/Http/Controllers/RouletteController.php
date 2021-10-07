<?php

namespace App\Http\Controllers;

use Carbon\Traits\Date;
use Cassandra\Exception\ValidationException;
use Illuminate\Http\Request;
use SebastianBergmann\Comparator\DateTimeComparator;

class RouletteController extends Controller
{
    public function update(Request $request){
        //dd($request);


        //setto i giorni della settimana
        if($request->monday === 'true')
            config(['settings.monday' => 'true']);

        elseif ($request->monday === null)
            config(['settings.monday' => 'false']);

        if($request->tuesday === 'true')
            config(['settings.tuesday' => 'true']);

        elseif ($request->tuesday === null)
            config(['settings.tuesday' => 'false']);

        if($request->wednesday === 'true')
            config(['settings.wednesday' => 'true']);

        elseif ($request->wednesday === null)
            config(['settings.wednesday' => 'false']);

        if($request->thursday === 'true')
            config(['settings.thursday' => 'true']);

        elseif ($request->thursday === null)
            config(['settings.thursday' => 'false']);

        if($request->friday === 'true')
            config(['settings.friday' => 'true']);

        elseif ($request->friday === null)
            config(['settings.friday' => 'false']);

        //setto orario pausa pranzo
        $checkTime = preg_match('/[0-9]{2}:[0-9]{2}/',$request->startBreak);
        if($checkTime){
            $checkTime = preg_match('/[0-9]{2}:[0-9]{2}/',$request->endBreak);
            if($checkTime){
                if(new \DateTime($request->startBreak) < new \DateTime($request->endBreak)) {
                    config(['settings.break_start_time' => $request->startBreak]);
                    config(['settings.break_end_time' => $request->endBreak]);

                }
            }
        }


        //numero di partecipanti all'evento
        if(preg_match('/[0-9]+/',$request->participants) and ((int)$request->participants > 0)){
            config(['settings.number_of_participants' => $request->participants]);
        }




        //scrivo su file le impostazioni
        $text = '<?php return ' . var_export(config('settings'), true) . ';';
        file_put_contents(config_path('settings.php'), $text);
        return redirect('settings')->with('success','Settings updated');
    }
}
