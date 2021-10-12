<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Lunch Roulette') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if(Auth::user()->registered_for_lunch==='false')
                        <form method="post" action="/register-for-lunch">
                            @csrf
                            <button
                                type="submit"
                                class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150"
                            >Registrati alla roulette!
                            </button>
                        </form>
                    @elseif(Auth::user()->registered_for_lunch==='true')
                        <form method="post" action="/unregister-for-lunch">
                            @csrf
                            <button
                                type="submit"
                                class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150"
                            >Cancellati dalla roulette!
                            </button>
                        </form>
                    @endif
                </div>
                <div><strong>Places</strong><br><br>

                    <table class="border-2">
                        <tr >
                            <th>Name:</th>
                            <th>Address:</th>
                        </tr>
                        <?php
                        $restaurants = \App\Models\Restaurant::all();
                        $restaurants = $restaurants->sortBy('name');

                        foreach ($restaurants as $restaurant){
                            echo '<tr>';
                            echo '<td>'.$restaurant->name.'</td>';
                            echo '<td>'.$restaurant->address.'</td>';
                            echo '</tr>';
                        }
                        ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
