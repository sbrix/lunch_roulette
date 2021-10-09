<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('RSVP') }}
        </h2>
    </x-slot>
    <body>
    <div class="m-4">
        <h1>Hello <strong>{{$user->username}}</strong></h1><br>
        <h1>{{$event}}</h1>

        <form action="/confirmation/<?php echo $event->id;?>/<?php  echo $user->id; ?>" method="post"></form>

        <x-button id="accept" name="accept" value="accept">Accept invitation</x-button>
        <x-button id="decline" name="decline" value="decline">Decline invitation</x-button>

    </div>
    </body>
</x-app-layout>
