<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add Restaurant') }}
        </h2>
    </x-slot>

    <div class="flex items-center justify-center mt-6">

        <!-- Validation Errors -->
        <div>
            <x-auth-validation-errors class="mt-4 mb-4" :errors="$errors"/>
        </div>
        <form method="POST" action="/add-restaurant" class="">
            @csrf
            <div>
                <x-label for="name" :value="__('Name:')"/>

                <x-input id="name" class="block mt-1 max-w-6xl " type="text" name="name" :value="old('name')"
                         required autofocus/>
            </div>
            <div>
                <x-label for="address" :value="__('Address:')"/>

                <x-input id="address" class="block mt-1 max-w-6xl" type="text" name="address"
                         :value="old('address')"
                         required/>
            </div>
            <div>
                <x-label for="latitude" :value="__('Latitude:')"/>

                <x-input id="latitude" class="block mt-1 max-w-6xl" type="text" name="latitude"
                         :value="old('latitude')"
                />
            </div>
            <div>
                <x-label for="longitude" :value="__('Longitude:')"/>

                <x-input id="longitude" class="block mt-1 max-w-6xl" type="text" name="longitude"
                         :value="old('longitude')"
                />
            </div>
            <div class="flex items-center justify-end mt-4">
                <x-button class="ml-4">
                    {{ __('Add Restaurant') }}
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

</x-app-layout>



