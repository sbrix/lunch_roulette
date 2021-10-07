<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex items-center justify-center mt-6">

                        <!-- Validation Errors -->
                        <div>
                            <x-auth-validation-errors class="mt-4 mb-4" :errors="$errors"/>
                        </div>

                        <form method="post" action="/update-roulette-settings" class="">
                            @csrf


                            @if(config('settings.monday') ==='true')
                                <div class="block">
                                    <x-label for="monday">Monday</x-label>
                                    <x-input id="monday" name="monday" type="checkbox" value="true" checked></x-input>
                                </div>
                            @else
                                <div class="block">
                                    <x-label for="monday">Monday</x-label>
                                    <input id="monday" name="monday" type="checkbox" value="true"></input>
                                </div>
                            @endif

                            @if(config('settings.tuesday') ==='true')
                                <div class="block">
                                    <x-label for="tuesday">Tuesday</x-label>
                                    <x-input id="tuesday" name="tuesday" type="checkbox" value="true" checked></x-input>
                                </div>
                            @else
                                <div class="block">
                                    <x-label for="tuesday">Tuesday</x-label>
                                    <x-input id="tuesday" name="tuesday" type="checkbox" value="true"></x-input>
                                </div>
                            @endif

                            @if(config('settings.wednesday') ==='true')
                                <div class="block">
                                    <x-label for="wednesday">Wednesday</x-label>
                                    <x-input id="wednesday" name="wednesday" type="checkbox" value="true"
                                             checked></x-input>
                                </div>
                            @else
                                <div class="block">
                                    <x-label for="wednesday">Wednesday</x-label>
                                    <x-input id="wednesday" name="wednesday" type="checkbox" value="true"></x-input>
                                </div>
                            @endif

                            @if(config('settings.thursday') ==='true')
                                <div class="block">
                                    <x-label for="thursday">Thursday</x-label>
                                    <x-input id="thursday" name="thursday" type="checkbox" value="true"
                                             checked></x-input>
                                </div>
                            @else
                                <div class="block">
                                    <x-label for="thursday">Thursday</x-label>
                                    <x-input id="thursday" name="thursday" type="checkbox" value="true"></x-input>
                                </div>
                            @endif

                            @if(config('settings.friday') ==='true')
                                <div class="block">
                                    <x-label for="friday">Friday</x-label>
                                    <x-input id="friday" name="friday" type="checkbox" value="true" checked></x-input>
                                </div>
                            @else
                                <div class="block">
                                    <x-label for="friday">Friday</x-label>
                                    <x-input id="friday" name="friday" type="checkbox" value="true"></x-input>
                                </div>
                            @endif

                            <x-label for="startBreak">Lunch break start at:</x-label>
                            <input type="time" id="startBreak" name="startBreak" value="<?php
                            echo config('settings.break_start_time');
                            ?>"
                                   class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                            >

                            <x-label for="endBreak">Lunch break end at:</x-label>
                            <input type="time" id="endBreak" name="endBreak" value="<?php
                            echo config('settings.break_end_time');
                            ?>"
                                   class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                            >

                            <x-label for="participants">Number of participants:</x-label>
                            <x-input type="number" id="participants" name="participants" value="{!! config('settings.number_of_participants')!!}"></x-input>

                            <div class="block mt-4">
                                <x-button class="ml-4">
                                    {{ __('Save') }}
                                </x-button>
                            </div>
                        </form>

                        @if (session()->has('success'))
                            <div x-data="{ show: true }"
                                 x-init="setTimeout(() => show = false, 4000)"
                                 x-show="show"
                                 class="fixed px-4 py-2 bottom-3 right-3 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150"
                            >
                                <p>{{ session('success') }}</p>
                            </div>
                        @endif
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
