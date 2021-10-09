<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Lunch Roulette') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
</head>
<body class="m-4">
<div>
    <p>You have been invited to the lunch-roulette on <?php

        $date = $event->event_start;
        echo '<strong>' . $date->format('l j F G:i') . '</strong>';
        ?><br>
        at <?php

        $restaurant = \App\Models\Restaurant::firstWhere('id', $event->restaurant_id);
        echo '<strong>' . $restaurant->name . ', ' . $restaurant->address . '</strong>' . '.';
        ?>
        <br>
        The following people were invited:
    <p><?php
           $participants = \App\Models\RSVP::get()->where('event_id',$event->id);
           foreach ($participants as $participant){
               echo $participant->user->username;
               if($participant != $participants->last())
                   echo ', ';
               else
                   echo '.';
           }
        ?>
    </p>
    <br>

    </p>
</div>
<div>
    <p>Confirm your attendance and check who will be present at the event at the following link:</p>
    <a href="<?php
    echo 'http://127.0.0.1:8000/confirmation/' . $event->id . '/' . $user->id;
    ?>
        " class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
        Link

    </a>
</div>

</body>
