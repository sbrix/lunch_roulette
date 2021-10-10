<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('RSVP') }}
        </h2>
    </x-slot>
    <style>
        table, th, td {
            border: 1px solid;
            margin: 4px;
            padding: 4px;

        }
    </style>
    <body>
    <div class="flex items-center justify-center mt-6">
        <div class="m-4">
            <h1>Hello <strong>{{$user->username}}</strong></h1><br>
            <p>You have been invited to the lunch-roulette on
                <?php
                $date = new DateTime($event->event_start);
                echo '<strong>' . $date->format('l j F G:i') . '</strong>';

                ?><br>
                at <?php

                $restaurant = \App\Models\Restaurant::firstWhere('id', $event->restaurant_id);
                echo '<strong>' . $restaurant->name . ', ' . $restaurant->address . '</strong>' . '.';
                ?>

            </p>
            <br>

            <table>
                <tr>
                    <th>Participants</th>
                    <th>Presence confirmed</th>
                </tr>
                <?php
                $participants = \App\Models\RSVP::get()->where('event_id', $event->id);
                foreach ($participants as $participant) {
                    echo '<tr>';
                    echo '<td>';
                    if ($participant->user->username == $user->username) {
                        echo '<strong>' . $participant->user->username . '</strong>';
                    } else
                        echo $participant->user->username;
                    echo '</td>';
                    $rsvp = \App\Models\RSVP::get()->where('event_id', $event->id)->where('user_id', $participant->user->id)->first();
                    echo '<td>' . $rsvp->status . '</td>';
                    echo '</tr>';
                }

                ?>
            </table>
            <br>
            <?php
            $rsvp = \App\Models\RSVP::get()->where('event_id', $event->id)->where('user_id', $user->id)->first();
            if ($rsvp->status == 'Maybe')
            {
            ?>
            <a href="http://127.0.0.1:8000/confirmation/<?php echo $event->id;?>/<?php echo $user->id;?>/accept"
               class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                Accept invitation</a>

            <a href="http://127.0.0.1:8000/confirmation/<?php echo $event->id;?>/<?php echo $user->id;?>/decline"
               class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                Decline invitation</a>

            <?php
            }
            elseif($rsvp->status == 'Yes')

            {?>
            <a href="<?php echo url("calendar/{$event->id}");?>"
               class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                Download calendar</a>
            <?php
            $from = new DateTime($event->event_start, new \DateTimeZone('Europe/Brussels'));
            $to = new DateTime($event->event_end, new \DateTimeZone('Europe/Brussels'));

            $link = \Spatie\CalendarLinks\Link::create('Lunch-Roulette', $from, $to)
                ->address($restaurant->address);
            ?>

            <a href="<?php echo $link->google();?>"
               class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                Add event to Google Calendar</a>
            <a href="<?php echo $link->webOutlook();?>"
               class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                Add event to Outlook</a>
            <?php
            }
            ?>
        </div>
    </div>
    </body>
</x-app-layout>
