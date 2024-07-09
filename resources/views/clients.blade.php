<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Registered Teachers') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-l">
                <div class="p-6 text-gray-500">
                    {{ __("Here are the list of registered teachers: ") }}
                    @foreach ($clients as $client)
                        <div class="py-3">
                            <h3 class="text-lg"><b>Teacher Name: </b>{{$client->name}}</h3>
                            <p><b>Teacher ID: </b>{{$client->id}}</p>
                            <p><b>Redirect URI: </b>{{$client->redirect}}</p>
                            <p><b>Secret: </b>{{$client->secret}}</p>
                        </div>
                       @endforeach
                </div>

                <div class="mt-3 p-6 bg-white border-b border-gray-200">
                    <form action="/oauth/clients" method="POST">
                        <div>
                            <x-input-label for="name">Name</x-input-label>
                            <x-text-input type="text" name="name" placeholder="Teacher's Name"></x-text-input>
                    </div>
                    <div class="mt-2">
                             <x-input-label for="name">Redirect</x-input-label>
                            <x-text-input type="text" name="redirect" placeholder="https://my url.com/callback"></x-text-input>
                        </div>
                        <div class="mt-3">
                            @csrf
                            <x-primary-button type="submit">Create Client</x-primary-button>
                        </div>
                    </form>
        </div>
    </div>
</x-app-layout>
